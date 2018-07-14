<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Articles;
use Symfony\Component\HttpFoundation\Response;

class ArticleObjectController extends Controller
{
    /**
     * @Route("/article/object", name="article_object")
     */
    public function index()
    {
        return $this->render('article_object/index.html.twig', [
            'controller_name' => 'ArticleObjectController',
        ]);
    }

    public function newArticleTest()
    {
      //holt Entity Manager von doctrine und übergibt ihn an Variable
      $entityManager = $this->getDoctrine()->getManager();
      // Neue Instanz der Klasse Articles
      $article = new Articles();

      // Paramter festlgen für Objekt
      $article->setIsFrom('Dan');
      $article->setArticleTitle('Dies ist ein Titel');
      $article->SetArticleContent('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.');


      //Doctrine mitteilen, dass ich das Objekt evtl. in die Datenbank einfügen will, noch kein Query!
      $entityManager->persist($article);

      //Führt den Query aus der bei persist() vorbereritet wurde
      $entityManager->flush();

      return new Response('Artikel erfolgreich veröffentlicht<br />Autor: ' . $article->getIsFrom() . '<br /> Titel: ' . $article->getArticleTitle());
    }
}
