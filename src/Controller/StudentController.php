<?php


namespace App\Controller;

use App\Entity\Classe;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClasseRepository;

/**
 * @Route("/admin/eleves")
 */
class StudentController extends AbstractController
{
     /**
     * @Route("/{id}", name="admin_filter_index")
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

    /**
     * @Route("/profil/{id}", name="admin_student_profil")
     */
    public function profil(User $user)
    {

        return $this->render('admin/student/profil.html.twig', [
            'controller_name' => 'AdminController',
            'user' => $user
        ]);
    }

    /**
     * @Route("/profil/info/{id}", name="admin_student_info")
     */
    public function updateProfil(User $user)
    {
        $user->setLastname($_POST['last_name']);
        $user->setFirstname($_POST['first_name']);
        $user->setLogin($_POST['login']);

        $this->getDoctrine()->getManager()->flush();

        return $this->render('admin/student/profil.html.twig', [
            'controller_name' => 'AdminController',
            'user' => $user
        ]);
    }



}