<?php

namespace App\Handler;

use App\Entity\User;
use App\Entity\Message;
use App\Tool\EntityManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class FormMessageHandler
{
    /**
     * @var RequestStack
     */
    private $request;
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(RequestStack $request, EntityManager $entityManager, TokenStorageInterface $tokenStorage)
    {
        $this->request = $request;
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Function for send message
     *
     * @param FormInterface $form
     * @param Message $messageform
     * @param User $user
     * @return boolean
     */
    public function index(FormInterface $form, Message $messageform, User $user): bool
    {
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $messageform->setSend($this->tokenStorage->getToken()->getUser());
            $messageform->setReceive($user);
            $this->entityManager->Add($messageform);
            return true;
        }
        return false;
    }
}