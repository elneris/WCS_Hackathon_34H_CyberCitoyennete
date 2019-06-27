<?php
/**
 * Created by PhpStorm.
 * User: laure
 * Date: 2019-06-27
 * Time: 23:24
 */

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Question extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $question = new Question();
         $manager->persist($question);
         $manager->flush();
    }
}