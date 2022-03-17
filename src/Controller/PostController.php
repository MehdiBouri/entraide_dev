<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comment;
use App\Repository\CommentRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    #[Route('/post/{id}', name: 'app_post', methods:['GET', 'POST'])]
    public function post(Post $post, CommentRepository $commentRepository, Request $request, EntityManagerInterface $manager)
    {

        $comments = $commentRepository->findByPost($post->getId());
        $comment = new Comment();

        $form = $this->createFormBuilder($comment)
        ->add('content', TextareaType::class,[
            'label'=> 'Ajouter un commentaire',
            'attr' => ['rows' => 4]
        ])
        ->getForm()
        ->handleRequest($request);


        if($this->getUser() && $form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new \DateTimeImmutable());
            $comment->setStatus('open');
            $comment->setUser($this->getUser());
            $comment->setPost($post);

            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('app_post', ['id' => $post->getId()]);
        }


        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
            'post' => $post,
            'comments' => $comments,
            'formComment' => $form->createView()
        ]);
    }
}
