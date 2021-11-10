<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:36 PM
 * Last Modified: 11/9/21, 11:08 PM
 * Project Name: aqarmap-blog-task
 * File Name: HomeController.php
 */
declare(strict_types=1);

namespace App\Controller;

use App\Repository\Service\ArticleService;
use App\Repository\Service\CategoryService;
use App\Repository\Service\Interfaces\ActiveRecordInterface;

/**
 * @package App\Controller
 */
class HomeController extends AbstractBaseController
{
    /**
     * @var CategoryService
     */
    private CategoryService $categoryService;

    /**
     * @var ArticleService
     */
    private ArticleService $articleService;

    /**
     * HomeController constructor.
     * @param CategoryService $categoryService
     * @param ArticleService  $articleService
     */
    public function __construct(CategoryService $categoryService, ArticleService $articleService)
    {
        $this->categoryService = $categoryService;
        $this->articleService  = $articleService;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $articles = $this->articleService->findByCriteria([], 10, 0,ActiveRecordInterface::DESC, 'publishedAt');

        $categories = $this->categoryService->findByCriteria([]);

        return $this->render(
            'home/index.html.twig',
            ['articles' => $articles, 'categories' => $categories]
        );
    }
}

