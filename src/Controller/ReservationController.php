<?php

namespace App\Controller;

use App\Entity\BusinessServices;
use App\Entity\Individu;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservation")
 */
class ReservationController extends AbstractController
{

    /**
     * @Route("/back-office", name="app_reservation_index_back_office", methods={"GET"})
     */
    public function index_back_office(EntityManagerInterface $entityManager): Response
    {
        $reservations = $entityManager
            ->getRepository(Reservation::class)
            ->findAll();

        return $this->render('reservation/index_back_office.html.twig', [
            'reservations' => $reservations,
        ]);
    }
    /**
     * @Route("/", name="app_reservation_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reservations = $entityManager
            ->getRepository(Reservation::class)
            ->findBy(array('idindividu'=>'2'));

        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    /**
     * @Route("/new/back-office", name="app_reservation_new_back_office", methods={"GET", "POST"})
     */
    public function new_back_office(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_index_back_office', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation/new_back_office.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/new", name="app_reservation_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/new/{idbusinessservices}", name="app_reservation_new", methods={"GET", "POST"})
     */
    public function new_reservation_front(Request $request, EntityManagerInterface $entityManager,int $idbusinessservices): Response
    {
        $reservation = new Reservation();

        $reservation->setIdindividu( $entityManager
            ->getRepository(Individu::class)
            ->findOneBy(array('idindividu' => '2')));

        $reservation->setIdbusinessservices( $entityManager
            ->getRepository(BusinessServices::class)
            ->findOneBy(array('idbusinessservices' => $idbusinessservices)));

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('app_business_show', ['idbusiness' => $reservation->getIdbusinessservices()->getIdBusiness()->getIdBusiness()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('businessservices/index.html.twig', [
            'reservation' => $reservation,
            'formula' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idreservation}/back-office", name="app_reservation_show_back_office", methods={"GET"})
     */
    public function show_back_office(Reservation $reservation): Response
    {
        return $this->render('reservation/show_back_office.html.twig', [
            'reservation' => $reservation,
        ]);
    }
    /**
     * @Route("/{idreservation}", name="app_reservation_show", methods={"GET"})
     */
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    /**
     * @Route("/{idreservation}/edit/back-office", name="app_reservation_edit_back_office", methods={"GET", "POST"})
     */
    public function edit_back_office(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_index_back_office', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation/edit_back_office.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{idreservation}/edit", name="app_reservation_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{idreservation}/back-office", name="app_reservation_delete_back_office", methods={"POST"})
     */
    public function delete_back_office(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getIdreservation(), $request->request->get('_token'))) {
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_index_back_office', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{idreservation}", name="app_reservation_delete", methods={"POST"})
     */
    public function delete(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getIdreservation(), $request->request->get('_token'))) {
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
