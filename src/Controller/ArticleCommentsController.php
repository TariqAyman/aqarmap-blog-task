<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:34 PM
 * Last Modified: 11/10/21, 7:18 PM
 * Project Name: aqarmap-blog-task
 * File Name: ArticleCommentsController.php
 */

namespace App\Controller;

use App\Entity\Comment;
use App\Form\ArticleCommentType;
use App\Repository\Service\ArticleCommentService;
use App\Repository\Service\ArticleService;
use Symfony\Component\HttpFoundation\Request;

/**
 * @package App\Controller
 */
class ArticleCommentsController extends AbstractBaseController
{
    /**
     * @var ArticleService
     */
    private ArticleService $articleService;

    /**
     * @var ArticleCommentService
     */
    private ArticleCommentService $articleCommentService;

    /**
     * ArticleCommentsController constructor.
     * @param ArticleService $articleService
     * @param ArticleCommentService $articleCommentService
     */
    public function __construct(ArticleService $articleService, ArticleCommentService $articleCommentService)
    {
        $this->articleService = $articleService;
        $this->articleCommentService = $articleCommentService;
    }

    /**
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function create(int $id, Request $request)
    {
        try {
            $article = $this->articleService->find($id);
        } catch (\Exception $exception) {
            throw $this->createNotFoundException("Article not found");
        }

        $newComment = new Comment();
        $newComment->setArticle($article);

        $form = $this->createForm(ArticleCommentType::class, $newComment);

        // according to request's method (POST as submit and default GET as view form)
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                /** @var Comment $newComment */
                $newComment = $form->getData();

                $newComment->setAddedAt(new \DateTime());

                // save new article's comment
                try {
                    $this->articleCommentService->create($newComment);
                } catch (\Exception $exception) {

                    $this->addFlash('warning','Failed Create Comment');

                    return $this->redirectToRoute('article_comment_create', ['id' => $article->getId()]);
                }

                $this->addFlash('success','Success Added Comment');
            }

            return $this->redirectToRoute('article_show', ['id' => $article->getId()]);
        }

        return $this->render('comment/form.html.twig', ['form' => $form->createView()]);
    }
}
