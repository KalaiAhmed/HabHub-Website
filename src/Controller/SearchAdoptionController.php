<?php

namespace App\Controller;
//use Symfony\Bundle\FrameworkBundle\Repository\annonceRepository;
use App\Repository\AnnonceAdoptionRepository;
use App\Entity\AnnonceAdoption;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Individu;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SearchAdoptionController extends AbstractController
{
    /**
     * Creates a new ActionItem entity.
     *
     * @Route("/search", name="ajax_search")
     * methods={"GET"}
     */
    public function searchBar(Request $request, EntityManagerInterface $entityManager)
    {
        

        $requestString = $request->query->get('l');
       
        

        $annonces = $entityManager
            ->getRepository(AnnonceAdoption::class)
            ->findAnnonceByDogName($requestString);

        if(!$annonces) {
            $result['annonces']['error'] = "Not Found";
        } else {
            $result['annonces'] = $this->getRealEntities($annonces);
        }

        return new Response(json_encode($result));
    }

  


    public function getRealEntities($annonces){

        foreach ($annonces as $annonce){
            $realEntities[$annonce->getIdannonceadoption()] =[ $annonce->getIdchien()->getNom(),$annonce->getdatePublication(),
            $annonce->getLocalisation(),$annonce->getDescription(),
            $annonce->getIdchien()->getImage(),$annonce];

        }

        return $realEntities;
    }

   


}