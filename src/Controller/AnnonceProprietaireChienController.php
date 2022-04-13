<?php

namespace App\Controller;

use App\Entity\AnnonceProprietaireChien;
use App\Form\AnnonceProprietaireChienType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/annonce/proprietaire/chien")
 */
class AnnonceProprietaireChienController extends AbstractController
{
    /**
     * @Route("/", name="app_annonce_proprietaire_chien_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $annonceProprietaireChiens = $entityManager
            ->getRepository(AnnonceProprietaireChien::class)
            ->findAll();

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
