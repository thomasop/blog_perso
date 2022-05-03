<?php

namespace App\Controller;

use App\Entity\Post;
use App\Tool\Friend;
use App\Entity\Image;
use App\Entity\Video;
use App\Form\PostType;
use App\Tool\DeleteFile;
use App\Form\PosteditType;
use App\Handler\FormPostHandler;
use App\Repository\PostRepository;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @Route("/posts")
 */
class PostController extends AbstractController
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;
    /**
     * @var DeleteFile
     */
    private $deleteFile;
    /**
     * @var FormPostHandler
     */
    private $formPostHandler;

    public function __construct(TokenStorageInterface $tokenStorage, DeleteFile $deleteFile, FormPostHandler $formPostHandler)
    {
        $this->tokenStorage = $tokenStorage;
        $this->deleteFile = $deleteFile;
        $this->formPostHandler = $formPostHandler;
    }
    
    /**
     * Function for diplay all post and create post
     *
     * @param PostRepository $postRepository
     * @param ManagerRegistry $doctrine
     * @param MessageRepository $messageRepository
     * @param Request $request
     * @return Response
     */
    #[route('', name: 'home')]
    #[IsGranted("ROLE_USER", statusCode: 404, message: 'Vous n\'avez pas accès à cette page')]
    public function index(PostRepository $postRepository, ManagerRegistry $doctrine, MessageRepository $messageRepository, Request $request): Response
    {
        $list = new Friend($this->tokenStorage);
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        if ($this->formPostHandler->index($post, $form) == true) {
            $this->addFlash(
                'success',
                'Post créé!'
            );
            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('post/index.html.twig', [
            'posts' => $postRepository->allHasard(),
            'prenom' => $list->liste($messageRepository),
            'form' => $form->createView(),
        ]);
    }

    /**
     * Function for edit post
     *
     * @param Post $post
     * @return Response
     */
    #[route('/modification/{slug}', name: 'post_edit', methods: ["GET", "POST"])]
    #[ParamConverter('post', options: ['mapping' => ['slug' => 'slug']])]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas accès à cette page')]
    public function edit(Post $post): Response
    {
        $currentId = $this->tokenStorage->getToken()->getUser();
        if ($currentId == $post->getUser()) {
            if (!$post) {
                throw $this->createNotFoundException('Pas de commentaire trouvé avec l\'id '.$post->getId());
            }
            else {
                $form = $this->createForm(PosteditType::class, $post);
                if ($this->formPostHandler->edit($form) == true) {
                    $this->addFlash(
                        'success',
                        'Post modifié!'
                        );
                    return $this->redirectToRoute('home');
                }
                return $this->renderForm('post/edit.html.twig', [
                    'post' => $post,
                    'form' => $form,
                ]);
            }
        }
        else {
            $this->addFlash(
            'success',
            'Vous n\'avez pas accès à cette page!'
            );
        return $this->redirectToRoute('home');
        }
    }

    /**
     * Function for delete post
     *
     * @param Post $post
     * @param Request $request
     * @param EntityManagerInterface $entityManagerInterface
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    #[route('/suppression/{slug}', name: 'post_delete')]
    #[ParamConverter('post', options: ['mapping' => ['slug' => 'slug']])]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas accès à cette page')]
    public function delete(Post $post, Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $currentId = $this->tokenStorage->getToken()->getUser();
        if ($currentId == $post->getUser()) {
            if (!$post) {
                throw $this->createNotFoundException('Pas de commentaire trouvé avec l\'id '.$post->getId());
            }
            else {
                if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
                    $image = $doctrine->getManager()->getRepository(Image::class)->findBy(['post' => $post->getId()]);
                    foreach ($image as $i) {
                        $this->deleteFile->delete($i->getName());
                    }
                    $entityManager->remove($post);
                    $entityManager->flush();
                    $this->addFlash(
                        'success',
                        'Post supprimé!'
                    );
                    return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
                }
            }
        }
        $this->addFlash(
            'success',
            'Vous n\'avez pas accès à cette page!'
        );
        return $this->redirectToRoute('home');
    }
}
