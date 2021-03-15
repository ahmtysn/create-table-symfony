<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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
   * @Route("/article/new",name="new_article")
   */
  public function new(Request $request)
  {
    $article = new Article();
    $form = $this->createFormBuilder($article)
      ->add('title', TextType::class,  ['attr' => ['class' => 'form-control']])
      ->add('body', TextareaType::class,  ['required' => false, 'attr' => ['class' => 'form-control']])
      ->add('save', SubmitType::class,  ['label' => 'Create', 'attr' => ['class' => 'btn btn-primary mt-3']])
      ->getForm();

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $article = $form->getData();
      $em = $this->getDoctrine()->getManager();
      $em->persist($article);
      $em->flush();
      return $this->redirectToRoute('article_list');
    }

    return $this->render('articles/new.html.twig', [
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/article/edit/{id}",name="edit_article")
   */
  public function edit(Request $request, $id)
  {
    $article = new Article();
    $article = $this->getDoctrine()->getRepository(Article::class)->find($id);



    $form = $this->createFormBuilder($article)
      ->add('title', TextType::class,  ['attr' => ['class' => 'form-control']])
      ->add('body', TextareaType::class,  ['required' => false, 'attr' => ['class' => 'form-control']])
      ->add('save', SubmitType::class,  ['label' => 'Update', 'attr' => ['class' => 'btn btn-primary mt-3']])
      ->getForm();

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->flush();
      return $this->redirectToRoute('article_list');
    }

    return $this->render('articles/edit.html.twig', [
      'form' => $form->createView()
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
   * @Route("/article/delete/{id}",name="article_delete")
   */
  public function delete(Request $request, $id)
  {
    $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
    $em = $this->getDoctrine()->getManager();
    $em->remove($article);
    $em->flush();

    return $this->redirectToRoute('article_list');
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