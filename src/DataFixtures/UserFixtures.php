<?php

namespace App\DataFixtures;


use App\Entity\FunctionUser;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture implements DependentFixtureInterface

{
    
        private $passwordEncoder;
        public function __construct(UserPasswordEncoderInterface $passwordEncoder)
        {
            $this->passwordEncoder = $passwordEncoder;
        }
    
         public function load(ObjectManager $manager)
        {
         
            
            $fonctionRepo = $manager->getRepository(FunctionUser::class);
    
            $superAdmin = $fonctionRepo->findOneBy([
                'name' => 'Super administrateur'
            ]);
            $direction = $fonctionRepo->findOneBy([
                'name' => 'Direction'
            ]);
            $humanressource = $fonctionRepo->findOneBy([
                'name' => 'Ressources humaines'
            ]);
            $teamManager = $fonctionRepo->findOneBy([
                'name' => 'Manager d’équipes'
            ]);
            $operateur = $fonctionRepo->findOneBy([
                'name' => 'Opérateur'
            ]);

            $user1 = new User;
            $user1->setPseudo("superadmin");
            $user1->setFunctionUser($superAdmin);
            $user1->setPassword($this->passwordEncoder->encodePassword($user1,"Pass1"));
            //get superadmin roles
            $superAdminRoles = [];
            foreach($superAdmin->getRoles() as $role){
                $superAdminRoles[] = $role->getName();
            }
            $user1->setRoles($superAdminRoles);

            $manager->persist($user1);
    
            $user2 = new User;
            $user2->setPseudo("direction");
            $user2->setFunctionUser($direction);
            $user2->setPassword($this->passwordEncoder->encodePassword($user2,"Pass2"));
            $directionRoles = [];
            foreach($direction->getRoles() as $role){
                $directionRoles[] = $role->getName();
            }
            $user2->setRoles($directionRoles);

            $manager->persist($user2);
    
            $user3 = new User;
            $user3->setPseudo("Humanressource");
            $user3->setFunctionUser($humanressource);
            $user3->setPassword($this->passwordEncoder->encodePassword($user3,"Pass3"));
            $hrRoles = [];
            foreach($humanressource->getRoles() as $role){
                $hrRoles[] = $role->getName();
            }
            $user3->setRoles($hrRoles);
    
            $manager->persist($user3);
    
    
            $user4 = new User;
            $user4->setPseudo("manager");
            $user4->setFunctionUser($teamManager);
            $user4->setPassword($this->passwordEncoder->encodePassword($user4,"Pass4"));
            $managerRoles = [];
            foreach($teamManager->getRoles() as $role){
                $managerRoles[] = $role->getName();
            }
            $user4->setRoles($managerRoles);
    
            $manager->persist($user4);
    
            $user5 = new User;
            $user5->setPseudo("operateur");
            $user5->setFunctionUser($operateur);
            $user5->setPassword($this->passwordEncoder->encodePassword($user5,"Pass5"));
            $operateurRoles = [];
            foreach($operateur->getRoles() as $role){
                $operateurRoles[] = $role->getName();
            }
            $user5->setRoles($operateurRoles);
    
            $manager->persist($user5);
    
    
            $manager->flush();
        }

        public function getDependencies()
        {
            return [
                AppFixtures::class
            ];
        }
}
        
    
    