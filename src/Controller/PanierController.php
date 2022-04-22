<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Form\PanierType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ProduitRepository;

/**
 * @Route("/panier")
 */
class PanierController extends AbstractController
{
    /**
     * @Route("/front-office", name="app_panier_index", methods={"GET"})
     */
    public function index(SessionInterface $session , ProduitRepository $ProduitRepository)
    {
        $panier = $session->get('panier', []);
    
        $panierwithdata = [];

        foreach($panier as $id => $quantite){
            $panierwithdata[] =[
                'produit' => $ProduitRepository->find($id),
                'quantite' => $quantite
            ];
            
        }

        $total=0;

        foreach($panierwithdata as $item){
            $totalitem = $item['produit']->getPrix() *$item['quantite'];
            $total+=$totalitem;
        }
        

        return $this->render('panier/index_front.html.twig', [
            'items' => $panierwithdata,
            'total' => $total,
        ]);
    }

     /**
     * @Route("/add/{id}", name="add_prod", )
     */
    public function add($id, SessionInterface $session): Response
    {
        $panier = $session->get('panier', []);
        if(!empty($panier[$id])){
            $panier[$id]++;
        }
        else{
            $panier[$id]=1;
        }
        $session->set('panier',$panier);
       return $this->redirectToRoute("app_panier_index");

    }


     /**
     * @Route("/delete/{id}", name="DelProd", )
     */

    public function RemoveProd($id, SessionInterface $session ){
        $panier = $session->get('panier', []);

        if( !empty($panier[$id] ) ){
            unset($panier[$id]);
    }
    $session->set('panier',$panier);
    return $this->redirectToRoute("app_panier_index");

}


    /**
     * @Route("/new", name="app_panier_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $panier = new Panier();
        $form = $this->createForm(PanierType::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($panier);
            $entityManager->flush();

            return $this->redirectToRoute('app_panier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('panier/new.html.twig', [
            'panier' => $panier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idpanier}", name="app_panier_show", methods={"GET"})
     */
    public function show(Panier $panier): Response
    {
        return $this->render('panier/show.html.twig', [
            'panier' => $panier,
        ]);
    }

    /**
     * @Route("/{idpanier}/edit", name="app_panier_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Panier $panier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PanierType::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_panier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('panier/edit.html.twig', [
            'panier' => $panier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idpanier}", name="app_panier_delete", methods={"POST"})
     */
    public function delete(Request $request, Panier $panier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$panier->getIdpanier(), $request->request->get('_token'))) {
            $entityManager->remove($panier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_panier_index', [], Response::HTTP_SEE_OTHER);
    }




}
