<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontOfficeHomeController extends AbstractController
{
    /**
     * @Route("/front/office/home", name="app_front_office_home")
     */
    public function index(): Response
    {
        return $this->render('front_office_home/index.html.twig', [
            'controller_name' => 'FrontOfficeHomeController',
        ]);
    }
}
