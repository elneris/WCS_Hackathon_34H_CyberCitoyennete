<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class User extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;

    public function __construct (UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');

        $admin = new \App\Entity\User();
        $admin->setFirstname('Elneris');
        $admin->setLastname('Dang');
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'Elneris.Dang2019'));
        $admin->setLogin('Elneris.Dang');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setCategoryStep(4);
        $manager->persist($admin);
        $this->addReference('admin', $admin);

        $eleve = new \App\Entity\User();
        $eleve->setFirstname('Jimmy');
        $eleve->setLastname('Achour');
        $eleve->setPassword($this->passwordEncoder->encodePassword($eleve, 'Jimmy.Achour2019'));
        $eleve->setLogin('Jimmy.Achour');
        $eleve->setRoles(['ROLE_USER']);
        $eleve->setCategoryStep(1);
        $manager->persist($eleve);
        $this->addReference('eleve', $eleve);
        $manager->flush();

        for($x = 0; $x < 50; $x++) {
            $eleve = new \App\Entity\User();
            $eleve->setClass($this->getReference('class' . rand(1,2)));
            $eleve->setFirstname($faker->firstName);
            $eleve->setLastname($faker->name);
            $eleve->setPassword($this->passwordEncoder->encodePassword($eleve, 'student'));
            $eleve->setLogin('Jimmy.Achour' . $x);
            $eleve->setRoles(['ROLE_USER']);
            $eleve->setCategoryStep(1);
            $manager->persist($eleve);
            $this->addReference('eleve' . $x, $eleve);
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return [Classe::class];
    }
}
