<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Friend;
use App\Entity\Message;
use App\Form\FriendType;
use App\Handler\FormFriendHandler;
use App\Repository\FriendRepository;
use App\Repository\MessageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class FriendController extends AbstractController 
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;
    /**
     * @var FormFriendHandler
     */
    private $formFriendHandler;
    
    public function __construct(TokenStorageInterface $tokenStorage, FormFriendHandler $formFriendHandler)
    {
        $this->tokenStorage = $tokenStorage;
        $this->formFriendHandler = $formFriendHandler;
    }

    /**
     * Function for add friend
     *
     * @param User $user
     * @return Response
     */
    #[route('/ami/{prenom}-{nom}', name: 'friend')]
    #[ParamConverter('user', class: 'App\Entity\User', options: ['mapping' => ['prenom' => 'prenom']])]
    #[ParamConverter('user', class: 'App\Entity\User', options: ['mapping' => ['nom' => 'nom']])]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas acces a cette page!')]
    public function add(User $user): Response 
    {
        $friend = new Friend();
        $message = new Message();
        $form = $this->createForm(FriendType::class);
        if ($this->formFriendHandler->add($form, $friend, $user, $message) == true) {
            return $this->redirectToRoute('profile', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('friend/add.html.twig', [
            'form' => $form,
            'user' => $user
        ]);
    }

    /**
     * Function for show all friends
     *
     * @param FriendRepository $friendRepository
     * @return Response
     */
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas acces a cette page!')]
    public function all(FriendRepository $friendRepository): Response 
    {
        $currentId = $this->tokenStorage->getToken()->getUser();
        $demandeEnvoyé = $friendRepository->demande($currentId);
        $demandeRecu = $friendRepository->recu($currentId);

        return $this->renderForm('friend/all.html.twig', [
            'demandeEnvoyé' => $demandeEnvoyé,
            'demandeRecu' => $demandeRecu
        ]);
    }

    /**
     * Function for accept user
     *
     * @param User $user
     * @param Request $request
     * @return Response
     */
    #[route('/accept/{prenom}-{nom}/{id}', name: 'friend_accept')]
    #[ParamConverter('user', class: 'App\Entity\User', options: ['mapping' => ['prenom' => 'prenom']])]
    #[ParamConverter('user', class: 'App\Entity\User', options: ['mapping' => ['nom' => 'nom']])]
    #[ParamConverter('user', class: 'App\Entity\User', options: ['mapping' => ['id' => 'id']])]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas acces a cette page!')]
    public function accept(User $user, Request $request): Response 
    {
        if ($this->isCsrfTokenValid('accept', $request->request->get('_token'))) {
            $this->addFlash(
                'success',
                'Utilisateur accepté!'
            );
            return $this->redirectToRoute('profile', ['id' => $user->getId()]);
        }
        $this->addFlash(
            'success',
            ' Vous n\'avez pas accès à cette page!'
        );
        return $this->redirectToRoute('profile', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
    }

    /**
     * Function for show all friends
     *
     * @param MessageRepository $messageRepository
     * @return Response
     */
    #[route('/amis/afichages', name: 'friend_shows')]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas acces a cette page!')]
    public function shows(MessageRepository $messageRepository): Response 
    {
        $list = new \App\Tool\Friend($this->tokenStorage);
        return $this->render('friend/shows.html.twig', [
            'friend' => $list->liste($messageRepository)
        ]);
    }
}