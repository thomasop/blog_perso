<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Video;
use App\Form\VideoType;
use App\Form\VideoaddType;
use App\Tool\EntityManager;
use App\Tool\VideoIdExtractor;
use App\Handler\FormVideoHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class VideoController extends AbstractController
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;
    /**
     * @var FormVideoHandler
     */
    private $formVideoHandler;

    public function __construct(TokenStorageInterface $tokenStorage, FormVideoHandler $formVideoHandler)
    {
        $this->tokenStorage = $tokenStorage;
        $this->formVideoHandler = $formVideoHandler;
    }
    
    /**
     * Function for delete video
     *
     * @param Video $video
     * @param EntityManager $entityManager
     * @param Request $request
     * @return Response
     */
    #[route('/suppression_video/{id}', name: 'delete_video', requirements: ["id" => "\d+"])]
    #[ParamConverter('video', class: 'App\Entity\Video', options: ['mapping' => ['id' => 'id']])]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas accès à cette page')]
    public function delete(Video $video, EntityManager $entityManager, Request $request): Response
    {
        $currentId = $this->tokenStorage->getToken()->getUser();
        if ($currentId == $video->getUser()) {
            $entityManager->remove($video);
            if ($request->headers->get('referer') == 'http://127.0.0.1:8000/user/profile/' . $video->getUser()->getId()) {
                $this->addFlash(
                'success',
                'Video supprimé!'
                );
                return $this->redirectToRoute('profile', ['id' => $video->getUser()->getId()]);
            }
            elseif ($request->headers->get('referer') == 'http://127.0.0.1:8000/commentaires/affichages/' . $video->getPost()->getSlug() . '/1'){
                $this->addFlash(
                'success',
                'Video supprimé!'
                );
                return $this->redirectToRoute('comment', ['slug' => $video->getPost()->getSlug(), 'page' => 1]);
            }
        }
        $this->addFlash(
            'success',
            'Vous n\'avez pas acces a cette page!'
        );
        return $this->redirectToRoute('home');
    }

    /**
     * Function for add video
     *
     * @param Post $post
     * @return Response
     */
    #[route('/video/ajouter', name: 'add_video')]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas accès à cette page')]
    public function add(): Response
    {
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        if ($this->formVideoHandler->add($form, $video) == true) {
            $this->addFlash(
                'success',
                'Video ajouté!'
            );
            return $this->redirectToRoute('profile', ['id' => $video->getUser()->getId()]);
        }
        return $this->render('video/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Function for add video in post
     *
     * @param Post $post
     * @return Response
     */
    #[route('/video/ajouter/{slug}', name: 'add_video_post')]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas accès à cette page')]
    public function addPost(Post $post): Response
    {
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        if ($this->formVideoHandler->addPost($form, $video, $post) == true) {
            $this->addFlash(
                'success',
                'Video ajouté!'
            );
            return $this->redirectToRoute('comment', ['slug' => $post->getSlug(), 'page' => 1]);
        }
        return $this->render('video/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}