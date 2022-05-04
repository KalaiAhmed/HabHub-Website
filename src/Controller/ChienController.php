<?php

namespace App\Controller;

use App\Entity\Chien;
use App\Entity\Individu;
use App\Form\ChienType;
use App\Form\ChienTypeFrontType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


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
            ->myDogs();

        return $this->render('chien/myDogs.html.twig', [
            'chiens' => $chiens,
        ]);
    }

    /**
     * @Route("/dogs-next-door", name="app_chien_index_dogs-next-door", methods={"GET"})
     */
    public function index_dogs_next_door(EntityManagerInterface $entityManager,Request $request): Response
    {
        $filters=$request->get("categories");
        $search=$request->get("search");
        $chiensSearchedFiltered=$this->getDoctrine()
            ->getRepository(Chien::class)
            ->searchFilterDogsNextDoor($filters,$search);
        if($request->get('ajax')){
            return new JsonResponse([
                'content' =>$this->renderView('chien/_dogsNextDoorContent.html.twig', [
                    'chiens' => $chiensSearchedFiltered,
                ])
            ]);
        }
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
     * @Route("/new-front", name="app_chien_new_front", methods={"GET", "POST"})
     */
    public function newfront(Request $request, EntityManagerInterface $entityManager): Response
    {
        $loggedinUser = $entityManager
            ->getRepository(Individu::class)
            ->findOneBy(array('idindividu' => '6'));
        $chien = new Chien();
        $form = $this->createForm(ChienTypeFrontType::class, $chien);
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
            $chien->setIdindividu($loggedinUser);

            $entityManager->persist($chien);
            $entityManager->flush();

            return $this->redirectToRoute('app_chien_index_my_dogs', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chien/newfront.html.twig', [
            'chien' => $chien,
            'f' => $form->createView(),
        ]);
    }

    /**
     * @Route("/details/{liked}/{chien}", name="app_chien_show", methods={"GET"})
     */
    public function show(Chien $chien,int $liked): Response
    {
        return $this->render('chien/show.html.twig', [
            'chien' => $chien,
            'liked' => $liked,
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

    /**
     * @Route("/deleteFront/{idchien}", name="app_chien_delete_front", methods={"GET"})
     */

    public function removeChien(EntityManagerInterface $entityManager,int $idchien): Response
    {


        $chien= $entityManager
            ->getRepository(Chien::class)
            ->findOneBy(array('idchien' => $idchien));
        $entityManager->remove($chien);
        $entityManager->flush();

        return $this->redirectToRoute('app_chien_index_my_dogs');


    }

    /*----------------Webservice Json----------------*/
    /**
     * @Route("/displayMyDogs", name="display_my_dogs",methods={"GET"})
     *
     */
    public function allMyDogs(Request $request)
    {
        $id = $request->get("id");
        $chiens = $this->getDoctrine()->getManager()->getRepository(Chien::class)->myDogsMobile($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($chiens);

        return new JsonResponse($formatted);

    }

/**
 * @Route("/displayDogsNextDoor", name="display_dogs_next_door",methods={"GET"})
 *
 */
public function allDogsNextDoor(Request $request)
{
    $id = $request->get("id");
    $chiens = $this->getDoctrine()->getManager()->getRepository(Chien::class)->findDogsNextDoorMobile($id);
    $serializer = new Serializer([new ObjectNormalizer()]);
    $formatted = $serializer->normalize($chiens);

    return new JsonResponse($formatted);

}

    /**
     * @Route("/deleteDog", name="app_chien_delete", methods={"GET"})
     */

    public function removeDog(EntityManagerInterface $entityManager,Request $request): Response
    {

        $id = $request->get("id");
        $chien= $entityManager
            ->getRepository(Chien::class)
            ->findOneBy(array('idchien' => $id));
        if($chien!=null ) {
            $entityManager->remove($chien);
            $entityManager->flush();

            $serialize = new Serializer([new ObjectNormalizer()]);
            $formatted = $serialize->normalize("Chien a ete supprime avec success.");
            return new JsonResponse($formatted);
        }
        return new JsonResponse("id chien invalide");

    }

    /**
     * @Route("/addDog", name="add_dog",methods={"GET","POST"})
     *
     */

    //test with : http://127.0.0.1:8000/reservation/new-reservation/mobile?idbusinessservices=5&datereservation=2022-05-16&heurereservation=9AM-10AM&idindividu=3
    public function addDog(Request $request, EntityManagerInterface $entityManager)
    {
        $chien = new Chien();
        $nom = $request->query->get("nom");
        $age = $request->query->get("age");
        $sexe = $request->query->get("sexe");
        $vaccination = $request->query->get("vaccination");
        $description = $request->query->get("description");
        $color = $request->query->get("color");
        $race = $request->query->get("race");
        $groupe = $request->query->get("groupe");
        $idindividu = $request->query->get("idindividu");

        $chien->setIdindividu( $entityManager
            ->getRepository(Individu::class)
            ->findOneBy(array('idindividu' => $idindividu)));

        $chien->setNom($nom);
        $chien->setAge($age);
        $chien->setSexe($sexe);
        $chien->setVaccination($vaccination);
        $chien->setDescription($description);
        $chien->setColor($color);
        $chien->setRace($race);
        $chien->setGroupe($groupe);


        $entityManager->persist($chien);
        $entityManager->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($chien);
        return new JsonResponse($formatted);
    }

    /**
     * @Route("/detaildog", name="detail_dog",methods={"GET"})
     *
     */

    public function detailDog(EntityManagerInterface $entityManager,Request $request)
    {
        $id = $request->get("id");
        $chien= $entityManager
            ->getRepository(Chien::class)
            ->findOneBy(array('idchien' => $id));
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getDescription();
        });
        $serializer = new Serializer([$normalizer], [$encoder]);
        $formatted = $serializer->normalize($chien);
        return new JsonResponse($formatted);
    }

}
