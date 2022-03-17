<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    #[Route('/post/{id}', name: 'app_post', methods:['GET'])]
    public function addQuestion(Post $post)
    {   
            
            return $this->render('post/index.html.twig', [
                'controller_name' => 'PostController',
            ]);
        



    }
   
}
