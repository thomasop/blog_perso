<?php

namespace App\Controller;

use App\Entity\Post;
use App\Tool\Friend;
use App\Repository\PostRepository;
use App\Repository\MessageRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class HasardController extends AbstractController
{
    /** @var TokenStorageInterface */
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    #[route('/hasard', name: 'hasard')]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas accès à cette page')]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->hasard();
        return $this->redirectToRoute('hasardtest', ['slug' => $posts[0]->getSlug()]);
    }

    #[route('/hasard/{slug}', name: 'hasardtest')]
    #[ParamConverter('post', class: 'App\Entity\Post', options: ['mapping' => ['slug' => 'slug']])]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas accès à cette page')]
    public function indexx(Post $post, MessageRepository $messageRepository): Response
    {
        $list = new Friend($this->tokenStorage);
        return $this->render('hasard/index.html.twig', [
            'post' => $post,
            'prenom' => $list->liste($messageRepository),
        ]);
    }
}
