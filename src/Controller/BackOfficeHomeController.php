<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackOfficeHomeController extends AbstractController
{
    /**
     * @Route("/back-office/home", name="app_back_office_home")
     */
    public function index(): Response
    {
        return $this->render('back_office_home/index.html.twig', [
            'controller_name' => 'BackOfficeHomeController',
        ]);
    }


    /**
     * @Route("/back-office/orders", name="app_back_office_orders")
     */
    public function orders(): Response
    {
        return $this->render('commande/show.html.twig', [
            'controller_name' => 'BackOfficeHomeController',
        ]);
    }
    /**
     * @Route("/back-office/produits", name="app_back_office_produits")
     */
    public function products(): Response
    {
        return $this->render('produit/show.html.twig', [
            'controller_name' => 'BackOfficeHomeController',
        ]);
    }


    /**
     * @Route("/back-office/adoption", name="app_back_office_adoption")
     */
    public function adoption(): Response
    {
        return $this->render('annonce_adoption/show.html.twig', [
            'controller_name' => 'BackOfficeHomeController',
        ]);
    }
    /**
     * @Route("/back-office/mating", name="app_back_office_mating")
     */
    public function mating(): Response
    {
        return $this->render('annonce_proprietaire_chien/show.html.twig', [
            'controller_name' => 'BackOfficeHomeController',
        ]);
    }
    /**
     * @Route("/back-office/lostDogs", name="app_back_office_lostDogs")
     */
    public function lostDogs(): Response
    {
        return $this->render('annonce_proprietaire_chien/show.html.twig', [
            'controller_name' => 'BackOfficeHomeController',
        ]);
    }
    /**
     * @Route("/back-office/users", name="app_back_office_users")
     */
    public function users(): Response
    {
        return $this->render('utilisateur/show.html.twig', [
            'controller_name' => 'BackOfficeHomeController',
        ]);
    }








}
