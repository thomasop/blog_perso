<?php

namespace App\Handler;

use App\Entity\Comment;
use App\Entity\Post;
use App\Tool\EntityManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class FormCommentHandler
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var RequestStack
     */
    private $request;

    public function __construct(TokenStorageInterface $tokenStorage, RequestStack $request, EntityManager $entityManager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
        $this->request = $request;
    }
    
    /**
     * Function for add new comment
     *
     * @param FormInterface $form
     * @param Comment $comment
     * @param Post $post
     * @return boolean
     */
    public function post(FormInterface $form, Comment $comment, Post $post): bool
    {
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUser($this->tokenStorage->getToken()->getUser());
            $comment->setPost($post);
            $this->entityManager->Add($comment);
            return true;
        }
        return false;
    }

    /**
     * Function for edit comment
     *
     * @param FormInterface $form
     * @return boolean
     */
    public function edit(FormInterface $form): bool
    {
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->update();
            return true;
        }
        return false;
    }
}