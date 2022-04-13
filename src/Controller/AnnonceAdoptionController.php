<?php

namespace App\Controller;

use App\Entity\AnnonceAdoption;
use App\Form\AnnonceAdoptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/annonce/adoption")
 */
class AnnonceAdoptionController extends AbstractController
{
    /**
     * @Route("/back-office", name="app_annonce_adoption_index_back_office", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $annonceAdoptions = $entityManager
            ->getRepository(AnnonceAdoption::class)
            ->findAll();

        return $this->render('annonce_adoption/backOfficeShow.html.twig', [
            'annonceAdoptions' => $annonceAdoptions,
        ]);
    }

    /**
     * @Route("/new", name="app_annonce_adoption_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $annonceAdoption = new AnnonceAdoption();
        $form = $this->createForm(AnnonceAdoptionType::class, $annonceAdoption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($annonceAdoption);
            $entityManager->flush();

            return $this->redirectToRoute('app_annonce_adoption_index_back_office', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('annonce_adoption/new.html.twig', [
            'annonce_adoption' => $annonceAdoption,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idannonceadoption}", name="app_annonce_adoption_show", methods={"GET"})
     */
    public function show(AnnonceAdoption $annonceAdoption): Response
    {
        return $this->render('annonce_adoption/show.html.twig', [
            'annonce_adoption' => $annonceAdoption,
        ]);
    }

    /**
     * @Route("/{idannonceadoption}/edit", name="app_annonce_adoption_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, AnnonceAdoption $annonceAdoption, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AnnonceAdoptionType::class, $annonceAdoption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_annonce_adoption_index_back_office', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('annonce_adoption/edit.html.twig', [
            'annonce_adoption' => $annonceAdoption,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idannonceadoption}", name="app_annonce_adoption_delete", methods={"POST"})
     */
    public function delete(Request $request, AnnonceAdoption $annonceAdoption, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annonceAdoption->getIdannonceadoption(), $request->request->get('_token'))) {
            $entityManager->remove($annonceAdoption);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_annonce_adoption_index_back_office', [], Response::HTTP_SEE_OTHER);
    }
}
