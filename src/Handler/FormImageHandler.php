<?php

namespace App\Handler;

use App\Entity\Image;
use App\Entity\Post;
use App\Tool\DeleteFile;
use App\Tool\FileUploader;
use App\Tool\EntityManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class FormImageHandler
{
    /**
     * @var DeleteFile
     */
    private $deleteFile;
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var RequestStack
     */
    private $request;
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;
    /**
     * @var FileUploader
     */
    private $fileUploader;

    public function __construct(DeleteFile $deleteFile, EntityManager $entityManager, RequestStack $request, TokenStorageInterface $tokenStorage, FileUploader $fileUploader)
    {
        $this->deleteFile = $deleteFile;
        $this->entityManager = $entityManager;
        $this->request = $request;
        $this->tokenStorage = $tokenStorage;
        $this->fileUploader = $fileUploader;
    }

    public function delete(Image $image)
    {
        $this->deleteFile->delete($image->getName());
        $this->entityManager->remove($image);
    }

    /**
     * Function for add new image
     *
     * @param Image $image
     * @param FormInterface $form
     * @return boolean
     */
    public function add(Image $image, FormInterface $form): bool
    {
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $image->setUser($this->tokenStorage->getToken()->getUser());
            $picture = $form->get('name')->getData();
            $newImages = $this->fileUploader->upload($picture);
            $image->setName($newImages);
            $this->entityManager->Add($image);
            return true;
        }
       return false;
    }

    /**
     * Function for add new image in post
     *
     * @param Image $image
     * @param FormInterface $form
     * @param Post $post
     * @return boolean
     */
    public function addPost(Image $image, FormInterface $form, Post $post): bool
    {
        $form->handleRequest($this->request->getCurrentRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            $image->setUser($this->tokenStorage->getToken()->getUser());
            $image->setPost($post);
            $picture = $form->get('name')->getData();
            $newImages = $this->fileUploader->upload($picture);
            $image->setName($newImages);
            $this->entityManager->Add($image);
            return true;
        }
       return false;
    }
}