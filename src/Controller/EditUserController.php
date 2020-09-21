<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\FunctionUser;
use App\Entity\Role;
use App\Entity\User;
use App\Repository\UserRepository;

class EditUserController extends AbstractController
{
    /**
     * @Route("/user/{id}/edit", name="user_edit_role")
     */
    public function editRoleAction(EntityManagerInterface $manager, Request $request, User $user, UserRepository $users)
    {
        $functionId = $request->request->get('function');
        $functionRepo = $manager->getRepository(FunctionUser::class);
        $roles = $manager->getRepository(Role::class);
        $functionName = $functionRepo->findOneBy([
            'name' => $functionId
        ]);

        if ($request->request->has('function')) 
        {
            $user->setFunctionUser($functionName);
            $Role = [];
            foreach($functionName->getRoles() as $role){
                $Role[] = $role->getName();
            }
            $user->setRoles($Role);
            $manager->persist($user);
            $manager->flush();


            return $this->redirectToRoute('liste');
        }

        return $this->render('home/editUser.html.twig', [
            'functionuser' => $functionRepo->findAll(),
            'users' => $users->findAll(),
            'roles' => $roles->findAll()
        ]);
    }


    /**
     * @Route("/add/{id}", name="add_Role")
     */
    public function add(EntityManagerInterface $manager, Request $request, User $user){

        $roleAdd = $request->request->get('function');
        $roles = $manager->getRepository(Role::class);
        $functionName = $user->getFunctionUser();
        
        if ($request->request->has('function')) 
        {
            $Role = [];
            foreach($functionName->getRoles() as $role){
                $Role[0] = $role->getName();
                $Role[1] = $roleAdd;
            }
            $user->setRoles($Role);
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('liste');
        }

        return $this->render('home/addRole.html.twig', [
            'roles' => $roles->findAll()
        ]);
    }


     /**
     * @Route("/remove/{id}", name="remove_Role")
     */
    public function remove(EntityManagerInterface $manager, Request $request, User $user){
        $roleRemove = $request->request->get('function');
        $functionName = $user->getFunctionUser();
        
        if ($request->request->has('function')) 
        {
            $Role = [];
            foreach($functionName->getRoles() as $role){
                $Role[] = $role->getName();
                
            }
            unset($Role[array_search($roleRemove, $Role)]);
            $user->setRoles($Role);
            $manager->persist($user);
            $manager->flush();
        }

        $roles = $manager->getRepository(Role::class);
        return $this->render('home/removeRole.html.twig', [
            'roles' => $roles->findAll()
        ]);
    }
}
