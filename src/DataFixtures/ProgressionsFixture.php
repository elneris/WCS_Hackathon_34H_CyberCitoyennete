<?php

namespace App\DataFixtures;

use App\Entity\Progression;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Tests\Common\DataFixtures\TestFixtures\UserFixture;

class ProgressionsFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $progression = new Progression();
        $progression->setUser($this->getReference('eleve'));
        $progression->setCategory($this->getReference('cat'));
        $progression->setValid(1);

        $manager->persist($progression);

        $progression1 = new Progression();
        $progression1->setUser($this->getReference('eleve'));
        $progression1->setCategory($this->getReference('cat3'));
        $progression1->setValid(1);

        $manager->persist($progression1);

        $progression2 = new Progression();
        $progression2->setUser($this->getReference('eleve'));
        $progression2->setCategory($this->getReference('cat2'));
        $progression2->setValid(1);

        $manager->persist($progression2);

        $progression3 = new Progression();
        $progression3->setUser($this->getReference('eleve'));
        $progression3->setCategory($this->getReference('cat1'));
        $progression3->setValid(0);

        $manager->persist($progression3);

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [User::class, Category::class];
    }
}
