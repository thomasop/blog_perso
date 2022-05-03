<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Image;
use App\Form\ImageType;
use App\Handler\FormImageHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ImageController extends AbstractController
{
    /** @var TokenStorageInterface */
    private $tokenStorage;
    /** @var FormImageHandler*/
    private $formImageHandler;

    public function __construct(TokenStorageInterface $tokenStorage, FormImageHandler $formImageHandler)
    {
        $this->tokenStorage = $tokenStorage;
        $this->formImageHandler = $formImageHandler;
    }

    #[route('/suppression_image/{id}', name: 'delete_image', requirements: ["id" => "\d+"])]
    #[ParamConverter('image', class: 'App\Entity\Image', options: ['mapping' => ['id' => 'id']])]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas accès à cette page')]
    public function delete(Image $image, Request $request): Response
    {
        $currentId = $this->tokenStorage->getToken()->getUser();
        if ($currentId == $image->getUser()) {
            $this->formImageHandler->delete($image);
            if ($request->headers->get('referer') == 'http://127.0.0.1:8000/user/profile/' . $image->getUser()->getId()) {
                $this->addFlash(
                    'success',
                    'Image supprimé!'
                );
                return $this->redirectToRoute('profile', ['id' => $image->getUser()->getId()]);
            } elseif ($request->headers->get('referer') == 'http://127.0.0.1:8000/commentaires/affichages/' . $image->getPost()->getSlug() . '/1') {
                $this->addFlash(
                    'success',
                    'Image supprimé!'
                );
                return $this->redirectToRoute('comment', ['slug' => $image->getPost()->getSlug(), 'page' => 1]);
            }
        }
        $this->addFlash(
            'success',
            'Vous n\'avez pas acces a cette page!'
        );
        return $this->redirectToRoute('home');
    }

    #[route('/image/ajouter', name: 'add_image')]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas accès à cette page')]
    public function add(): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        if ($this->formImageHandler->add($image, $form)) {
            $this->addFlash(
                'success',
                'Image ajouté!'
            );
            return $this->redirectToRoute('profile', ['id' => $image->getUser()->getId()]);
        }
        return $this->render('image/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[route('/image/ajouter/{slug}', name: 'add_image_post')]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas accès à cette page')]
    public function addPost(Post $post): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        if ($this->formImageHandler->addPost($image, $form, $post)) {
            $this->addFlash(
                'success',
                'Image ajouté!'
            );
            return $this->redirectToRoute('comment', ['slug' => $post->getSlug(), 'page' => 1]);
        }
        return $this->render('image/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
