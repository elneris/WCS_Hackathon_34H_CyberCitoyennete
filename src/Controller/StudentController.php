<?php


namespace App\Controller;

use App\Entity\Classe;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClasseRepository;

class StudentController extends AbstractController
{
    /**
     * @Route("/admin/eleves/{id}", name="admin_filter_index")
     */
    public function filterClass(UserRepository $userRepository, ClasseRepository $classeRepository, Classe $classe)
    {
        $classes = $classeRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'allClasse' =>$classes,
            'allStudent' => $classe->getUsers()
        ]);
    }
}