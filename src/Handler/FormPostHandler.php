<?php

namespace App\Handler;

use App\Entity\Post;
use App\Entity\Image;
use App\Tool\VideoFactory;
use App\Tool\EntityManager;
use App\Tool\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class FormPostHandler
{
    /** @var EntityManager */
    private $entityManager;
    /** @var RequestStack */
    private $request;
    /** @var TokenStorageInterface */
    private $tokenStorage;
    /** @var FileUploader */
    private $fileUploader;
    /** @var EntityManagerInterface */
    private $entityManagerInterface;

    public function __construct(EntityManager $entityManager, RequestStack $request, TokenStorageInterface $tokenStorage, FileUploader $fileUploader, EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManager;
        $this->request = $request;
        $this->tokenStorage = $tokenStorage;
        $this->fileUploader = $fileUploader;
        $this->entityManagerInterface = $entityManagerInterface;
    }

    public function index(Post $post, FormInterface $form): bool
    {
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setUser($this->tokenStorage->getToken()->getUser());
            $picture = $form->get('images')->getData();
            foreach ($picture as $image) {
                $newImages = $this->fileUploader->upload($image);

                $img = new Image();
                $img->setName($newImages);
                $img->setUser($this->tokenStorage->getToken()->getUser());
                $img->setPost($post);
                $this->entityManagerInterface->persist($img);
            }
            $posts = $form->getData();
            $videosCollection = $form->getData()->getVideos()->toArray();
            VideoFactory::set($videosCollection, $posts, $this->tokenStorage->getToken()->getUser());
            $this->entityManagerInterface->persist($post);
            $this->entityManagerInterface->flush();
            return true;
        }
        return false;
    }

    public function edit(FormInterface $form): bool
    {
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->update();
            return true;
        }
        return false;
    }

    public function delete(Post $post): void
    {
        $this->entityManager->remove($post);
    }
}
