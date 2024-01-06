<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    #[Route('/blog/{id}/{name}', name: 'app_blog', requirements: ["name" => "[a-zA-Z]{5,50}"])]
    public function index(int $id, string $name): Response
    {
        return $this->render('blog/index.html.twig', [
            'id' => $id,
            'name' => $name
        ]);
    }

    #[Route('/', name: 'hello_world')]
    public function helloWorld(CategoryRepository $repoCate): Response
    {
        $categories = $repoCate->findAll();
        return $this->render('blog/hello.html.twig', [
            'controller_name' => 'Hello World',
            'categories' => $categories
        ]);
    }

    #[Route('/blog/articles', name: 'app_blog_articles')]
    public function showArticles(ArticleRepository $repoArticle, CategoryRepository $repoCate): Response
    {
        $articles = $repoArticle->findAll();
        $categories = $repoCate->findAll();
        // dd($articles);
        return $this->render('blog/index.html.twig', [
            'articles' => $articles,
            'categories' => $categories
        ]);
    }

    #[Route('/article/{slug}',  name: 'app_single_article')]
    public function single(ArticleRepository $repoArticle, CategoryRepository $repoCate, string $slug): Response
    {
        $article = $repoArticle->findOneBySlug($slug);
        $categories = $repoCate->findAll();
        return $this->render('blog/single.html.twig', ['article' => $article, 'categories' => $categories]);
    }

    #[Route('/blog/category/{slug}', name: 'app_articles_by_category')]
    public function cateById(CategoryRepository $repoCate, string $slug): Response
    {
        $category = $repoCate->findOneBySlug($slug);
        $categories = $repoCate->findAll();
        $articles = [];
        if (isset($category)) {
            $articles = $category->getArticles();
        }
        return $this->render('blog/articles_by_categories.html.twig', [
            'category' => $category,
            'categories' => $categories,
            'articles' => $articles
        ]);
    }
}
