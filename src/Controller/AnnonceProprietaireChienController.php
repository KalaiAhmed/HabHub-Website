<?php

namespace App\Controller;

use App\Entity\AnnonceProprietaireChien;
use App\Entity\Chien;
use App\Form\AnnonceProprietaireChienType;
use App\Form\FrontAnnonceProprietaireChienType;
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

/**
 * @Route("/annonce-proprietaire-chien")
 */
class AnnonceProprietaireChienController extends AbstractController
{

    /**
     * @Route("/lost-back", name="app_annonce_proprietaire_chien_index_lost_back", methods={"GET"})
     */
    public function indexLostBack(EntityManagerInterface $entityManager): Response
    {
        $annonceProprietaireChiens = $entityManager
            ->getRepository(AnnonceProprietaireChien::class)
            ->findBy(array('type' => 'P'));

        return $this->render('annonce_proprietaire_chien/index.html.twig', [
            'annonce_proprietaire_chiens' => $annonceProprietaireChiens,
        ]);
    }
    /**
     * @Route("/mating-back", name="app_annonce_proprietaire_chien_index_mating_back", methods={"GET"})
     */
    public function indexMatingBack(EntityManagerInterface $entityManager): Response
    {
        $annonceProprietaireChiens = $entityManager
            ->getRepository(AnnonceProprietaireChien::class)
            ->findBy(array('type' => 'A'));

        return $this->render('annonce_proprietaire_chien/index.html.twig', [
            'annonce_proprietaire_chiens' => $annonceProprietaireChiens,
        ]);
    }
    /**
     * @Route("/lost", name="app_annonce_proprietaire_chien_index_lost", methods={"GET"})
     */
    public function indexLost(EntityManagerInterface $entityManager,Request $request): Response
    {
        $filters=$request->get("categories");
        $search=$request->get("search");
        dump($filters);
        $annonces = $entityManager
            ->getRepository(AnnonceProprietaireChien::class)
            ->searchFilterPosts($filters,$search,'P');

        if($request->get('ajax')){
            return new JsonResponse([
                'content' =>$this->renderView('annonce_proprietaire_chien/_lostContent.html.twig', [
                    'annonce_proprietaire_chiens' => $annonces,
                ])
            ]);
        }
        $annonce = $entityManager
            ->getRepository(AnnonceProprietaireChien::class)
            ->findBy(array('type' => 'P'));
        return $this->render('annonce_proprietaire_chien/frontOfficeIndexLost.html.twig', [
            'annonce_proprietaire_chiens' => $annonce,
        ]);
    }

