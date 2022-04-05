<?php

namespace App\Controller;

use App\Entity\Individu;
use App\Form\IndividuType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/individu")
 */
class IndividuController extends AbstractController
{
    /**
     * @Route("/", name="app_individu_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $individus = $entityManager
            ->getRepository(Individu::class)
            ->findAll();

        return $this->render('individu/index.html.twig', [
            'individus' => $individus,
        ]);
    }

    /**
     * @Route("/new", name="app_individu_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $individu = new Individu();
        $form = $this->createForm(IndividuType::class, $individu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($individu);
            $entityManager->flush();

            return $this->redirectToRoute('app_individu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('individu/new.html.twig', [
            'individu' => $individu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idindividu}", name="app_individu_show", methods={"GET"})
     */
    public function show(Individu $individu): Response
    {
        return $this->render('individu/show.html.twig', [
            'individu' => $individu,
        ]);
    }

    /**
     * @Route("/{idindividu}/edit", name="app_individu_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Individu $individu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(IndividuType::class, $individu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_individu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('individu/edit.html.twig', [
            'individu' => $individu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idindividu}", name="app_individu_delete", methods={"POST"})
     */
    public function delete(Request $request, Individu $individu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$individu->getIdindividu(), $request->request->get('_token'))) {
            $entityManager->remove($individu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_individu_index', [], Response::HTTP_SEE_OTHER);
    }
}
