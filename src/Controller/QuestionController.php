<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("admin/quizz", name="admin_quizz")
     */
 public function show()
 {
     return $this->render('user/question.html.twig');
 }

}