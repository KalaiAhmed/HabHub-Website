<?php

namespace App\Controller;
//use Symfony\Bundle\FrameworkBundle\Repository\ProduitRepository;
use App\Repository\AnnonceAdoptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SearchAdoptionController extends AbstractController
{
    /**
     * @Route("/search", name="app_search"  )
     */
    public function index(): Response
    {
        return $this->render('search/searchBar.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    public function searchBar()
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('handleSearch'))
            ->add('Search', TextType::class )




            ->add('recherche', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->getForm();
        return $this->render('search/searchBar.html.twig', [
            'form' => $form->createView()
        ]);
    }


      /**
     * @Route("/handleSearch", name="handleSearch")
     * @param Request $request
     */
    public function handleSearch(Request $request, AnnonceAdoptionRepository $repo)
    {
        $query = $request->request->get('form')['Search'];
        if($query) {
            $annonceAdoption = $repo->findAnnonceByDogName($query);
        }
        return $this->render('annonce_adoption/show.html.twig', [
            'annonceAdoptions' => $annonceAdoption
        ]);
    }


}