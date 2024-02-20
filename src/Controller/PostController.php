<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostController extends AbstractController
{
    #[Route('/', name: 'app_post')]
    public function home(PostRepository $postRepository): Response
    {
        $allPost = $postRepository->findAll();

        dump($allPost);
        return $this->render('post/browse.html.twig', [
            'postList' => $allPost,
        ]);
    }

    #[Route('/post/create', name: 'app_post_create', methods: "GET")]
    public function addPost(): Response
    {
        
        // affiche le formulaire
        return $this->render('post/add.html.twig');
    }

    #[Route('/post/create', name: 'app_post_create_process', methods: "POST")]
    public function addProcess(Request $request, EntityManagerInterface $entityManager): Response
    {
        
        // récupération des données
        $title = $request->request->get('title');
        $body = $request->request->get('body');
        $nbLikes = $request->request->get('nbLikes');
        $publishedAt = $request->request->get('publishedAt');
        $publishedAtObj = new DateTimeImmutable($publishedAt);

        
        // traitement du formulaire : ici ajout en BDD
        $post = new Post();
        $post->setTitle($title);
        $post->setBody($body);
        $post->setNbLikes($nbLikes);
        $post->setPublishedAt($publishedAtObj);

        // prise en compte de l'objet par Doctrine
        $entityManager->persist($post);

        // exécute les requêtes en BDD
        $entityManager->flush();
        

        // TODO validation des données
        // $messages['ok'][] = 'Post ajouté avec succès';
        $this->addFlash('ok', 'Post ajouté avec succès');
        $this->addFlash('ok', 'Non vraiment je suis fier de toi');
        
        // redirection
        return $this->redirectToRoute('app_post');
    }


    #[Route('/post/{id<\d+>}', name: 'app_post_read')]
    public function read(Post $post): Response
    {
         // le ParamConverter exécute ce code pour nous
        // $post = $postRepository->find($id);
        // if (is_null($post))
        // {
        //     return $this->createNotFoundException('post non trouvé');
        // }
        // si on arrive ici, c'est que le post existe.
        // si le post n'existait pas, le ParamConverter génère automatiquement une 404
        // attention dans le cas d'une API, on voudrait quand renvoyer du JSON



        return $this->render('post/read.html.twig', [
            'post' => $post,
        ]);;
        
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
