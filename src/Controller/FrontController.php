<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    public function __construct(
        private readonly ArticlesRepository $articlesRepo
    )
    {}

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $articlesContent = $this->articlesRepo->getLastArticlesByStatus(5, 'accepted');
        $proposalsContent = $this->articlesRepo->getLastArticlesByStatus(20, 'on going');

        return $this->render('Frontend/index.html.twig', [
            'articles' => $articlesContent,
            'proposals' => $proposalsContent,
        ]);
    }

    #[Route("/articles", name: 'articles.index')]
    public function articles(): Response
    {
        return $this->render('Frontend/Articles/index.html.twig', [
            'temp' => 'temp',
        ]);
    }

    #[Route("/articles/proposals", name: 'proposals.index')]
    public function proposals(): Response
    {
        return $this->render('Frontend/Articles/proposals.html.twig', [
            'temp' => 'temp',
        ]);
    }
}