<?php

namespace App\Controller;

use App\Entity\AnnonceProprietaireChien;
use App\Entity\Chien;
use App\Form\AnnonceProprietaireChienType;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Util\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/annonce-proprietaire-chien")
 */
class AnnonceProprietaireChienController extends AbstractController
{
    /**
     * @Route("/lost", name="app_annonce_proprietaire_chien_index_lost", methods={"GET"})
     */
    public function indexLost(EntityManagerInterface $entityManager): Response
    {
        $annonceProprietaireChiens = $entityManager
            ->getRepository(AnnonceProprietaireChien::class)
            ->findBy(array('type' => 'P'));

        return $this->render('annonce_proprietaire_chien/frontOfficeIndexLost.html.twig', [
            'annonce_proprietaire_chiens' => $annonceProprietaireChiens,
        ]);
    }
    /**
     * @Route("/lost/notifyowner/{chien}", name="app_annonce_proprietaire_chien_lost_notify_owner", methods={"GET"})
     */
    public function notifyOwner(Chien $chien): Response
    {
        $recepient='+216'.strval($chien->getIdindividu()->getIdutilisateur()->getNumtel());

        $messageBird = new \MessageBird\Client('PMEGViucdqQMf9rgq9Z0YEu5Z'); //test
        //$messageBird = new \MessageBird\Client('lwXWiTInBuKkCX5zbweIA1JhY'); //live
        $message =  new \MessageBird\Objects\Message();
        try{

            $message->originator = $recepient;
            $message->recipients = $recepient;
            $message->body = 'we found your dog';
            $response = $messageBird->messages->create($message);


            print_r($response);
        }
        catch(Exception $e) {echo $e;}

        return $this->redirectToRoute('app_annonce_proprietaire_chien_index_lost');
    }
    /**
     * @Route("/mating", name="app_annonce_proprietaire_chien_index_mating", methods={"GET"})
     */
    public function indexMating(EntityManagerInterface $entityManager): Response
    {
        $annonceProprietaireChiens = $entityManager
            ->getRepository(AnnonceProprietaireChien::class)
            ->findBy(array('type' => 'A'));

        return $this->render('annonce_proprietaire_chien/frontOfficeIndex.html.twig', [
            'annonce_proprietaire_chiens' => $annonceProprietaireChiens,
        ]);
    }


    /**
     * @Route("/new", name="app_annonce_proprietaire_chien_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $annonceProprietaireChien = new AnnonceProprietaireChien();
        $form = $this->createForm(AnnonceProprietaireChienType::class, $annonceProprietaireChien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($annonceProprietaireChien);
            $entityManager->flush();

            return $this->redirectToRoute('app_annonce_proprietaire_chien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('annonce_proprietaire_chien/new.html.twig', [
            'annonce_proprietaire_chien' => $annonceProprietaireChien,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idannonceproprietairechien}", name="app_annonce_proprietaire_chien_show", methods={"GET"})
     */
    public function show(AnnonceProprietaireChien $annonceProprietaireChien): Response
    {
        return $this->render('annonce_proprietaire_chien/show.html.twig', [
            'annonce_proprietaire_chien' => $annonceProprietaireChien,
        ]);
    }

    /**
     * @Route("/{idannonceproprietairechien}/edit", name="app_annonce_proprietaire_chien_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, AnnonceProprietaireChien $annonceProprietaireChien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AnnonceProprietaireChienType::class, $annonceProprietaireChien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_annonce_proprietaire_chien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('annonce_proprietaire_chien/edit.html.twig', [
            'annonce_proprietaire_chien' => $annonceProprietaireChien,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idannonceproprietairechien}", name="app_annonce_proprietaire_chien_delete", methods={"POST"})
     */
    public function delete(Request $request, AnnonceProprietaireChien $annonceProprietaireChien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annonceProprietaireChien->getIdannonceproprietairechien(), $request->request->get('_token'))) {
            $entityManager->remove($annonceProprietaireChien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_annonce_proprietaire_chien_index', [], Response::HTTP_SEE_OTHER);
    }


}


