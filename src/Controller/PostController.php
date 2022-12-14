<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    #[Route('/', name: 'home')]
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'posts' =>  $postRepository->findAll(),
            'categories' => $this->categoryRepository->findall()
        ]);
    }

    #[Route('/Post/category/{id<[0-9]+>}', name:'index_by_category')]
    public function indexByCategory(Category $category)
    {
          return $this->render('home/index.html.twig', [
            'posts' => $category->getPosts(),
            'categories' => $this->categoryRepository->findall()
        ]); 
    }

    #[Route('/Post/search}', name:'index_by_search')]
    public function indexBySearch(Request $request, PostRepository $postRepository)
    {
        $search = $request->request->get('search');

        $posts = $postRepository->findAllBysearch($search);
                
        return $this->render('home/index.html.twig', [
            'posts' => $posts,
            'categories' => $this->categoryRepository->findall()
        ]); 
    }

    #[Route('/post/{id<[0-9]+>}')]
    public function show(Post $post): Response
    {
        return $this->render('home/show.html.twig', [
            'post' => $post
        ]);
    }
}
