<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new Utilisateur();
        $admin->setNom("mairame");
        $admin->setUsername("makam12");
        $admin->setEmail("mak@gmail.com");
        $admin->setTelephone(778900987);
        $admin->setStatut('actif');
        $admin->setRoles(["ROLE_SUPERADMIN"]);
        $admin->setPassword($this->passwordEncoder->encodePassword($admin,'passer123'));
        $manager->persist($admin);

        $manager->flush();
    }
}