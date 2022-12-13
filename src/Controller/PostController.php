<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(PostRepository $postRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'posts' =>  $postRepository->findAll(),
            'categories' => $categoryRepository->findall()
        ]);
    }

    #[Route('/Post/category/{id<[0-9]+>}', name:'index_by_category')]
    public function indexByCategory($id, CategoryRepository $categoryRepository, PostRepository $postRepository)
    {
        $category = $categoryRepository->find($id);
        $postsByCategory = $category->getPosts();

        return $this->render('home/index.html.twig', [
            'posts' => $postsByCategory,
            'categories' => $categoryRepository->findall()
        ]); 


        // $category  = $categoryRepository->find($id);

        // $posts = $postRepository->findAll();

        // $postsByCategory = [];

        // foreach($posts as $post) {
        //     if($post->getCategories()->contains($category)) {
        //         $postsByCategory[] = $post;
        //     }
        // }

        // return $this->render('home/index.html.twig', [
        //     'posts' => $postsByCategory,
        //     'categories' => $categoryRepository->findall()
        // ]);
    }

    #[Route('/post/{id<[0-9]+>}')]
    public function show(Post $post): Response
    {
        return $this->render('home/show.html.twig', [
            'post' => $post
        ]);
    }
}
