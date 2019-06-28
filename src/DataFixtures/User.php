<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class User extends Fixture
{
    private $passwordEncoder;

    public function __construct (UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new \App\Entity\User();
        $admin->setFirstname('Elneris');
        $admin->setLastname('Dang');
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'Elneris.Dang2019'));
        $admin->setLogin('Elneris.Dang');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setCategoryStep($this->getReference('cat'));
        $manager->persist($admin);
        $this->addReference('admin', $admin);

        $eleve = new \App\Entity\User();
        $eleve->setFirstname('Jimmy');
        $eleve->setLastname('Achour');
        $eleve->setPassword($this->passwordEncoder->encodePassword($eleve, 'Jimmy.Achour2019'));
        $eleve->setLogin('Jimmy.Achour');
        $eleve->setRoles(['ROLE_USER']);
        $eleve->setCategoryStep($this->getReference('cat'));
        $manager->persist($eleve);
        $this->addReference('eleve', $eleve);
        $manager->flush();
    }
}
