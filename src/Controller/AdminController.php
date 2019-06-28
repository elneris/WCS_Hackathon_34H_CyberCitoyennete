<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\User;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use App\Repository\TentativeRepository;
use App\Repository\UserRepository;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_index")
     */
    public function index(UserRepository $userRepository, ClasseRepository $classeRepository, TentativeRepository $tentativeRepository)
    {
        $answers =  $tentativeRepository->findAll();

        $goodAnswer=0;
        $badAnswer=0;

        $totalAnswers= [];

        foreach ($answers as $answer) {
            ($answer->getResponse()) ? $goodAnswer++ : $badAnswer++;
        }

        $pieChart = new PieChart();

        $pieChart->getData()->setArrayToDataTable(
            [['Task', 'Hours per Day'],
                ['Bonnes réponses',     $goodAnswer],
                ['Mauvaises réponses',      $badAnswer],
            ]
        );
        $pieChart->getOptions()->setTitle('Taux de réussite');
        $pieChart->getOptions()->setHeight(600);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(22);


        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'allStudent' => $userRepository->findAll(),
            'allClasse' => $classeRepository->findAll(),
            'piechart' => $pieChart
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
