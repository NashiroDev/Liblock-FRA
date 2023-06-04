<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    #[Route("/articles", name: 'articles.index')]
    public function index(): Response
    {
        return $this->render('Frontend/Articles/index.html.twig', [
            'temp' => 'temp',
        ]);
    }

    #[Route("/articles/proposals", name: 'articles.proposals.index')]
    public function proposals(): Response
    {
        return $this->render('Frontend/Articles/proposals.html.twig', [
            'temp' => 'temp',
        ]);
    }
}