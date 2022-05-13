<?php

namespace App\Controller;

use App\Entity\Chien;
use App\Entity\Individu;
use App\Entity\Likes;
use App\Form\LikesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @Route("/likes")
 */
class LikesController extends AbstractController
{
    /**
     * @Route("/", name="app_likes_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $likes = $entityManager
            ->getRepository(Likes::class)
            ->findAll();

        return $this->render('likes/index.html.twig', [
            'likes' => $likes,
        ]);
    }


        /**
         * @Route("/{idchien}", name="app_nblikes", methods={"GET"})
         */

    public function getNbLikesByDog(EntityManagerInterface $entityManager,int $idchien)
    {
        $nblikes = $entityManager
            ->getRepository(Likes::class)
            ->getNbLikes($idchien);

        return $this->render('likes/nblikes.html.twig', [
            'nblikes' => $nblikes,
        ]);
    }

    /**
     * @Route("/addlike/{idchien}", name="app_likes_addlike", methods={"GET"})
     */

    public function addLike(EntityManagerInterface $entityManager,int $idchien): Response
    {

        $loggedinUser = $entityManager
            ->getRepository(Individu::class)
            ->findOneBy(array('idindividu' => '6'));

        $chien = $entityManager
            ->getRepository(Chien::class)
            ->findOneBy(array('idchien' => $idchien));
        $like=new likes($loggedinUser,$chien);
        $entityManager->persist($like);
        $entityManager->flush();

            return $this->redirectToRoute('app_chien_index_dogs-next-door');


    }

    /**
     * @Route("/addlikeshow/{idchien}", name="app_likes_addlike_show", methods={"GET"})
     */

    public function addLikeShow(EntityManagerInterface $entityManager,int $idchien): Response
    {



        $loggedinUser = $entityManager
            ->getRepository(Individu::class)
            ->findOneBy(array('idindividu' => '6'));

        $chien = $entityManager
            ->getRepository(Chien::class)
            ->findOneBy(array('idchien' => $idchien));
        $like=new likes($loggedinUser,$chien);
        $entityManager->persist($like);
        $entityManager->flush();

        return $this->redirectToRoute('app_chien_show',['chien'=>$idchien,'liked'=>1]);


    }
    /**
     * @Route("/removelike/{idchien}", name="app_likes_removelike", methods={"GET"})
     */

    public function removeLike(EntityManagerInterface $entityManager,int $idchien): Response
    {


        $like= $entityManager
            ->getRepository(Likes::class)
            ->findOneBy(array('idindividu'=>'6','idchien' => $idchien));
        $entityManager->remove($like);
        $entityManager->flush();

        return $this->redirectToRoute('app_chien_index_dogs-next-door');


    }

    /**
     * @Route("/removelikeshow/{idchien}", name="app_likes_removelike_show", methods={"GET"})
     */

    public function removeLikeShow(EntityManagerInterface $entityManager,int $idchien): Response
    {


        $like= $entityManager
            ->getRepository(Likes::class)
            ->findOneBy(array('idindividu'=>'6','idchien' => $idchien));
        $entityManager->remove($like);
        $entityManager->flush();

        return $this->redirectToRoute('app_chien_show',['chien'=>$idchien,'liked'=>0]);

    }
    /**
     * @Route("/new", name="app_likes_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $like = new Likes();
        $form = $this->createForm(LikesType::class, $like);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($like);
            $entityManager->flush();

            return $this->redirectToRoute('app_likes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('likes/new.html.twig', [
            'like' => $like,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idlike}", name="app_likes_show", methods={"GET"})
     */
    public function show(Likes $like): Response
    {
        return $this->render('likes/show.html.twig', [
            'like' => $like,
        ]);
    }

    /**
     * @Route("/{idlike}/edit", name="app_likes_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Likes $like, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LikesType::class, $like);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_likes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('likes/edit.html.twig', [
            'like' => $like,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idlike}", name="app_likes_delete", methods={"POST"})
     */
    public function delete(Request $request, Likes $like, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$like->getIdlike(), $request->request->get('_token'))) {
            $entityManager->remove($like);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_likes_index', [], Response::HTTP_SEE_OTHER);
    }


    /*************************JSON*************************/

    /**
     * @Route("/mobile/addlikemobile/mobile", name="add_like_mobile")
     *
     */

    public function addlikemobile(EntityManagerInterface $em,Request $request)
    {

        $idchien = $request->get("idchien");
        $idindividu = $request->get("idindividu");
        $chien = $em
            ->getRepository(Chien::class)
            ->findOneBy(array('idchien' => $idchien));
        $individu = $em
            ->getRepository(Individu::class)
            ->findOneBy(array('idindividu' => $idindividu));


        $like = new Likes($individu,$chien);

        $em->persist($like);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($like);
        return new JsonResponse($formatted);

    }

    /**
     * @Route("/mobile/removelikemobile", name="remove_like_mobile")
     *
     */

    public function removelikemobile(Request $request)
    {
        $idchien = $request->get("idchien");
        $idindividu = $request->get("idindividu");

        $em = $this->getDoctrine()->getManager();

        $like = $em
            ->getRepository(Likes::class)
            ->findOneBy(array('idindividu' => $idindividu,'idchien'=>$idchien));

        if($like!=null ) {
            $em->remove($like);
            $em->flush();

            $serialize = new Serializer([new ObjectNormalizer()]);
            $formatted = $serialize->normalize("like a ete supprime avec success.");
            return new JsonResponse($formatted);
        }
        return new JsonResponse("id like invalide");

    }


}
