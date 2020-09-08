<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\FunctionUser;
use App\Entity\Role;


class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $roleRepo = $manager->getRepository(Role::class);
        $fonctionRepo = $manager->getRepository(FunctionUser::class);

        $role1 = new Role;
        $role1->setName("ROLE_APP_SETTING");
        $manager->persist($role1);

        $role2 = new Role;
        $role2->setName("ROLE_PAY");
        $manager->persist($role2);

        $role3 = new Role;
        $role3->setName("ROLE_GED");
        $manager->persist($role3);

        $role4 = new Role;
        $role4->setName("ROLE_AGENDA");
        $manager->persist($role4);

        $role5 = new Role;
        $role5->setName("ROLE_TEAM_MEETING");
        $manager->persist($role5);

        $role6 = new Role;
        $role6->setName("ROLE_SITE");
        $manager->persist($role6);

        $manager->flush();

        $fonction1 = new FunctionUser;
        $fonction1->setName("Super administrateur");
        $fonction1->addRole($role1);
        $fonction1->addRole($role2);
        $fonction1->addRole($role3);
        $fonction1->addRole($role4);
        $fonction1->addRole($role5);
        $fonction1->addRole($role6);
        $manager->persist($fonction1);

        $fonction2 = new FunctionUser;
        $fonction2->setName("Direction");
        $fonction2->addRole($role2);
        $fonction2->addRole($role3);
        $fonction2->addRole($role4);
        $fonction2->addRole($role5);
        $fonction2->addRole($role6);
        $manager->persist($fonction2);

        $fonction3 = new FunctionUser;
        $fonction3->setName("Ressources humaines");
        $fonction3->addRole($role2);
        $fonction3->addRole($role3);
        $fonction3->addRole($role4);
        $manager->persist($fonction3);

        $fonction4 = new FunctionUser;
        $fonction4->setName("Manager d’équipes");
        $fonction4->addRole($role4);
        $fonction4->addRole($role5);
        $fonction4->addRole($role6);
        $manager->persist($fonction4);

        $fonction5 = new FunctionUser;
        $fonction5->setName("Opérateur");
        $fonction5->addRole($role4);
        $manager->persist($fonction5);

        $manager->flush();
    }
}