<?php

namespace App\Controller;

use App\Entity\Business;
use App\Entity\Revue;
use App\Form\BusinessType;
use App\Form\RevueType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/business")
 */
class BusinessController extends AbstractController
{

    /**
     * @Route("/back-office", name="app_business_index_back_office", methods={"GET"})
     */
    public function index_back_office(EntityManagerInterface $entityManager): Response
    {
        $businesses = $entityManager
            ->getRepository(Business::class)
            ->findAll();

        return $this->render('business/index.html.twig', [
            'businesses' => $businesses,
        ]);
    }
    /**
     * @Route("/", name="app_business_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $businesses = $entityManager
            ->getRepository(Business::class)
            ->findAll();

        return $this->render('business/frontOfficeIndex.html.twig', [
            'businesses' => $businesses,
        ]);
    }
    /**
     * @Route("/vets", name="app_business_index_vets", methods={"GET"})
     */

    public function show_all_vets(EntityManagerInterface $entityManager): Response
    {
        $businesses = $entityManager
            ->getRepository(Business::class)
            ->findBy(array('type'=>'vet'));
        return $this->render('business/frontOfficeIndex.html.twig', [
            'businesses' => $businesses,
        ]);
    }
    /**
     * @Route("/grooming", name="app_business_index_grooming", methods={"GET"})
     */

    public function show_all_grooming(EntityManagerInterface $entityManager): Response
    {
        $businesses = $entityManager
            ->getRepository(Business::class)
            ->findBy(array('type'=>'grooming'));
        return $this->render('business/frontOfficeIndex.html.twig', [
            'businesses' => $businesses,
        ]);
    }
    /**
     * @Route("/dogsitting", name="app_business_index_dogsitting", methods={"GET"})
     */

    public function show_all_dogsitting(EntityManagerInterface $entityManager): Response
    {
        $businesses = $entityManager
            ->getRepository(Business::class)
            ->findBy(array('type'=>'dogsitting'));
        return $this->render('business/frontOfficeIndex.html.twig', [
            'businesses' => $businesses,
        ]);
    }
    /**
     * @Route("/parks", name="app_business_index_parks", methods={"GET"})
     */

    public function show_all_parks(EntityManagerInterface $entityManager): Response
    {
        $businesses = $entityManager
            ->getRepository(Business::class)
            ->findBy(array('type'=>'parks'));
        return $this->render('business/frontOfficeIndex.html.twig', [
            'businesses' => $businesses,
        ]);
    }

    /**
     * @Route("/new-back-office", name="app_business_new_back_office", methods={"GET", "POST"})
     */
    public function new_back_office(Request $request, EntityManagerInterface $entityManager): Response
    {
        $business = new Business();
        $form = $this->createForm(BusinessType::class, $business);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            $fichier = md5(uniqid()) . '.' . $image->guessExtension();
            $image->move(
                $this->getParameter('upload_directory'),
                $fichier
            );
            $business->setImage($fichier);


            $entityManager->persist($business);
            $entityManager->flush();

            return $this->redirectToRoute('app_business_index_back_office', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('business/backOfficeNew.html.twig', [
            'business' => $business,
            'f' => $form->createView(),
        ]);
    }



    /**
     * @Route("/new", name="app_business_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $business = new Business();
        $form = $this->createForm(BusinessType::class, $business);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($business);
            $entityManager->flush();

            return $this->redirectToRoute('app_business_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('business/new.html.twig', [
            'business' => $business,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idbusiness}", name="app_business_show", methods={"GET"})
     */
    public function show(Business $business,Request $request, EntityManagerInterface $entityManager): Response
    {
        $revues=$this->forward('App\Controller\RevueController::index', [
        'business'  => $business,

    ]);

        return $this->render('business/show.html.twig', [
            'business' => $business,


        ]);
    }
    /**
     * @Route("/{idbusiness}/back-office", name="app_business_show_back_office", methods={"GET"})
     */
    public function show_back_office(Business $business): Response
    {
        return $this->render('business/show_back_office.html.twig', [
            'business' => $business,
        ]);
    }
    /**
     * @Route("/{idbusiness}/edit-back-office", name="app_business_edit_back_office", methods={"GET", "POST"})
     */
    public function edit_back_office(Request $request, Business $business, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BusinessType::class, $business);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_business_index_back_office', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('business/edit.html.twig', [
            'business' => $business,
            'f' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idbusiness}/edit", name="app_business_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Business $business, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BusinessType::class, $business);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_business_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('business/edit.html.twig', [
            'business' => $business,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idbusiness}", name="app_business_delete", methods={"POST"})
     */
    public function delete(Request $request, Business $business, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$business->getIdbusiness(), $request->request->get('_token'))) {
            $entityManager->remove($business);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_business_index_back_office', [], Response::HTTP_SEE_OTHER);
    }
}
