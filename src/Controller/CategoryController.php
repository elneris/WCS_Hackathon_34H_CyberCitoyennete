<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/categorie", name="admin_category_")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request, CategoryRepository $categoryRepository)
    {
        return $this->render('admin/category/index.html.twig', [
            'allCategories' => $categoryRepository->findAll()
        ]);
    }

    /**
     * @Route("/ajouter", name="new")
     */
    public function new(Request $request, EntityManagerInterface $em)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'Catégorie créée');

            return $this->redirectToRoute('admin_category_new');
        }

        return $this->render('admin/category/new_category.html.twig', [
            'categoryForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="update")
     */
    public function update(Request $request, EntityManagerInterface $em,  Category $category)
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_category_index');
        }

        return $this->render('admin\category\update.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/supprimer/{id}", name="delete")
     */
    public function delete(Request $request, EntityManagerInterface $em, Category $category)
    {
        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute('admin_category_index');

    }
}