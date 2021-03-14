<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController
{
  /**
   * @Route("/",name="home")
   */
  public function index(): Response
  {
    $articles = ['article 1', 'article 2'];
    return $this->render('article/index.html.twig', [
      'articles' => $articles
    ]);
  }
}