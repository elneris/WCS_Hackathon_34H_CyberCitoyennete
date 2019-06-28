<?php


namespace App\Controller;


use App\Entity\Category;
use App\Entity\Progression;
use App\Entity\Tentative;
use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\ProgressionRepository;
use App\Repository\QuestionRepository;
use App\Repository\TentativeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class Progression4Controller extends AbstractController
{
    /**
     * @Route("/user/category4/{id}", name="user_questionnaire")
     */
    public function progression4Init(User $user, EntityManagerInterface $em, ProgressionRepository $progressionRepository)
    {
        $allProgression = $progressionRepository->findAll();
        $count = 0;
        foreach ($allProgression as $progressions){
            if ($user->getCategoryStep()->getId() === $progressions->getCategory()->getId() && $user->getId() === $progressions->getUser()->getId()){
                $count++;
            }
        }

        if ($count == 0 ){
            $progression = new Progression();
            $progression->setUser($user);
            $progression->setCategory($user->getCategoryStep());
            $progression->setValid(false);
            $em->persist($progression);
            $em->flush();

        }

        return $this->redirectToRoute('user_question41');
    }

    /**
     * @Route("/user/question-41", name="user_question41")
     */
    public function question41(QuestionRepository $questionRepository)
    {
        $question = $questionRepository->findOneBy(['id' => 4]);

        return $this->render('question/categorie4/question1.html.twig', [
            'question' => $question
        ]);
    }

    /**
     * @Route("/user/question-42/{value}/{id}", name="user_question42")
     */
    public function question42(QuestionRepository $questionRepository, $value, $id, EntityManagerInterface $em, UserRepository $userRepository, TentativeRepository $tentativeRepository)
    {
        $user = $userRepository->findOneBy(['id' => $id]);

        $allTentative = $tentativeRepository->findAll();

        foreach ($allTentative as $tentatives){
            if ($user->getId() === $tentatives->getUser()->getId() && $questionRepository->findOneBy(['id' => 4])->getId() === $tentatives->getQuestion()->getId()){
                $em->remove($tentatives);
            }
        }

        $tentative = new Tentative();
        $tentative->setUser($user);
        $tentative->setQuestion($questionRepository->findOneBy(['id' => 4]));
        if ($value == 0){
            $tentative->setResponse(false);
        } else {
            $tentative->setResponse(true);
        }

        $em->persist($tentative);
        $em->flush();

        $question = $questionRepository->findOneBy(['id' => 5]);

        return $this->render('question/categorie4/question2.html.twig', [
            'question' => $question
        ]);

    }

    /**
     * @Route("/user/question-43/{value}/{id}", name="user_question43")
     */
    public function question3(QuestionRepository $questionRepository, $value, $id, EntityManagerInterface $em, UserRepository $userRepository, TentativeRepository $tentativeRepository)
    {
        $user = $userRepository->findOneBy(['id' => $id]);

        $allTentative = $tentativeRepository->findAll();

        foreach ($allTentative as $tentatives){
            if ($user->getId() === $tentatives->getUser()->getId() && $questionRepository->findOneBy(['id' => 5])->getId() === $tentatives->getQuestion()->getId()){
                $em->remove($tentatives);
            }
        }

        $tentative = new Tentative();
        $tentative->setUser($user);
        $tentative->setQuestion($questionRepository->findOneBy(['id' => 5]));
        if ($value == 0){
            $tentative->setResponse(false);
        } else {
            $tentative->setResponse(true);
        }

        $em->persist($tentative);
        $em->flush();

        $question = $questionRepository->findOneBy(['id' => 6]);

        return $this->render('question/categorie4/question3.html.twig', [
            'question' => $question
        ]);

    }

    /**
     * @Route("/user/resultat4/{value}/{id}", name="user_result4")
     */
    public function result(CategoryRepository $categoryRepository, ProgressionRepository $progressionRepository, QuestionRepository $questionRepository, $value, $id, EntityManagerInterface $em, UserRepository $userRepository, TentativeRepository $tentativeRepository)
    {
        $user = $userRepository->findOneBy(['id' => $id]);

        $allTentative = $tentativeRepository->findAll();

        foreach ($allTentative as $tentatives){
            if ($user->getId() === $tentatives->getUser()->getId() && $questionRepository->findOneBy(['id' => 6])->getId() === $tentatives->getQuestion()->getId()){
                $em->remove($tentatives);
            }
        }

        $tentative = new Tentative();
        $tentative->setUser($user);
        $tentative->setQuestion($questionRepository->findOneBy(['id' => 6]));
        if ($value == 0){
            $tentative->setResponse(false);
        } else {
            $tentative->setResponse(true);
        }

        $em->persist($tentative);
        $em->flush();

        $results = $tentativeRepository->findBy(['user' => $user]);
        $count = 0;
        foreach ($results as $result){
            if ($result->getResponse() == true){
                $count++;
            }
        }
        if ($count == 3){
            $this->addFlash(
                'success',
                'Bravo vous avez fini avec succes la catégorie Cyber Harcelement'
            );
            $progression = $progressionRepository->findOneBy(['user' => $user, 'category' => 4]);
            $progression->setValid(true);
            $user->setCategoryStep($categoryRepository->findOneBy(['id' => 4]));
            $em->persist($progression);
            $em->persist($user);
            $em->flush();

        } elseif ($count == 2) {
            $this->addFlash(
                'warning',
                'Ce niveau est terminée mais vous n\'avez répondu juste à toute les réponses'
            );
            $progression = $progressionRepository->findOneBy(['user' => $user, 'category' => 4]);
            $progression->setValid(true);
            $user->setCategoryStep($categoryRepository->findOneBy(['id' => 4]));
            $em->persist($progression);
            $em->persist($user);
            $em->flush();
        } else {
            $this->addFlash(
                'danger',
                'Vous n\'avez pas bien répondu'
            );
        }

        return $this->redirectToRoute('user_index');

    }
}