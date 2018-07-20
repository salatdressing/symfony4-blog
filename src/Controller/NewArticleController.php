<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Articles;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NewArticleController extends Controller
{
    /**
     * @Route("/new/article", name="new_article")
     */
    public function index()
    {
        return $this->render('new_article/index.html.twig', [
            'page_title' => 'Neuen Artikel erstellen',
        ]);
    }

    public function newArticleForm(Request $req)
    {
        // creates a task and gives it some dummy data for this example
        $newarticle = new Articles();


        $form = $this->createFormBuilder($newarticle)
            ->add('articleTitle', TextType::class, array(
              'label' => false,
            ))
            ->add('articleContent', TextareaType::class, array(
              'label' => false
            ))
            ->add('save', SubmitType::class, array('label' => 'Beitrag veröffentlichen'))
            ->getForm();

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $newarticle = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newarticle);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('new_article/index.html.twig', array(
            'form' => $form->createView(),
            'page_title' =>'Neuen Artikel erstellen'
        ));
    }
}
