<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticlesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route("/admin")]
class AdminController extends AbstractController
{
    #[Route('/articles/create', name: 'admin.articles.create')]
    public function createArticle(Request $request): Response
    {
        $article = new Articles();

        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);
        
        return $this->render('Backend/Articles/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