    /**
     * @Route("/mating", name="app_annonce_proprietaire_chien_index_mating", methods={"GET"})
     */
    public function indexMating(EntityManagerInterface $entityManager,Request $request): Response
    {
        $filters=$request->get("categories");
        $search=$request->get("search");
        dump($search);
        $annonces = $entityManager
            ->getRepository(AnnonceProprietaireChien::class)
            ->searchFilterPosts($filters,$search,'A');
        dump($annonces);

        if($request->get('ajax')){
            return new JsonResponse([
                'content' =>$this->renderView('annonce_proprietaire_chien/_matingcontent.html.twig', [
                    'annonce_proprietaire_chiens' => $annonces,
                ])
            ]);
        }
        $annonce = $entityManager
            ->getRepository(AnnonceProprietaireChien::class)
            ->findBy(array('type' => 'A'));
        return $this->render('annonce_proprietaire_chien/frontOfficeIndex.html.twig', [
            'annonce_proprietaire_chiens' => $annonce,
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
     * @Route("/lost/{annonceProprietaireChien}", name="app_annonce_proprietaire_chien_show_lost", methods={"GET","POST"})
     */
    public function showLost(AnnonceProprietaireChien $annonceProprietaireChien,Request $request , EntityManagerInterface $entityManager): Response
    {
        $dummyAnnonce = new AnnonceProprietaireChien();
        $form = $this->createForm(FrontAnnonceProprietaireChienType::class, $dummyAnnonce);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $text = $dummyAnnonce->getDescription();
            $recepient = '+216' . strval($annonceProprietaireChien->getIdchien()->getIdindividu()->getIdutilisateur()->getNumtel());
           //$recepient='+21692962405';

            $messageBird = new \MessageBird\Client('PMEGViucdqQMf9rgq9Z0YEu5Z'); //test
           //$messageBird = new \MessageBird\Client('lPUuEHDNz2QeFFW1pWBPoJEZi'); //live_mariem
            //$messageBird = new \MessageBird\Client('lwXWiTInBuKkCX5zbweIA1JhY'); //live_hamidou
            $message = new \MessageBird\Objects\Message();
            try {

                $message->originator = $recepient;
                $message->recipients = $recepient;
                $message->body = 'Your dog '.$annonceProprietaireChien->getIdchien()->getNom().' has been seen in : ' . $text." :')";
                $response = $messageBird->messages->create($message);


                dump($response);
            } catch (Exception $e) {
                echo $e;
            }
            unset ($dummyAnnonce);
        }
        return $this->render('annonce_proprietaire_chien/showLost.html.twig', [
            'annonce_proprietaire_chien' => $annonceProprietaireChien,
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/mating/{annonceProprietaireChien}", name="app_annonce_proprietaire_chien_show_mating", methods={"GET"})
     */
    public function showMating(AnnonceProprietaireChien $annonceProprietaireChien): Response
    {
        return $this->render('annonce_proprietaire_chien/showMating.html.twig', [
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

            return $this->redirectToRoute('app_annonce_proprietaire_chien_index_lost_back', [], Response::HTTP_SEE_OTHER);
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

    /**
     * @Route("/addlost/{idchien}", name="app_annonce_proprietaire_chien_addlost", methods={"GET"})
     */

    public function addLostDog(EntityManagerInterface $entityManager,int $idchien): Response
    {

        $chien = $entityManager
            ->getRepository(Chien::class)
            ->findOneBy(array('idchien' => $idchien));
        $annonce=new AnnonceProprietaireChien();
        $annonce->setIdchien($chien);
        $annonce->setType('P');
        $annonce->setDatepublication(new \DateTime());
        $annonce->setLocalisation($chien->getIdIndividu()->getAdresse());
        $annonce->setDateperte(new \DateTime());
        $entityManager->persist($annonce);
        $entityManager->flush();

        return $this->redirectToRoute('app_chien_index_my_dogs');


    }

    /**
     * @Route("/removelost/{idchien}", name="app_annonce_proprietaire_chien_removelost", methods={"GET"})
     */

    public function removeLostDog(EntityManagerInterface $entityManager,int $idchien): Response
    {



        $annonce= $entityManager
            ->getRepository(AnnonceProprietaireChien::class)
            ->findOneBy(array('idchien' => $idchien,'type'=>'P'));

        $entityManager->remove($annonce);
        $entityManager->flush();

        return $this->redirectToRoute('app_chien_index_my_dogs');


    }

    /**
     * @Route("/addmating/{idchien}", name="app_annonce_proprietaire_chien_addmating", methods={"GET"})
     */

    public function addMatingDog(EntityManagerInterface $entityManager,int $idchien): Response
    {



        $chien = $entityManager
            ->getRepository(Chien::class)
            ->findOneBy(array('idchien' => $idchien));
        $annonce=new AnnonceProprietaireChien();
        $annonce->setIdchien($chien);
        $annonce->setType('A');
        $annonce->setLocalisation($chien->getIdIndividu()->getAdresse());
        $annonce->setDatepublication(new \DateTime());
        $entityManager->persist($annonce);
        $entityManager->flush();

        return $this->redirectToRoute('app_chien_index_my_dogs');


    }

    /**
     * @Route("/removemating/{idchien}", name="app_annonce_proprietaire_chien_removemating", methods={"GET"})
     */

    public function removeMatingDog(EntityManagerInterface $entityManager,int $idchien): Response
    {




        $annonce= $entityManager
            ->getRepository(AnnonceProprietaireChien::class)
            ->findOneBy(array('idchien' => $idchien,'type'=>'A'));

        $entityManager->remove($annonce);
        $entityManager->flush();

        return $this->redirectToRoute('app_chien_index_my_dogs');


    }

    /**************************JSON******************************/
    /**
     * @Route("/displayLost", name="app_annonce_proprietaire_chien_mobile_display_lost", methods={"GET"})
     */
    public function displayLost(EntityManagerInterface $entityManager): Response
    {
        $annonceProprietaireChiens = $entityManager
            ->getRepository(AnnonceProprietaireChien::class)
            ->findBy(array('type' => 'P'));
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($annonceProprietaireChiens);

        return new JsonResponse($formatted);
    }
    /**
     * @Route("/displayMating", name="app_annonce_proprietaire_chien_mobile_display_mating", methods={"GET"})
     */
    public function displayMating(EntityManagerInterface $entityManager): Response
    {
        $annonceProprietaireChiens = $entityManager
            ->getRepository(AnnonceProprietaireChien::class)
            ->findBy(array('type' => 'A'));
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($annonceProprietaireChiens);

        return new JsonResponse($formatted);
    }
    /**
     * @Route("/addlostdog", name="app_annonce_proprietaire_chien_addlost_mobile", methods={"GET"})
     */

    public function addLostDogMobile(EntityManagerInterface $entityManager,Request $request): Response
    {
        $id = $request->get("id");
        $chien = $entityManager
            ->getRepository(Chien::class)
            ->findOneBy(array('idchien' => $id));
        $annonce=new AnnonceProprietaireChien();
        $annonce->setIdchien($chien);
        $annonce->setType('P');
        $annonce->setDatepublication(new \DateTime());
        $annonce->setLocalisation($chien->getIdIndividu()->getAdresse());
        $annonce->setDateperte(new \DateTime());
        $entityManager->persist($annonce);
        $entityManager->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($annonce);

        return new JsonResponse($formatted);


    }

    /**
     * @Route("/removelostdog", name="app_annonce_proprietaire_chien_removelost_mobile", methods={"GET"})
     */

    public function removeLostDogMobile(EntityManagerInterface $entityManager,Request $request): Response
    {

        $id = $request->get("id");
        $annonce= $entityManager
            ->getRepository(AnnonceProprietaireChien::class)
            ->findOneBy(array('idchien' => $id,'type'=>'P'));

        if($annonce!=null ) {
            $entityManager->remove($annonce);
            $entityManager->flush();

            $serialize = new Serializer([new ObjectNormalizer()]);
            $formatted = $serialize->normalize("Annonce a ete supprime avec success.");
            return new JsonResponse($formatted);
        }
        return new JsonResponse("id annonce invalide");


    }

    /**
     * @Route("/addmatingdog", name="app_annonce_proprietaire_chien_addmating_mobile", methods={"GET"})
     */

    public function addMatingDogMobile(EntityManagerInterface $entityManager,Request $request): Response
    {

        $id = $request->get("id");

        $chien = $entityManager
            ->getRepository(Chien::class)
            ->findOneBy(array('idchien' => $id));
        $annonce=new AnnonceProprietaireChien();
        $annonce->setIdchien($chien);
        $annonce->setType('A');
        $annonce->setLocalisation($chien->getIdIndividu()->getAdresse());
        $annonce->setDatepublication(new \DateTime());
        $entityManager->persist($annonce);
        $entityManager->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($annonce);

        return new JsonResponse($formatted);


    }

    /**
     * @Route("/removematingdog", name="app_annonce_proprietaire_chien_removemating_mobile", methods={"GET"})
     */

    public function removeMatingDogMobile(EntityManagerInterface $entityManager,Request $request): Response
    {
        $id = $request->get("id");
        $annonce= $entityManager
            ->getRepository(AnnonceProprietaireChien::class)
            ->findOneBy(array('idchien' => $id,'type'=>'A'));

        if($annonce!=null ) {
            $entityManager->remove($annonce);
            $entityManager->flush();

            $serialize = new Serializer([new ObjectNormalizer()]);
            $formatted = $serialize->normalize("Annonce a ete supprime avec success.");
            return new JsonResponse($formatted);
        }
        return new JsonResponse("id annonce invalide");
    }

    /**
     * @Route("/detaillost", name="detail_annonce_lost",methods={"GET"})
     *
     */

    public function detailAnnonceLost(EntityManagerInterface $entityManager,Request $request)
    {
        $id = $request->get("id");
        $annonce= $entityManager
            ->getRepository(AnnonceProprietaireChien::class)
            ->findOneBy(array('idchien' => $id,'type'=>'P'));
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getDescription();
        });
        $serializer = new Serializer([$normalizer], [$encoder]);
        $formatted = $serializer->normalize($annonce);
        return new JsonResponse($formatted);
    }

    /**
     * @Route("/detailmating", name="detail_annonce_mating",methods={"GET"})
     *
     */

    public function detailAnnonceMating(EntityManagerInterface $entityManager,Request $request)
    {
        $id = $request->get("id");
        $annonce= $entityManager
            ->getRepository(AnnonceProprietaireChien::class)
            ->findOneBy(array('idchien' => $id,'type'=>'A'));
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getDescription();
        });
        $serializer = new Serializer([$normalizer], [$encoder]);
        $formatted = $serializer->normalize($annonce);
        return new JsonResponse($formatted);
    }
}


