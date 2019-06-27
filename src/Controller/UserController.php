<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user_index")
     * @param CategoryRepository $categories
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(CategoryRepository $categories)
    {
        $result = $categories->findAll();
        return $this->render('user/index.html.twig', [
            'categories' => $result,
        ]);
    }
}
