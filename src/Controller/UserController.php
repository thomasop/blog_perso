<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Tool\Friend;
use App\Form\UserType;
use App\Form\ResetType;
use App\Form\UserPseudoType;
use App\Form\UserSearchType;
use App\Form\UserMessageType;
use App\Form\RegistrationType;
use App\Handler\FormUserHandler;
use App\Repository\UserRepository;
use App\Repository\ImageRepository;
use App\Repository\FriendRepository;
use App\Repository\MessageRepository;
use App\Repository\VideoRepository;
use App\Tool\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserController extends AbstractController
{
    /** @var UserPasswordHasherInterface */
    private $passwordEncoder;
    /** @var TokenStorageInterface */
    private $tokenStorage;
    /** @var FormUserHandler */
    private $formUserHandler;
    private $slugger;

    public function __construct(UserPasswordHasherInterface $passwordEncoder, TokenStorageInterface $tokenStorage, FormUserHandler $formUserHandler, SluggerInterface $slugger)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->tokenStorage = $tokenStorage;
        $this->formUserHandler = $formUserHandler;
        $this->slugger = $slugger;
    }

    #[route('/user/display', name: 'user_index')]
    #[IsGranted('ROLE_ADMIN', statusCode: 404, message: 'Vous n\'avez pas acces a cette page!')]
    public function index(UserRepository $userRepository, Request $request): Response
    {
        $users = null;
        $form = $this->createForm(UserSearchType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $prenom = $form->get('prenom')->getData();
            $nom = $form->get('nom')->getData();
            $demande = $form->get('demande')->getData();
            $users = $userRepository->search($prenom, $nom, $demande);
            if ($users != null) {
                $this->addFlash(
                    'success',
                    'Utilisateur trouvé!'
                );
            } else {
                $this->addFlash(
                    'success',
                    'Aucun utilisateur trouvé!'
                );
            }
            return $this->render('user/index.html.twig', [
                'users' => $users,
                'form' => $form->createView()
            ]);
        }
        return $this->render('user/index.html.twig', [
            'users' => $users,
            'form' => $form->createView()
        ]);
    }

    #[route('/register', name: 'register', methods: ["GET", "POST"])]
    public function new(Request $request, EntityManager $entityManager, MailerInterface $mailer): Response
    {
        $form = $this->createForm(RegistrationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = new User();
            $user->setPrenom($form->get('prenom')->getData());
            $user->setNom($form->get('nom')->getData());
            $user->setEmail($form->get('email')->getData());
            $user->setPassword(
                $this->passwordEncoder->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $image = $form->get('avatar')->getData();

            if ($image === null) {
                $image = 'defaultavatar.png';
                $user->setAvatar($image);
            } else {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $this->slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();
                try {
                    $image->move(
                        $this->getParameter('pictures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $user->setAvatar($newFilename);
            }
            $user->setToken($this->generateToken());
            $age = $form->get('age')->getData();
            $dateNaissance = $age->format("Y-m-d");
            $aujourdhui = date("Y-m-d");
            $diff = date_diff(date_create($dateNaissance), date_create($aujourdhui));
            $age = $diff->format('%y');
            if ($age < 18) {
                $this->addFlash(
                    'success',
                    'Erreur age minimun 18 ans'
                );
                return $this->redirectToRoute('register', [], Response::HTTP_SEE_OTHER);
            }
            $user->setAge($form->get('age')->getData());
            $user->setSexe($form->get('sexe')->getData());
            $entityManager->Add($user);
            $message = (new TemplatedEmail())
                ->from('thomasdasilva010@gmail.com')
                ->to(htmlspecialchars($form->get('email')->getData()))
                ->subject('vérification email')
                ->htmlTemplate('user/confirmationEmail.html.twig')
                ->context([
                    'token' => $user->getToken(),
                    'expiration_date' => new \DateTime('+1 days'),
                ])
                ;
            $mailer->send($message);
            $this->addFlash(
                'success',
                'Compte créé, veuillez verifier votre email!'
            );
            return $this->redirectToRoute('login', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('user/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[route('/forgot-password', name: 'forgot_password')]
    public function forgotPassword(): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class);
        if ($this->formUserHandler->forgotPassword($form, $user) == true) {
            $this->addFlash(
                'success',
                'Adresse mail trouvé, veuillez verifier votre email pour changer votre mot de passe!'
            );
            return $this->redirectToRoute('login');
        }
        if (empty($this->formUserHandler->forgotPassword($form, $user))) {
            $this->addFlash(
                'success',
                'Adresse mail pas trouvé, rentrez une adresse mail valide!!'
            );
            return $this->redirectToRoute('forgot_password');
        }
        return $this->render('user/forgot.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[route('/reset-password/{token}', name: 'reset_password')]
    public function resetPassword($token, UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy(["token" => $token]);
        if ($user) {
            $form = $this->createForm(ResetType::class);
            if ($this->formUserHandler->resetPassword($form, $user) == true) {
                $this->addFlash(
                    'success',
                    'Mot de passe modifié !'
                );
                return $this->redirectToRoute('login');
            } elseif ($this->formUserHandler->resetPassword($form, $user) == 'erreur') {
                $this->addFlash(
                    'success',
                    'Mot de passe incorrect: Une lettre en majuscule, minuscule, un chiffre et caractère speciaux attendu ainsi que 8 caractères minimum!'
                );
            }
        } else {
            $this->addFlash(
                'success',
                'Vous n\'avez pas accès à cette page!'
            );
            return $this->redirectToRoute('login');
        }
        return $this->render('user/reset.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[route('/verification-email/{token}', name: 'app_verify_email')]
    public function verifyUserEmail($token, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $userRepository = $entityManager->getRepository(User::class)->findOneBy(["token" => $token]);
        if ($userRepository) {
            $this->formUserHandler->verifyUserEmail($userRepository);
            $this->addFlash(
                'success',
                'compte valide!'
            );
            return $this->redirectToRoute('login');
        }
        return $this->redirectToRoute('login');
    }

    #[route('/user/profile/{id}', name: 'profile')]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas acces a cette page!')]
    public function show(User $user, ManagerRegistry $doctrine, FriendRepository $friendRepository, MessageRepository $messageRepository, ImageRepository $imageRepository, VideoRepository $videoRepository): Response
    {
        $list = new Friend($this->tokenStorage);
        $friend = $friendRepository->envoyerPar($this->tokenStorage->getToken()->getUser(), $user);
        $entityManager = $doctrine->getManager();
        $posts = $entityManager->getRepository(Post::class)->findBy(['user' => $user->getId()]);
        $image = $imageRepository->findBy(['user' => $user], ['id' => 'DESC']);
        $video = $videoRepository->findBy(['user' => $user], ['id' => 'DESC']);
        if ($user->getAge() != null) {
            $dateNaissance = $user->getAge()->format("Y-m-d");
            $aujourdhui = date("Y-m-d");
            $diff = date_diff(date_create($dateNaissance), date_create($aujourdhui));
            $age = $diff->format('%y');
        } else {
            $age = 'pas renseigné';
        }
        return $this->render('user/show.html.twig', [
            'user' => $user,
            'posts' => $posts,
            'friend' => $friend,
            'image' => $image,
            'video' => $video,
            'prenom' => $list->liste($messageRepository),
            'age' => $age
        ]);
    }

    #[route('/user/edit/{id}', name: 'user_edit')]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas acces a cette page!')]
    public function edit(User $user): Response
    {
        $form = $this->createForm(UserPseudoType::class, $user);
        if ($this->formUserHandler->edit($form, $user) == true) {
            $this->addFlash(
                'success',
                'Nom et Prénom modifier!'
            );
            return $this->redirectToRoute('profile', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('user/pseudo.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[route('/user/delete/{id}', name: 'user_delete')]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas acces a cette page!')]
    public function delete(Request $request, User $user, EntityManager $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
        }
        $request->getSession()->invalidate();
        $this->tokenStorage->setToken();
        return $this->redirectToRoute('login', [], Response::HTTP_SEE_OTHER);
    }

    #[route('/user/demande/{id}', name: 'user_demande')]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas acces a cette page!')]
    public function demandAdmin(User $user): Response
    {
        $form = $this->createForm(UserMessageType::class, $user);
        if ($this->formUserHandler->demandeAdmin($form, $user) == true) {
            $this->addFlash(
                'success',
                'Demande envoyer, un admin doit vous accepter!'
            );
            return $this->redirectToRoute('profile', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('user/message.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[route('/user/accept/{id}', name: 'user_accept')]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas acces a cette page!')]
    public function accept(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('admin'.$user->getId(), $request->request->get('_token'))) {
            $this->formUserHandler->accept($user);
        }
        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }

    #[route('/user/admin/delete/{id}', name: 'admin_delete')]
    #[IsGranted('ROLE_ADMIN', statusCode: 404, message: 'Vous n\'avez pas acces a cette page!')]
    public function deleteUser(Request $request, User $user, EntityManager $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
        }
        $this->addFlash('success', 'Utilisateur ' . $user->getNom() . ' ' . $user->getPrenom() . ' supprimé');
        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }

    #[route('/modification-password/{prenom}-{nom}', name: 'modification_password')]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas acces a cette page!')]
    public function modifPassword(User $user): Response
    {
        $form = $this->createForm(UserType::class);
        if ($this->formUserHandler->modifPassword($form, $user) == true) {
            $this->addFlash(
                'success',
                'Adresse mail trouvé, veuillez verifier votre email pour changer votre mot de passe!'
            );
            return $this->redirectToRoute('profile', ['id' => $user->getId()]);
        }
        if ($this->formUserHandler->modifPassword($form, $user) == 'erreur') {
            $this->addFlash(
                'success',
                'Adresse mail pas trouvé, rentrez une adresse mail valide!!'
            );
        }
        return $this->render('user/forgot.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function generateToken(): string
    {
        return rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
    }
}
