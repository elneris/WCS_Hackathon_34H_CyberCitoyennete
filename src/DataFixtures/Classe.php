<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Classe extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $class = new \App\Entity\Classe();
        $class->setName('cm1');
        $manager->persist($class);
        $this->addReference('class1' , $class);


        $class1 = new \App\Entity\Classe();
        $class1->setName('cm2');
        $this->addReference('class2' , $class1);

        $manager->persist($class1);

        $manager->flush();
    }
}
