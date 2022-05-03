<?php

namespace App\Controller;

use App\Tool\Search;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    /**
     * Function for search post
     *
     * @param Request $request
     * @param UserRepository $userRepository
     * @param Search $search
     * @return Response
     */
    #[route('/search', name: 'search')]
    #[IsGranted('ROLE_USER', statusCode: 404, message: 'Vous n\'avez pas accès à cette page')]
    public function index(Request $request, UserRepository $userRepository, Search $search): Response
    {
        $donne = $request->request->get('search');
        $users = $userRepository->searchin($donne);
        $search->test($donne);
        if ($request->getMethod() == 'POST') {
            if (isset($_POST['searchbtn'])) {
                if ($users && $donne && !empty($donne) && preg_match ("/^[a-zA-z0-9]*$/", $donne)) {
                        return $this->render('post/search.html.twig', [
                        'users' => $users,
                    ]);
                }
                elseif (empty($users)) {
                    $this->addFlash(
                        'success',
                        'Pas de résultat!'
                    );
                    return $this->redirectToRoute('home');      
                }
            }
        }
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }
}