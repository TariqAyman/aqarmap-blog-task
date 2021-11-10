<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:36 PM
 * Last Modified: 11/10/21, 7:14 PM
 * Project Name: aqarmap-blog-task
 * File Name: CategoryController.php
 */

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\Service\CategoryService;
use Symfony\Component\HttpFoundation\Request;

/**
 * @package App\Controller
 */
class CategoryController extends AbstractBaseController
{
    /**
     * @var CategoryService
     */
    private CategoryService $categoryService;

    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService category service instance
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Listing all possible categories
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        $categories = $this->categoryService->findByCriteria([]);

        return $this->render('category/index.html.twig', ['categories' => $categories]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $newCategory = new Category();

        $form = $this->createForm(CategoryType::class, $newCategory);

        if ($request->isMethod('POST')) {

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                /** @var Category $newCategory */
                $newCategory = $form->getData();

                // save new category
                try {
                    $this->categoryService->create($newCategory);
                } catch (\Exception $exception) {

                    $this->addFlash('warning','Failed Create Category');
                    return $this->redirectToRoute('category_create');
                }

                $this->addFlash('success','Success Added Category');
            }

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/form.html.twig', ['form' => $form->createView()]);
    }
}

