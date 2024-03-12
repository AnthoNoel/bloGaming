<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main', methods: "GET")]
    public function main(AuthorRepository $authorRepository): Response
    {
        
        // affiche le formulaire
        return $this->render('main/main.html.twig');
    }
}
