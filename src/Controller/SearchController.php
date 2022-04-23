<?php

namespace App\Controller;
//use Symfony\Bundle\FrameworkBundle\Repository\ProduitRepository;
use App\Repository\ProduitRepository;
use App\Repository\AnnonceProprietaireChienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Produit;
use App\Entity\AnnonceProprietaireChien;

class SearchController extends AbstractController
{



    /**
     * Creates a new ActionItem entity.
     *
     * @Route("/search", name="ajax_search")
     * methods={"GET"}
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $requestString = $request->get('p');

        $produits =  $em->getRepository('App:Produit')->findEntitiesByString($requestString);

        if(!$produits) {
            $result['produits']['error'] = "keine EintrÃ¤ge gefunden";
        } else {
            $result['produits'] = $this->getRealEntities($produits);
        }

        return new Response(json_encode($result));
    }

    /**
     * Creates a new ActionItem entity.
     *
     * @Route("/search-mating", name="mating_ajax_search")
     * methods={"GET"}
     */
    public function matingSearchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $requestString = $request->get('m');

        $annonces =  $em->getRepository('App:AnnonceProprietaireChien')->searchMating($requestString);

        if(!$annonces) {
            $result['annonces']['error'] = "not found";
        } else {
            $result['annonces'] = $this->getRealEntitiesAnnoncesProp($annonces);
        }

        return new Response(json_encode($result));
    }

    /**
 * Creates a new ActionItem entity.
 *
 * @Route("/search-lost", name="lost_ajax_search")
 * methods={"GET"}
 */
    public function lostSearchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $requestString = $request->get('l');

        $annonces =  $em->getRepository('App:AnnonceProprietaireChien')->searchLost($requestString);

        if(!$annonces) {
            $result['annonces']['error'] = "not found";
        } else {
            $result['annonces'] = $this->getRealEntitiesAnnoncesProp($annonces);
        }

        return new Response(json_encode($result));
    }



    public function getRealEntities($produits){

        foreach ($produits as $produit){
            $realEntities[$produit->getIdProduit()] = $produit->getNom();
        }

        return $realEntities;
    }

    public function getRealEntitiesAnnoncesProp($annonces){

        foreach ($annonces as $annonce){
            $realEntities[$annonce->getIdannonceproprietairechien()] = $annonce->getLocalisation();
        }

        return $realEntities;
    }

}