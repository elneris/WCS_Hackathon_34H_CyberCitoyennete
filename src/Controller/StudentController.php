<?php


namespace App\Controller;

use App\Entity\Classe;
use App\Entity\User;
use App\Repository\QuestionRepository;
use App\Repository\TentativeRepository;
use App\Repository\UserRepository;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
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
    public function filterClass(UserRepository $userRepository, ClasseRepository $classeRepository, Classe $classe, TentativeRepository $tentativeRepository)
    {
        $goodAnswer=0;
        $badAnswer=0;

        $answers =  $tentativeRepository->findAll();

        foreach ($answers as $answer) {
            if ( $answer->getUser()->getClass()->getId() === $classe->getId()) {
                ($answer->getResponse()) ? $goodAnswer++ : $badAnswer++;
            }
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

        $classes = $classeRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'allClasse' =>$classes,
            'allStudent' => $classe->getUsers(),
            'piechart' => $pieChart
        ]);
    }

    /**
     * @Route("/profil/{id}", name="admin_student_profil")
     */
    public function profil(User $user, TentativeRepository $tentativeRepository, QuestionRepository $questionRepository)
    {

        $answers =  $tentativeRepository->findBy(['user' => $user->getId()]);

        $goodAnswer=0;
        $badAnswer=0;

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
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(800);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(22);

        return $this->render('admin/student/profil.html.twig', [
            'controller_name' => 'AdminController',
            'user' => $user,
            'answers' => $answers,
            'piechart' => $pieChart
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