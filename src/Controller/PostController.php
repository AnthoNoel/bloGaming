<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostController extends AbstractController
{
    #[Route('/', name: 'app_post')]
    public function home(PostRepository $postRepository): Response
    {
        $allPost = $postRepository->findAll();

        dump($allPost);
        return $this->render('post/home.html.twig', [
            'postList' => $allPost,
        ]);
    }

    #[Route('/post/create', name: 'app_post_create')]
    public function createPost(EntityManagerInterface $entityManager): Response
    {
        
        $post = new Post();
        $post->setTitle(uniqid('title-'));
        $post->setBody('body-');

        // on demande à l'entity manager de prendre en compte cette entité
        $entityManager->persist($post);


        // on demande à l'entity manager d'exécuter les requêtes
        $entityManager->flush();

        dd($post);
        return new Response();
    }

    #[Route('/post/{id}', name: 'app_post_read')]
    public function read(PostRepository $postRepository, int $id): Response
    {
        $post = $postRepository->find($id);

        dd($post);
        
    }


    #[Route('/post/edit/{id}', name: 'app_post_edit')]
    public function update(PostRepository $postRepository,EntityManagerInterface $entityManager, int $id): Response
    {
        $post = $entityManager->createQueryBuilder()
        ->update('Entity\Post', 'p')
        ->set('p.title', 'coucou')
        -set('p.body', 'test')
        ->where('p.id =' . $id)
        ->getQuery();
        $postEdit = $post->execute();

        return $this->redirectToRoute('app_post');
        
    }

    #[Route('/post/delete/{id}', name: 'app_post_remove')]
    public function remove(PostRepository $postRepository,EntityManagerInterface $entityManager, int $id): Response
    {
        
        $post = $postRepository->findOneBy(['id'=>$id]);
        
        $entityManager->remove($post);
        $entityManager->flush();

        dd($post);

        return $this->redirectToRoute('app_post');
        
    }

    
}
