<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;
use Doctrine\Migrations\Configuration\EntityManager\ManagerRegistryEntityManager;

class PostController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(PostRepository $postRepository): Response
    {
        // demander tous les posts au modèle et je vais les toscker dans la variable $posts
        $posts = $postRepository->findAll();

        return $this->render('home/index.html.twig', [
            'posts' => $posts
        ]);
    }
}
