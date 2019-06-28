<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\User;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/classe/ajouter", name="create_classe")
     */
    public function createClasse(Request $request, EntityManagerInterface $manager)
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($classe);
            $manager->flush();

            $this->addFlash(
                'success',
                'Classe bien créée'
            );
            return $this->redirectToRoute('admin_index');
        }

        return $this->render('class/createClasse.html.twig',[
            'classeForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/classe", name="admin_classe")
     */
    public function classe(ClasseRepository $classeRepository)
    {
        return $this->render('admin/classe.html.twig', [
            'allClasse' => $classeRepository->findAll()
        ]);
    }
}
