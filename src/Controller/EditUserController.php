<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\FunctionUser;
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
            'users' => $users->findAll()
        ]);
    }
}

