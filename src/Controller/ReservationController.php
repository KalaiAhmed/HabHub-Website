<?php

namespace App\Controller;

use App\Entity\BusinessServices;
use App\Entity\Individu;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Util\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\Json;
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
        $individu = $entityManager->getRepository(Individu::class)->getIndividuByUser($this->getUser()->getUsername());
        $id=$individu->getIdIndividu();


        $reservations = $entityManager
            ->getRepository(Reservation::class)
            ->findBy(array('idindividu'=>$id));

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
        $individu = $entityManager->getRepository(Individu::class)->getIndividuByUser($this->getUser()->getUsername());
        $id=$individu->getIdIndividu();


        $reservation->setIdindividu( $entityManager
            ->getRepository(Individu::class)
            ->findOneBy(array('idindividu' => $id)));

        $reservation->setIdbusinessservices( $entityManager
            ->getRepository(BusinessServices::class)
            ->findOneBy(array('idbusinessservices' => $idbusinessservices)));

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservation);
            $entityManager->flush();
            $this->confirmReservation($reservation);

            return $this->redirectToRoute('app_business_show', ['idbusiness' => $reservation->getIdbusinessservices()->getIdBusiness()->getIdBusiness()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation/new.html.twig', [
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
     * @Route("/{idreservation}/back-office", name="app_reservation_delete_back_office", methods={"GET"})
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
     * @Route("/{idreservation}", name="app_reservation_delete", methods={"GET"})
     */
    public function delete(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getIdreservation(), $request->request->get('_token'))) {
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
    }

    public function confirmReservation(Reservation $reservation): Response
    {
        //$recipient='+216'.strval($reservation->getIdindividu()->getIdutilisateur()->getNumtel());
        $originator='+21692962405';
        $recipient='+21692962405';

        $text='Confirmation de réservation du service "'.$reservation->getIdbusinessservices()->getNomservice().'" sous le nom: "'.$reservation->getIdindividu()->getPrenom().' '.$reservation->getIdindividu()->getNom().'" pour le '.$reservation->getDatereservation()->format('d-m-Y').' '.$reservation->getHeurereservation();
        $messageBird = new \MessageBird\Client('3jCpdTd7mvp1JPdZrb1hdJbG0'); //test
        //$messageBird = new \MessageBird\Client('lPUuEHDNz2QeFFW1pWBPoJEZi'); //live_mariem
        //$messageBird = new \MessageBird\Client('lwXWiTInBuKkCX5zbweIA1JhY'); //live_hamidou


        $message =  new \MessageBird\Objects\Message();
        try{

            $message->originator = $originator;
            $message->recipients = $recipient;
            $message->body = $text;
            $response = $messageBird->messages->create($message);


            //print_r($response);
            dump($response);
        }
        catch(Exception $e) {echo $e;}

        return $this->redirectToRoute('app_business_show', ['idbusiness' => $reservation->getIdbusinessservices()->getIdBusiness()->getIdBusiness()], Response::HTTP_SEE_OTHER);
    }

    public function sendSMS(Reservation $reservation){
        $twilio = $this->get('twilio.client');
        $text="Confirmation de réservation du service".$reservation->getIdbusinessservices()." sous le nom:".$reservation->getIdindividu()."date et heure : ".$reservation->getHeurereservation();
        $twilio->messages->create('+216'.strval($reservation->getIdindividu()->getIdutilisateur()->getNumtel()),[
            'from'=>'+19403013325',
            'body'=>$text]
        );
    }

/***********************************JSON METHODS***********************************/

    /**
     * @Route("/mobile/index", name="app_reservation_index_mobile", methods={"GET"})
     */
    public function index_mobile(EntityManagerInterface $entityManager)
    {
        $individu = $entityManager->getRepository(Individu::class)->getIndividuByUser($this->getUser()->getUsername());
        $id=$individu->getIdIndividu();

        $reservations = $entityManager
            ->getRepository(Reservation::class)
            ->findBy(array('idindividu'=>$id));
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($reservations);

        return new JsonResponse($formatted);

    }

    /**
     * @Route("/mobile/new-reservation", name="app_reservation_new_mobile", methods={"GET", "POST"})
     *
     */
    //test with : http://127.0.0.1:8000/reservation/new-reservation/mobile?idbusinessservices=5&datereservation=2022-05-16&heurereservation=9AM-10AM&idindividu=3
    public function new_mobile(Request $request, EntityManagerInterface $entityManager)
    {
        $reservation = new Reservation();
        $idbusinessservices = $request->query->get("idbusinessservices");
        $datereservation = $request->query->get("datereservation");
        $heurereservation = $request->query->get("heurereservation");
        $idindividu = $request->query->get("idindividu");

        $reservation->setIdindividu( $entityManager
            ->getRepository(Individu::class)
            ->findOneBy(array('idindividu' => $idindividu)));

        $reservation->setIdbusinessservices( $entityManager
            ->getRepository(BusinessServices::class)
            ->findOneBy(array('idbusinessservices' => $idbusinessservices)));

        $date=new \DateTime($datereservation); //2022-05-16
        $reservation->setDatereservation($date);
        $reservation->setHeurereservation($heurereservation);

        $entityManager->persist($reservation);
        $entityManager->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($reservation);
        return new JsonResponse($formatted);
    }
    /**
     * @Route("/mobile/edit-reservation", name="app_reservation_edit_mobile", methods={"GET", "POST"})
     */
    public function edit_mobile(Request $request)
    {   $em = $this->getDoctrine()->getManager();
        $idreservation=$request->query->get("idreservation");
        $datereservation = $request->query->get("datereservation");
        $heurereservation = $request->query->get("heurereservation");
        $reservation =$em->getRepository(Reservation::class)
            ->findOneBy(array('idreservation' => $idreservation));

        $date=new \DateTime($datereservation); //2022-05-16
        $reservation->setDatereservation($date);
        $reservation->setHeurereservation($heurereservation);
        $em->persist($reservation);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($reservation);
        return new JsonResponse("Reservation a ete modifiée avec success.");

    }




    /**
     * @Route("/mobile/delete", name="app_reservation_delete_mobile", methods={"GET"})
     */
    public function delete_mobile(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idreservation=$request->query->get("idreservation");
        $reservation =$em->getRepository(Reservation::class)
            ->findOneBy(array('idreservation' => $idreservation));
        if($reservation!=null ) {
            $em->remove($reservation);
            $em->flush();

            $serialize = new Serializer([new ObjectNormalizer()]);
            $formatted = $serialize->normalize("Reservation a ete supprimee avec success.");
            return new JsonResponse($formatted);

        }
        return new JsonResponse("id reclamation invalide.");


    }


    /**
     * @Route("/mobile/show", name="app_reservation_show_mobile", methods={"GET"})
     */
    public function show_mobile(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idreservation=$request->query->get("idreservation");
        $reservation =$em->getRepository(Reservation::class)
            ->findOneBy(array('idreservation' => $idreservation));
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getHeureReservation();
        });
        $serializer = new Serializer([$normalizer], [$encoder]);
        $formatted = $serializer->normalize($reservation );
        return new JsonResponse($formatted);
    }
    /***********************************END JSON METHODS***********************************/

}
