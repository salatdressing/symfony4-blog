<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SnakeController extends Controller
{
    /**
     * @Route("/snake", name="snake")
     */
    public function index()
    {
        return $this->render('snake/index.html.twig', [
          'page_title' => 'Snake in Symfony',
          'blog_title' => 'Snake Game',
        ]);
    }
}
