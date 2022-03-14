<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }



   #[Route('/post/{id}', name: 'app_test')]
    public function show(int $id, PostRepository $postRepository): Response
    {
        $posts = $postRepository
            ->findOrderBy();
            
        // ...
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
            'posts'=> $posts
        ]);
    }
}