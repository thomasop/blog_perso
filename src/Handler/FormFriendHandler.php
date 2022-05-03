<?php

namespace App\Handler;

use DateTime;
use App\Entity\User;
use App\Entity\Friend;
use App\Entity\Message;
use App\Tool\EntityManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class FormFriendHandler
{
    /** @var RequestStack */
    private $request;
    /** @var TokenStorageInterface */
    private $tokenStorage;
    /** @var EntityManager */
    private $entityManager;

    public function __construct(RequestStack $request, TokenStorageInterface $tokenStorage, EntityManager $entityManager)
    {
        $this->request = $request;
        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
    }

    public function add(FormInterface $form, Friend $friend, User $user, Message $message): bool
    {
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $friend->setSend($this->tokenStorage->getToken()->getUser());
            $friend->setReceive($user);
            if ($form->get('message')->getData() == null) {
                $texte = 'Salut, tu veux etre mon ami?';
                $message->setContent($texte);
            } else {
                $message->setContent($form->get('message')->getData());
            }
            $message->setSend($this->tokenStorage->getToken()->getUser());
            $message->setReceive($user);
            $this->entityManager->Add($friend);
            return true;
        }
        return false;
    }

    public function accept(Friend $friend): void
    {
        $friend->setStatut(1);
        $friend->setFriendAt(new DateTime('now'));
        $this->entityManager->Add($friend);
    }
}
