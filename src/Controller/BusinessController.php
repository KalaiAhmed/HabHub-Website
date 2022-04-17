<?php

namespace App\Controller;

use App\Entity\Business;
use App\Form\BusinessType;
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

        return $this->render('business/testShow.html.twig', [
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
            $file= $business->getImage();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            $business->setImage($fileName);
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
    public function show(Business $business): Response
    {
        return $this->render('business/show.html.twig', [
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
