<?php

namespace App\Controller;

use App\Entity\Chien;
use App\Entity\Individu;
use App\Entity\Likes;
use App\Form\LikesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
            ->findOneBy(array('idindividu' => '2'));

        $chien = $entityManager
            ->getRepository(Chien::class)
            ->findOneBy(array('idchien' => $idchien));
        $like=new likes($loggedinUser,$chien);
        $entityManager->persist($like);
        $entityManager->flush();

            return $this->redirectToRoute('app_chien_index_dogs-next-door');


    }
    /**
     * @Route("/addlike/{idchien}", name="app_likes_removelike", methods={"GET"})
     */

    public function removeLike(EntityManagerInterface $entityManager,int $idchien): Response
    {


        $like= $entityManager
            ->getRepository(Likes::class)
            ->findOneBy(array('idindividu'=>'2','idchien' => $idchien));
        $entityManager->remove($like);
        $entityManager->flush();

        return $this->redirectToRoute('app_chien_index_dogs-next-door');


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
}
