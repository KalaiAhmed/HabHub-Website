<?php

namespace App\Controller;

use App\Entity\Revue;
use App\Form\RevueType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/revue")
 */
class RevueController extends AbstractController
{
    /**
     * @Route("/", name="app_revue_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $revues = $entityManager
            ->getRepository(Revue::class)
            ->findAll();

        return $this->render('revue/index.html.twig', [
            'revues' => $revues,
        ]);
    }

    /**
     * @Route("/new", name="app_revue_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $revue = new Revue();
        $form = $this->createForm(RevueType::class, $revue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($revue);
            $entityManager->flush();

            return $this->redirectToRoute('app_revue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('revue/new.html.twig', [
            'revue' => $revue,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idrevue}", name="app_revue_show", methods={"GET"})
     */
    public function show(Revue $revue): Response
    {
        return $this->render('revue/show.html.twig', [
            'revue' => $revue,
        ]);
    }

    /**
     * @Route("/{idrevue}/edit", name="app_revue_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Revue $revue, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RevueType::class, $revue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_revue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('revue/edit.html.twig', [
            'revue' => $revue,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idrevue}", name="app_revue_delete", methods={"POST"})
     */
    public function delete(Request $request, Revue $revue, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$revue->getIdrevue(), $request->request->get('_token'))) {
            $entityManager->remove($revue);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_revue_index', [], Response::HTTP_SEE_OTHER);
    }
}
