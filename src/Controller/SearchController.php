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
     * @Route("/search-users", name="individus_search")
     * methods={"GET"}
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $requestString = $request->get('p');

        $individus =  $em->getRepository('App:Individu')->findEntitiesByString($requestString);

        if(!$individus) {
            $result['Individu']['error'] = "not found";
        } else {
            $result['Individu'] = $this->getRealEntitiesIndividu($individus);
        }

        return new Response(json_encode($result));
    }


    /**
     * Creates a new ActionItem entity.
     *
     * @Route("/search_users", name="utilisateurs_search")
     * methods={"GET"}
     */
    public function searchUtilisateur(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $requestString = $request->get('p');

        $utilisateurs =  $em->getRepository('App:Utilisateur')->findEntitiesByString($requestString);

        if(!$utilisateurs) {
            $result['Utilisateur']['error'] = "not found";
        } else {
            $result['Utilisateur'] = $this->getRealEntitiesUtilisateu($utilisateurs);
        }

        return new Response(json_encode($result));
    }





    public function getRealEntitiesIndividu($individus){

        foreach ($individus as $individu){
            $realEntities[$individu->getIdindividu()] = [$individu->getIdutilisateur()->getEmail(),$individu->getNom(),$individu->getPrenom(),$individu->getDatenaissance(),$individu->getSexe(),$individu->getAdresse()
            ,$individu->getAdresse(),$individu->getAdresse(),$individu->getFacebook(),$individu->getInstagram(),$individu->getWhatsapp(),$individu->getProprietairechien()];
        }

        return $realEntities;
    }

    public function getRealEntitiesUtilisateur($utilisateurs){

        foreach ($utilisateurs as $utilisateur){
            $realEntities[$utilisateur->getIdutilisateur()] = [$utilisateur->getIdutilisateur(),
                $utilisateur->getEmail(),$utilisateur->getPassword(),
                $utilisateur->getNumtel(),
                $utilisateur->getType()];
        }

        return $realEntities;
    }




}