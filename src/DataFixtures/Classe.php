<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Classe extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $class = new \App\Entity\Classe();
        $class1 = new \App\Entity\Classe();
        $class->setName('PHP 2019');
        $class1->setName('JS 2019');

        $manager->persist($class);
        $manager->persist($class1);

        $manager->flush();
    }
}
