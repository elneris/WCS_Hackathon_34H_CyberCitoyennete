<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Category extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $cat = new \App\Entity\Category();
        $cat1 = new \App\Entity\Category();
        $cat2 = new \App\Entity\Category();
        $cat3 = new \App\Entity\Category();

        $cat->setName('Cyber Harcèlement');
        $cat1->setName('Cyber Sécurité');
        $cat2->setName('Cyber Information');
        $cat3->setName('Ecologie Digitale');

        $cat->setLevel(1);
        $cat1->setLevel(2);
        $cat2->setLevel(3);
        $cat3->setLevel(4);

        $manager->persist($cat);
        $this->addReference('cat', $cat);
        $this->addReference('cat1', $cat3);
        $this->addReference('cat2', $cat2);
        $this->addReference('cat3', $cat1);
        $manager->persist($cat1);
        $manager->persist($cat2);
        $manager->persist($cat3);


        $manager->flush();

    }
}
