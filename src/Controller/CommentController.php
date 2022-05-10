<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CommentType;
use App\Entity\Comment;

/**
     * @Route("/comment", name="app_comment")
     */

class CommentController extends AbstractController
{


    /**
     * @Route("/new", name="app_new_comment", methods={"GET", "POST"})
     */
    public function show(Request $request,EntityManagerInterface $entityManager ): Response
    {
        // Partie commentaires
        $comment = new Comment();
        $commentForm = $this->createForm(CommentType::class, $comment);

        //get loggedinUser
        $loggedinUser = $entityManager
            ->getRepository(Individu::class)
            ->findOneBy(array('idindividu' => '2'));

        $commentForm->handleRequest($request);

        if($commentForm->isSubmitted() && $commentForm->isValid()){

            $comment->setCreatedAt(new \DateTime('now'));
            $comment->setIdannonceadoption($annonceAdoption);
            $comment->setIdindividu($loggedinUser);

            $entityManager->persist($comment);
            $entityManager->flush();

            $this->addFlash('message', 'Votre commentaire a bien été envoyé');
            return $this->redirectToRoute('app_annonce_adoption_show',array(
                'annonceAdoption' => $annonceAdoption));
        }
    }



}
