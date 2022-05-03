<?php

namespace App\Handler;

use App\Entity\User;
use App\Tool\FileUploader;
use App\Tool\EntityManager;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class FormUserHandler
{
    /**
     * @var FileUploader
     */
    private $fileUploader;
    /**
     * @var RequestStack
     */
    private $request;
    /**
     * @var UserPasswordHasherInterface
     */
    private $passwordEncoder;
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserPasswordHasherInterface $passwordEncoder, RequestStack $request, FileUploader $fileUploader, EntityManager $entityManager, MailerInterface $mailer, UserRepository $userRepository)
    {
        $this->fileUploader = $fileUploader;
        $this->request = $request;
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->mailer = $mailer;
        $this->userRepository = $userRepository;
    }

    /**
     * Function for add new user
     *
     * @param FormInterface $form
     * @param User $user
     * @return boolean
     */
    public function new(FormInterface $form, User $user): bool
    {
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
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
                $newAvatar = $this->fileUploader->upload($image);
                $user->setAvatar($newAvatar);
            }
            $user->setToken($this->generateToken());
            $age = $form->get('age')->getData();
            $dateNaissance = $age->format("Y-m-d");
            $aujourdhui = date("Y-m-d");
            $diff = date_diff(date_create($dateNaissance), date_create($aujourdhui));
            $age = $diff->format('%y');
            if ($age < 18) {
                return $age;
            }
            $this->entityManager->Add($user);
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
            $this->mailer->send($message);
            return true;
        }
        return false;
    }

    /**
     * Function for user forgot password
     *
     * @param FormInterface $form
     * @param User $user
     * @return boolean
     */
    public function forgotPassword(FormInterface $form, User $user): bool
    {
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $user = $this->userRepository->findOneBy(["email" => $email]);
            if ($user) {
                $user->setToken($this->generateToken());

                $this->entityManager->Add($user);
                $message = (new TemplatedEmail())
                    ->from('thomasdasilva010@gmail.com')
                    ->to(htmlspecialchars($form->get('email')->getData()))
                    ->subject('Mot de passe oublié')
                    
                    ->htmlTemplate('user/forgotpassword.html.twig')
                    ->context([
                        'token' => $user->getToken(),
                        'expiration_date' => new \DateTime('+1 days'),
                    ])
                    ;
                $this->mailer->send($message);
                return true;
            }
            return $user;
        }
        return false;
    }

    /**
     * Function for user reset password
     *
     * @param FormInterface $form
     * @param User $user
     * @return boolean
     */
    public function resetPassword(FormInterface $form, User $user): bool
    {
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setToken(null);
            if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $form->get('password')->getData())){
                $user->setPassword(
                    $this->passwordEncoder->hashPassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );
                $this->entityManager->Add($user);
                return true;
            }
            elseif (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $form->get('password')->getData())){
                return 'erreur';
            }
        }
        return false;
    }

    /**
     * Function for user verify email
     *
     * @param User $userRepository
     * @return void
     */
    public function verifyUserEmail(User $userRepository): void
    {
        $userRepository->setEnabled(true);
        $userRepository->setToken(null);
        $this->entityManager->Add($userRepository);
    }

    /**
     * Function for user edit
     *
     * @param FormInterface $form
     * @param User $user
     * @return boolean
     */
    public function edit(FormInterface $form, User $user): bool
    {
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $prenom = $form->get('prenom')->getData();
            $nom = $form->get('nom')->getData();
            $user->setPrenom($prenom);
            $user->setNom($nom);
            $this->entityManager->Add($user);
            return true;
        }
        return false;
    }

    /**
     * Function for user damande for admin
     *
     * @param FormInterface $form
     * @param User $user
     * @return boolean
     */
    public function demandeAdmin(FormInterface $form, User $user): bool
    {
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('message')->getData()) {
                $message = $form->get('message')->getData();
                $user->setMessage($message);
            }
            else {
                $message = 'Salut, je peux etre admin?';
                $user->setMessage($message);
            }
            $user->setDemandeAdmin(true);
            $this->entityManager->Add($user);
            return true;
        }
        return false;
    }

    /**
     * Function for admin accept user
     *
     * @param UserEntity $user
     * @return void
     */
    public function accept($user): void
    {
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setAdmin(true);
        $user->setDemandeAdmin(false);
        $user->setMessage(null);
        $this->entityManager->Add($user);
    }

    /**
     * Function for user edit password
     *
     * @param FormInterface $form
     * @param User $user
     * @return boolean
     */
    public function modifPassword(FormInterface $form, User $user): bool
    {
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $usermail = $this->userRepository->findOneBy(["email" => $email]);
            if ($user == $usermail) {
                $user->setToken($this->generateToken());

                $this->entityManager->Add($user);
                $message = (new TemplatedEmail())
                    ->from('thomasdasilva010@gmail.com')
                    ->to(htmlspecialchars($form->get('email')->getData()))
                    ->subject('Modifier son mot de passe')
                    
                    ->htmlTemplate('user/modifpassword.html.twig')
                    ->context([
                        'token' => $user->getToken(),
                        'expiration_date' => new \DateTime('+1 hour'),
                    ])
                    ;
                $this->mailer->send($message);
                return true;
            }
            return 'erreur';
        }
        return false;
    }

    /**
     * Function for generate token for send in email
     *
     * @return string
     */
    private function generateToken(): string
    {
        return rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
    }
}