<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Repository\CategorieRepository;





/**
 * @Route("/produit")
 */
class ProduitController extends AbstractController

{/**
     * @Route("/back-office", name="app_back_office_produit", methods={"GET"})
     */
    public function indexbackoffice(EntityManagerInterface $entityManager): Response
    {
        $produits = $entityManager
            ->getRepository(Produit::class)
            ->findAll();

        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
        ]);
    }

/**
     * @Route("/front-office", name="app_front_office_home", methods={"GET"})
     */
    public function indexfrontoffice(EntityManagerInterface $entityManager, CategorieRepository $catrepo,Request $request): Response
    {
      //  $form = $this->createForm(SearchType::class, $data)

      $filter = $request->get("categories");

      $categories = $catrepo->findAll(); 

        $produits = $entityManager
            ->getRepository(Produit::class)
            ->getTotalProduits($filter);


             
            
            


        if($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('produit/_content.html.twig',
                 [
                    'produits' => $produits,
                    
                ])
                ]);
        }

        return $this->render('produit/index_Front.html.twig', [
            'produits' => $produits,
            'categories' => $categories,
        ]);

        

        
    }


    /**
     * @Route("/", name="app_produit_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $produits = $entityManager
            ->getRepository(Produit::class)
            ->findAll();

        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
        ]);
    }

    

    /**
     * @Route("/new", name="app_produit_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();



            $fichier = md5(uniqid()) . '.' . $image->guessExtension();
            //On copie le fichier dans le dossier upload
            $image->move(
            $this->getParameter('upload_directory'),
            $fichier
            );
            // on stocke l'image dans la bdd (son nom)

            $produit->setImage($fichier);


            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idproduit}", name="app_produit_show", methods={"GET"})
     */
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/{idproduit}/edit", name="app_produit_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        ;

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        

        return $this->render('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idproduit}", name="app_produit_delete", methods={"POST"})
     */
    public function delete(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getIdproduit(), $request->request->get('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }

    
    /**
     * @Route("/addProd", name="add_Prod",methods={"GET","POST"})
     *
     */

    public function addDProdMobile(Request $request, EntityManagerInterface $entityManager)
    {
        $produit = new Produit();
        $nom = $request->query->get("nom");
        $description = $request->query->get("description");
        $prix = $request->query->get("prix");
        $marque = $request->query->get("marque");
        $idCategorie = $request->query->get("idCategorie");

        $produit->setIdCategorie( $entityManager
            ->getRepository(Categorie::class)
            ->findOneBy(array('idCategorie' => $idCategorie)));

        $produit->setNom($nom);
        $produit->setDescription($description);
        $produit->setPrix($prix);
        $produit->setMarque($marque);
        


        $entityManager->persist($produit);
        $entityManager->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($produit);
        return new JsonResponse($formatted);
    }
}
