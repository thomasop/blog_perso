<?php

namespace App\Handler;

use App\Entity\Post;
use App\Entity\Video;
use App\Tool\EntityManager;
use App\Tool\VideoIdExtractor;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class FormVideoHandler
{
    /** @var EntityManager */
    private $entityManager;
    /** @var RequestStack */
    private $request;
    /** @var TokenStorageInterface */
    private $tokenStorage;

    public function __construct(EntityManager $entityManager, RequestStack $request, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->request = $request;
        $this->tokenStorage = $tokenStorage;
    }

    public function add(FormInterface $form, Video $video): bool
    {
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $video->setUser($this->tokenStorage->getToken()->getUser());
            $videoIdExtractor = new VideoIdExtractor();
            $video->setUrl($videoIdExtractor->urlToId($video->getUrl()));
            $this->entityManager->Add($video);
            return true;
        }
        return false;
    }

    public function addPost(FormInterface $form, Video $video, Post $post): bool
    {
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $video->setUser($this->tokenStorage->getToken()->getUser());
            $video->setPost($post);
            $videoIdExtractor = new VideoIdExtractor();
            $video->setUrl($videoIdExtractor->urlToId($video->getUrl()));
            $this->entityManager->Add($video);
            return true;
        }
        return false;
    }
}
