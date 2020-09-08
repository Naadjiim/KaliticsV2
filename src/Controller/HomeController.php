<?php

namespace App\Controller;

use App\Entity\FunctionUser;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/super_admin", name="super_admin")
     */
    public function admin()
    {
        return $this->render('home/super_admin.html.twig');
    }

    /**
     * @Route("/payslip", name="payslip")
     */
    public function payslip()
    {
        return $this->render('home/payslip.html.twig');
    }

    /**
     * @Route("/management", name="management")
     */
    public function management()
    {
        return $this->render('home/management.html.twig');
    }


    /**
     * @Route("/agenda", name="agenda")
     */
    public function agenda()
    {
        return $this->render('home/agenda.html.twig');
    }

    /**
     * @Route("/meeting", name="meeting")
     */
    public function meeting()
    {
        return $this->render('home/meeting.html.twig');
    }


    /**
     * @Route("/consultation", name="consultation")
     */
    public function consultation()
    {
        return $this->render('home/consultation.html.twig');
    }


    /**
     * @Route("/denied_acces", name="denied_acces")
     */
    public function deniedAcces()
    {
        return $this->render('home/deniedacces.html.twig');
    }


    /**
     * @Route("/user/{id}/edit", name="user_edit_role")
     */
    public function editRoleAction(EntityManagerInterface $manager, Request $request, User $user)
    {
        $functionId = $request->request->get('function');
        $functionRepo = $manager->getRepository(FunctionUser::class);
        $roles = $manager->getRepository(Role::class)->findAll();
        if ($request->request->has('function')) {
            $user->setRoles($request->request->get('function'));

//            $function = $functionRepo->find($functionId);
//            $user->setFunctionUser($function);
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('user_edit_role', [
                'id' => $user->getId()
            ]);
        }


        return $this->render('home/editUser.html.twig', [
            'roles' => $roles
        ]);
    }

    public function getRolesUser()
    {
        $user = $this->getUser();
        if (isset($user)) {
            $fonction = $user->getFunctionUser();
            $roles = $fonction->getRoles();

            return $roles;
        }
        return $this->redirectToRoute('denied_acces');
    }
}
