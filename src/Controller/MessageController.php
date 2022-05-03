<?php

namespace App\Controller;

use App\Entity\User;
use App\Tool\Friend;
use App\Entity\Message;
use App\Form\MessageType;
use App\Tool\ForeachMessage;
use App\Handler\FormMessageHandler;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class MessageController extends AbstractController
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;
    /**
     * @var FormMessageHandler
     */
    private $formMessageHandler;
    /**
     * @var ForeachMessage
     */
    private $foreachMessage;

    public function __construct(TokenStorageInterface $tokenStorage, FormMessageHandler $formMessageHandler, ForeachMessage $foreachMessage)
    {
        $this->tokenStorage = $tokenStorage;
        $this->formMessageHandler = $formMessageHandler;
        $this->foreachMessage = $foreachMessage;
    }

    /**
     * Function for send message
     *
     * @param Post $post
     * @return Response
     */
    #[route('/message/{prenom}-{nom}', name: 'message')]
    #[ParamConverter('user', class: 'App\Entity\User', options: ['mapping' => ['prenom' => 'prenom']])]
    #[ParamConverter('user', class: 'App\Entity\User', options: ['mapping' => ['nom' => 'nom']])]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas accès à cette page')]
    public function index(User $user, ManagerRegistry $doctrine, MessageRepository $messageRepository, EntityManagerInterface $entityManager): Response
    {
        $currentId = $this->tokenStorage->getToken()->getUser();
        $entityManager = $doctrine->getManager();
        $list = new Friend($this->tokenStorage);
        $message = $entityManager->getRepository(Message::class)->findBy(['receive' => $currentId, 'send' => $user->getId()]);
        $Repository = $messageRepository->allMessage($currentId, $user->getId());
        $messageLast = $messageRepository->lastMessage($currentId, $user->getId());
        $foreach = $this->foreachMessage->foreach($message);
        if (!empty($message)) {
            if (($currentId->getUserIdentifier() == $foreach[2][0]  && $user->getEmail() == $foreach[3][0]) || ($currentId->getUserIdentifier() == $foreach[3][0] && $user->getEmail() == $foreach[2][0])) {
                $messageform = new Message();
                $form = $this->createForm(MessageType::class, $messageform);
                if ($this->formMessageHandler->index($form, $messageform, $user) == true) {
                    return $this->redirectToRoute('message', ['prenom' => $user->getPrenom(), 'nom' => $user->getNom(), '_fragment' => 'last'], Response::HTTP_SEE_OTHER);
                }
                return $this->render('message/index.html.twig', [
                    'messages' => $message,
                    'user' => $user,
                    'final1' => $foreach[0],
                    'final2' => $foreach[1],
                    'last' => $messageLast,
                    'all' => $Repository,
                    'prenom' => $list->liste($messageRepository),
                    'form' =>$form->createView()
                ]);
            }
            $this->addFlash(
                'success',
                ' Vous n\'avez pas accès à cette page!'
            );
            return $this->redirectToRoute('home');
        }
        $this->addFlash(
            'success',
            ' Vous n\'avez pas accès à cette page!'
        );
        return $this->redirectToRoute('home');
    }
}
