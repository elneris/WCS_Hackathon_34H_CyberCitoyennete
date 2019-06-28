<?php
/**
 * Created by PhpStorm.
 * User: laure
 * Date: 2019-06-27
 * Time: 23:24
 */

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Question extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [Category::class];
    }

    public function load(ObjectManager $manager)
    {
         $question1 = new \App\Entity\Question();
         $question1->setValue('En voyant ce post, quelle est ta réaction?');
         $question1->setGoodAnswer('Je commente positivement');
         $question1->setWrongAnswerOne('Je like');
         $question1->setWrongAnswerTwo('Je commente négativement');
         $question1->setWrongAnswerThree('J\'ignore');
         $question1->setCategory($this->getReference('cat'));
         $manager->persist($question1);
         $manager->flush();

        $question2 = new \App\Entity\Question();
        $question2->setValue('Le nouveau de 5B n\'est pas venu à l\'école cette semaine: Que ressens tu?');
        $question2->setGoodAnswer('Coupable');
        $question2->setWrongAnswerOne('Indifférent');
        $question2->setWrongAnswerTwo('Triste');
        $question2->setWrongAnswerThree('Content');
        $question2->setCategory($this->getReference('cat'));
        $manager->persist($question2);
        $manager->flush();

        $questions3 = new \App\Entity\Question();
        $questions3->setValue('A sa place, qu\'aurais tu fais?');
        $questions3->setGoodAnswer('En parler à tes parents ou au personnel du collège');
        $questions3->setWrongAnswerOne('Ne rien dire');
        $questions3->setWrongAnswerTwo('S\'énerver');
        $questions3->setWrongAnswerThree('Répondre aux commentaires');
        $questions3->setCategory($this->getReference('cat'));
        $manager->persist($questions3);
        $manager->flush();

        $question4 = new \App\Entity\Question();
        $question4->setValue('En voyant ce post, quelle est ta réaction?');
        $question4->setGoodAnswer('Je commente négativement');
        $question4->setWrongAnswerOne('Je like');
        $question4->setWrongAnswerTwo('Je commente positivement');
        $question4->setWrongAnswerThree('J\'ignore');
        $question4->setCategory($this->getReference('cat3'));
        $manager->persist($question4);
        $manager->flush();

        $question5 = new \App\Entity\Question();
        $question5->setValue('Le nouveau de 5B n\'est pas venu à l\'école cette semaine: Que ressens tu?');
        $question5->setGoodAnswer('Coupable');
        $question5->setWrongAnswerOne('Indifférent');
        $question5->setWrongAnswerTwo('Triste');
        $question5->setWrongAnswerThree('Content');
        $question5->setCategory($this->getReference('cat3'));
        $manager->persist($question5);
        $manager->flush();

        $questions6 = new \App\Entity\Question();
        $questions6->setValue('A sa place, qu\'aurais tu fais?');
        $questions6->setGoodAnswer('Parler à tes parents');
        $questions6->setWrongAnswerOne('Ne rien dire');
        $questions6->setWrongAnswerTwo('En parler au personnel du collège');
        $questions6->setWrongAnswerThree('Répondre aux commentaires');
        $questions6->setCategory($this->getReference('cat3'));
        $manager->persist($questions6);
        $manager->flush();

    }
}