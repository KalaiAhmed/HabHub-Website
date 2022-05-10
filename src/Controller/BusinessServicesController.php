<?php

namespace App\Controller;

use App\Entity\Business;
use App\Entity\BusinessServices;
use App\Form\BusinessServicesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @Route("/business/services")
 */
class BusinessServicesController extends AbstractController
{
    /**
     * @Route("/{idbusiness}", name="app_business_services_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager,int $idbusiness)
    {
        $businessServices = $entityManager
            ->getRepository(BusinessServices::class)
            ->findBy(array('idbusiness'=>$idbusiness));

        return $this->render('business_services/index.html.twig', [
            'business_services' => $businessServices,
        ]);
    }

    /**
     * @Route("/new", name="app_business_services_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $businessService = new BusinessServices();
        $form = $this->createForm(BusinessServicesType::class, $businessService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($businessService);
            $entityManager->flush();

            return $this->redirectToRoute('app_business_services_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('business_services/new.html.twig', [
            'business_service' => $businessService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idbusinessservices}", name="app_business_services_show", methods={"GET"})
     */
    public function show(BusinessServices $businessService): Response
    {
        return $this->render('business_services/show.html.twig', [
            'business_service' => $businessService,
        ]);
    }

    /**
     * @Route("/{idbusinessservices}/edit", name="app_business_services_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, BusinessServices $businessService, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BusinessServicesType::class, $businessService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_business_services_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('business_services/edit.html.twig', [
            'business_service' => $businessService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idbusinessservices}", name="app_business_services_delete", methods={"POST"})
     */
    public function delete(Request $request, BusinessServices $businessService, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$businessService->getIdbusinessservices(), $request->request->get('_token'))) {
            $entityManager->remove($businessService);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_business_services_index', [], Response::HTTP_SEE_OTHER);
    }
    /***********************************JSON METHODS***********************************/
    /**
     * @Route("/mobile/index", name="app_businesssevices_index_mobile", methods={"GET"})
     */
    public function index_mobile(Request $request)
    {

        $idbusiness = $request->query->get("idbusiness");
        $bservices = $this->getDoctrine()->getManager()
            ->getRepository(BusinessServices::class)
            ->findBy(array('idbusiness'=>$idbusiness));
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($bservices);

        return new JsonResponse($formatted);
    }

    /************************************END JSON METHODS***********************************/

}
