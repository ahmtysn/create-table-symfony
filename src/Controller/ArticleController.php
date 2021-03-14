<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController
{
  /**
   * @Route("/",name="article_list")
   */
  public function index(): Response
  {
    // $articles = ['article 1', 'article 2'];
    $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
    return $this->render('articles/index.html.twig', [
      'articles' => $articles
    ]);
  }

  /**
   * @Route("/article/{id}",name="article_show")
   */
  public function show($id)
  {
    $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

    return $this->render('articles/show.html.twig', [
      'article' => $article
    ]);
  }

  /**
   * @Route("/article/save",name="save")
   */
  public function save()
  {
    $em = $this->getDoctrine()->getManager();
    $article = new Article();
    $article
      ->setTitle('Article Two')
      ->setBody('This is body of article Two!');

    $em->persist($article);
    $em->flush();

    return new Response("Saves an article with the id of {$article->getId()}");
  }
}