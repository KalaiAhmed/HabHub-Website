<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontOfficeHomeController extends AbstractController
{
    /**


     * @Route("/front-office/home", name="app_home")

     */
    public function index(): Response
    {
        if ($this->getUser() != null )
        {
            if ($this->getUser()->getRoles()==['ROLE_ADMIN'])
        {
            return $this->redirectToRoute('app_back_office_home', [], Response::HTTP_SEE_OTHER);
        }
    }
        return $this->render('front_office_home/index.html.twig', [
            'controller_name' => 'FrontOfficeHomeController',
        ]);
    }
}
