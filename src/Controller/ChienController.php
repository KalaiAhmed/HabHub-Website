<?php

namespace App\Controller;

use App\Entity\Chien;
use App\Form\ChienType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chien")
 */
class ChienController extends AbstractController
{
    /**
     * @Route("/back-office", name="app_chien_index_back_office", methods={"GET"})
     */
    public function index_back_office(EntityManagerInterface $entityManager): Response
    {
        $chiens = $entityManager
            ->getRepository(Chien::class)
            ->findAll();

        return $this->render('chien/backOfficeShow.html.twig', [
            'chiens' => $chiens,
        ]);
    }
    /**
     * @Route("/my-dogs", name="app_chien_index_my_dogs", methods={"GET"})
     */
    public function index_my_dogs(EntityManagerInterface $entityManager): Response
    {
        $chiens = $entityManager
            ->getRepository(Chien::class)
            ->myDogs(array('idindividu'=>'2'));

        return $this->render('chien/myDogs.html.twig', [
            'chiens' => $chiens,
        ]);
    }

    /**
     * @Route("/dogs-next-door", name="app_chien_index_dogs-next-door", methods={"GET"})
     */
    public function index_dogs_next_door(): Response
    {
        $chiens = $this->getDoctrine()
            ->getRepository(Chien::class)
            ->findDogsNextDoor();

        return $this->render('chien/dogsNextDoor.html.twig', [
            'chiens' => $chiens,
        ]);
    }

    /**
     * @Route("/new", name="app_chien_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $chien = new Chien();
        $form = $this->createForm(ChienType::class, $chien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //recuperation des images transmises
            $image = $form->get('image')->getData();



            $fichier = md5(uniqid()) . '.' . $image->guessExtension();
            //On copie le fichier dans le dossier upload
            $image->move(
            $this->getParameter('upload_directory'),
            $fichier
            );
            // on stocke l'image dans la bdd (son nom)

            $chien->setImage($fichier);


            $entityManager->persist($chien);
            $entityManager->flush();

            return $this->redirectToRoute('app_chien_index_back_office', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chien/new.html.twig', [
            'chien' => $chien,
            'f' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idchien}", name="app_chien_show", methods={"GET"})
     */
    public function show(Chien $chien): Response
    {
        return $this->render('chien/show.html.twig', [
            'chien' => $chien,
        ]);
    }


    /**
     * @Route("/{idchien}/edit", name="app_chien_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Chien $chien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChienType::class, $chien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_chien_index_back_office', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chien/edit.html.twig', [
            'chien' => $chien,
            'f' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idchien}", name="app_chien_delete", methods={"POST"})
     */
    public function delete(Request $request, Chien $chien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chien->getIdchien(), $request->request->get('_token'))) {
            $entityManager->remove($chien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_chien_index_back_office', [], Response::HTTP_SEE_OTHER);
    }
}
