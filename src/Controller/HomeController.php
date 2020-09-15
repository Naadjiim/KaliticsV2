<?php

namespace App\Controller;

use App\Repository\FunctionUserRepository;
use App\Repository\UserRepository;
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
     * @Route("/list", name="liste")
     */
    public function usersList(UserRepository $users, FunctionUserRepository $function)
    {
        return $this->render('home/liste.html.twig', [
            'users' => $users->findAll(),
            'function'=> $function->findAll()
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
