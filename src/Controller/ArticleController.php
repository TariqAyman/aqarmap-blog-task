<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:35 PM
 * Last Modified: 11/10/21, 7:18 PM
 * Project Name: aqarmap-blog-task
 * File Name: ArticleController.php
 */

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\Service\ArticleService;
use App\Repository\Service\CategoryService;
use App\Repository\Service\Interfaces\ActiveRecordInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package App\Controller
 */
class ArticleController extends AbstractBaseController
{
    /**
     * @var ArticleService
     */
    private ArticleService $articleService;

    /**
     * @var CategoryService
     */
    private CategoryService $categoryService;

    /**
     * ArticleController constructor.
     * @param ArticleService $articleService
     * @param CategoryService $categoryService
     */
    public function __construct(ArticleService $articleService, CategoryService $categoryService)
    {
        $this->articleService = $articleService;
        $this->categoryService = $categoryService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $categoryId = $request->query->get('category', null);

        if ($categoryId) {
            $articles = $this->articleService->findByCategoryId($categoryId);
        } else {
            $articles = $this->articleService->findByCriteria([], ActiveRecordInterface::DEFAULT_COUNTER, 0, ActiveRecordInterface::DESC, 'publishedAt');
        }

        return $this->render('article/index.html.twig', ['articles' => $articles]);
    }

    /**
     * @param int $id article's id value
     * @return Response
     */
    public function show(int $id): Response
    {
        try {
            $article = $this->articleService->find($id);
        } catch (\Exception $exception) {
            throw $this->createNotFoundException("Article not found");
        }

        return $this->render('article/show.html.twig', ['article' => $article]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $categories = $this->categoryService->findByCriteria([]);

        $newArticle = new Article();

        $form = $this->createForm(ArticleType::class, $newArticle, ['categoriesOptions' => $categories]);
        // according to request's method (POST as submit and default GET as view form)
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                /** @var Article $newArticle */
                $newArticle = $form->getData();

                $newArticle->setAuthor($this->getUser());
                $newArticle->setPublishedAt(new \DateTime());

                // save new article
                try {
                    $this->articleService->create($newArticle);
                } catch (\Exception $exception) {
                    $this->addFlash('warning','Failed Create Article');

                    return $this->redirectToRoute('article_create');
                }

                $this->addFlash('success','Success Create Article');
                return $this->redirectToRoute('article_show', ['id' => $newArticle->getId()]);
            }

            return $this->redirectToRoute('article_create');
        }

        return $this->render('article/form.html.twig', ['form' => $form->createView()]);
    }
}
