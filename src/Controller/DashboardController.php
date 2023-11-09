<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(AuthenticationUtils $au): Response
    {
        $lastUsername = $this->getUser()->getUserIdentifier();
        return $this->render('dashboard/index.html.twig', [
            'user_name'=>$lastUsername,
//            'error'=>$error,
            'controller_name' => 'DashboardController',
        ]);
    }
}
