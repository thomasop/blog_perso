<?php

namespace App\Controller;

use App\Entity\Post;
use App\Tool\Friend;
use App\Tool\Paging;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Handler\FormCommentHandler;
use App\Repository\ImageRepository;
use App\Repository\CommentRepository;
use App\Repository\MessageRepository;
use App\Repository\VideoRepository;
use App\Tool\EntityManager as ToolEntityManager;
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
 * @Route("/commentaires")
 */
class CommentController extends AbstractController
{
    private $tokenStorage;
    private $formCommentHandler;

    public function __construct(TokenStorageInterface $tokenStorage, FormCommentHandler $formCommentHandler)
    {
        $this->tokenStorage = $tokenStorage;
        $this->formCommentHandler = $formCommentHandler;
    }
    
    /**
     * Function for display one post and all comment
     *
     * @param Post $post
     * @param int $page
     * @param CommentRepository $commentRepository
     * @param ImageRepository $imageRepository
     * @param MessageRepository $messageRepository
     * @param VideoRepository $videoRepository
     * @return Response
     */
    #[route('/affichages/{slug}/{page}', name: 'comment')]
    #[ParamConverter('post', class: 'App\Entity\Post', options: ['mapping' => ['slug' => 'slug']])]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas accès à cette page')]
    public function post(Post $post, $page, CommentRepository $commentRepository, ImageRepository $imageRepository, MessageRepository $messageRepository, VideoRepository $videoRepository): Response
    {
        $list = new Friend($this->tokenStorage);
        $pagination = new Paging();
        $comment = new Comment();
        $commentP = $commentRepository->findByPostAndPaginate($post, $page, 5);
        $form = $this->createForm(CommentType::class, $comment);
        $image = $imageRepository->findBy(['post' => $post], ['id' => 'ASC']);
        $video = $videoRepository->findBy(['post' => $post], ['id' => 'ASC']);
        if ($this->formCommentHandler->post($form, $comment, $post) == true)
        {
            $this->addFlash(
                'success',
                'Commentaire ajouté!'
            );
            return $this->redirectToRoute('comment', ['slug' => $post->getSlug(), 'page' => $page]);
        }
        return $this->render('comment/post.html.twig', [
            'comments' => $commentP,
            'pagination' =>  $pagination->pagingComments($page, $commentP),
            'post' => $post,
            'form' => $form->createView(),
            'image' => $image,
            'video' => $video,
            'prenom' => $list->liste($messageRepository),
        ]);
    }

    /**
     * Function for edit comment
     *
     * @param Post $post
     * @param Comment $comment
     * @return Response
     */
    #[route('/modification/{id}/{slug}', name: 'comment_edit', methods: ["GET", "POST"])]
    #[ParamConverter('comment', class: 'App\Entity\comment', options: ['mapping' => ['id' => 'id']])]
    #[ParamConverter('post', class: 'App\Entity\Post', options: ['mapping' => ['slug' => 'slug']])]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas accès à cette page')]
    public function edit(Comment $comment, Post $post): Response
    {
        $currentId = $this->tokenStorage->getToken()->getUser();
        if ($currentId == $comment->getUser()) {
            if (!$comment) {
                throw $this->createNotFoundException('Pas de commentaire trouvé avec l\'id '.$comment->getId());
            }
            else {
                $form = $this->createForm(CommentType::class, $comment);
                if ($this->formCommentHandler->edit($form) == true) {
                    return $this->redirectToRoute('comment', ['slug' => $post->getSlug(), 'page' => 1], Response::HTTP_SEE_OTHER);
                }
                return $this->renderForm('comment/edit.html.twig', [
                    'comment' => $comment,
                    'form' => $form,
                    'post' => $post,
                ]);
            }
        }    
        $this->addFlash(
            'success',
            ' Vous n\'avez pas acces à cette page!'
        );
        return $this->redirectToRoute('home');
    }

    /**
     * Function for delete comment
     *
     * @param Request $request
     * @param Comment $comment
     * @param Post $post
     * @param ToolEntityManager $toolEntityManager
     * @return Response
     */
    #[route('/suppression/{id}/{slug}', name: 'comment_delete')]
    #[ParamConverter('comment', class: 'App\Entity\comment', options: ['mapping' => ['id' => 'id']])]
    #[ParamConverter('post', class: 'App\Entity\Post', options: ['mapping' => ['slug' => 'slug']])]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas accès à cette page')]
    public function delete(Request $request, Comment $comment, Post $post, ToolEntityManager $entityManager): Response
    {
        $currentId = $this->tokenStorage->getToken()->getUser();
        if ($currentId == $comment->getUser()) {
            if (!$comment) {
                throw $this->createNotFoundException('Pas de commentaire trouvé avec l\'id '.$comment->getId());
            }
            else {
                if ($this->isCsrfTokenValid('delete' . $comment->getId(), $request->request->get('_token'))) {
                    $entityManager->remove($comment);
                    $this->addFlash(
                        'success',
                        'Commentaire supprimé!'
                    );
                    return $this->redirectToRoute('comment', ['slug' => $post->getSlug(), 'page' => 1]);
                }
            }
        }
        $this->addFlash(
            'success',
            ' Vous n\'avez pas accès à cette page!'
        );
        return $this->redirectToRoute('comment', ['slug' => $post->getSlug(), 'page' => 1], Response::HTTP_SEE_OTHER);
    }
}
