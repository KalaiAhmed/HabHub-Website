<?php

namespace App\Controller;
//use Symfony\Bundle\FrameworkBundle\Repository\ProduitRepository;
use App\Repository\IndividuRepository;
use App\Repository\ProduitRepository;
use App\Repository\UtilisateurRepository;
use App\Repository\AnnonceProprietaireChienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Produit;
use App\Entity\Utilisateur;
use App\Entity\AnnonceProprietaireChien;

class SearchController extends AbstractController
{
    /**
     * Creates a new ActionItem entity.
     *
     * @Route("/search_users", name="utilisateurs_search")
     * methods={"GET"}
     */
    public function searchUtilisateur(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $requestString = $request->query->get('l');

        $utilisateurs =  $em->getRepository('App:Utilisateur')->getUser($requestString);

        if(!$utilisateurs) {
            $result['Utilisateur']['error'] = "not found";
        } else {
            $result['Utilisateur'] = $this->getRealEntitiesUtilisateur($utilisateurs);
        }


        return $this->render('utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateurs,
        ]);

    }






    public function getRealEntitiesUtilisateur($utilisateurs){

        foreach ($utilisateurs as $utilisateur){
            $realEntities[] = $utilisateur;
        }

        return $realEntities;
    }




}