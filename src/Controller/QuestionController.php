<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\QuestionType;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/question", name="admin_")
 */
class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="question")
     */
 public function index(Request $request, QuestionRepository $questionRepository)
 {
     return $this->render('admin/question/question.html.twig', [
         'allQuestions' => $questionRepository->findAll()
     ]);
 }
    /**
     * @Route("/ajouter", name="new")
     */
  public function new(Request $request, EntityManagerInterface $em)
  {
      $question = new Question();
      $form = $this->createForm(QuestionType::class, $question);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $em->persist($question);
          $em->flush();

          $this->addFlash('success', 'Question créée');

          return $this->redirectToRoute('admin_question');
      }

      return $this->render('admin/question/new_question.html.twig', [
          'questionForm' => $form->createView()
      ]);
  }

}