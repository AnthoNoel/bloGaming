<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MiniGameController extends AbstractController
{
    #[Route('/minigames', name: 'app_minigames', methods: "GET")]
    public function miniGamesList(AuthorRepository $authorRepository): Response
    {
        
        // affiche le formulaire
        return $this->render('minigames/index.html.twig');
    }

    #[Route('/minigames/snake', name: 'app_minigames_snake', methods: "GET")]
    public function miniGameSnake(AuthorRepository $authorRepository): Response
    {
        
        // affiche le formulaire
        return $this->render('minigames/snake.html.twig');
    }
}
