<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/admin")]
class AdminController extends AbstractController
{
    #[Route('/articles/create', name: 'admin.articles.create')]
    public function index(): Response
    {
        return $this->render('Backend/Articles/create.html.twig');
    }
}
