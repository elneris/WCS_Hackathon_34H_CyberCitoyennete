<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\QuestionRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user", name="user_")
 */

class UserController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param CategoryRepository $categories
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(CategoryRepository $categories)
    {
        $result = $categories->findAll();
        return $this->render('user/index.html.twig', [
            'categories' => $result,
        ]);
    }

    /**
     * @Route("/quizz", name="quizz")
     */
    public function quizz(QuestionRepository $questions)
    {
        $result = $questions->findAll();

        return $this->render('user/quizz.html.twig', [
            'questions' => $result,
        ]);
    }

    /**
     * @Route("/winner/", name="winner")
     */
    public function winner()
    {
        return $this->render('winner.html.twig');
    }
}
