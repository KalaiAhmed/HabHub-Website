<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Entity\Individu;
use App\Entity\AnnonceAdoption;
use App\Form\OffreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/offre")
 */
class OffreController extends AbstractController
{
    /**
     * @Route("/", name="app_offre_index", methods={"GET"})
     * 
     */
    public function index(EntityManagerInterface $entityManager): Response
    {

        //get logged in user
        $loggedinUser = $entityManager
        ->getRepository(Individu::class)
        ->findOneBy(array('idindividu' => '2'));

        //get offers 
        $offres = $entityManager
        ->getRepository(Offre::class)
        ->findBy(array('foster'=> '6','status'=>'P'));

        return $this->render('offre/index.html.twig', [
            'offres' => $offres,
        ]);
    }

    /**
     * @Route("/new/{annonce}", name="app_offre_new", methods={"GET", "POST"})
     */
    public function new(AnnonceAdoption $annonce,Request $request, EntityManagerInterface $entityManager): Response
    {
         //get logged in user
         $loggedinUser = $entityManager
         ->getRepository(Individu::class)
         ->findOneBy(array('idindividu' => '2'));

         //get foster
         $foster=$annonce->getIdindividu();

        $offre = new Offre();
        

        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //remplir l'offre
    
            $offre->setFoster($foster);
            $offre->setAdopter($loggedinUser);
            $offre->setCreatedat(new \DateTime('now'));
            $offre->setAnnounce($annonce);
            $offre->setStatus('P');

            $entityManager->persist($offre);
            $entityManager->flush();

            return $this->redirectToRoute('app_annonce_adoption_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('offre/new.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idoffre}", name="app_offre_show", methods={"GET"})
     */
    public function show(Offre $offre): Response
    {
        return $this->render('offre/show.html.twig', [
            'offre' => $offre,
        ]);
    }

    /**
     * @Route("/accepted/{idoffre}", name="app_offre_accept", methods={"GET", "POST"})
     */
    public function accept(int $idoffre,EntityManagerInterface $entityManager,Request $request): Response
    {
        //set status
        $offre = $entityManager
         ->getRepository(Offre::class)
         ->findOneBy(array('idoffre' => $idoffre));

        $offre->setStatus('A');
        $offre->getAnnounce()->setStatus('C');
        //set foster
        $foster=$offre->getAdopter();
        $offre->getAnnounce()->getIdchien()->setIdindividu($foster);

            $entityManager->flush();

        return $this->redirectToRoute('app_offre_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/denied/{idoffre}", name="app_offre_decline", methods={"GET", "POST"})
     */
    public function decline (int $idoffre,EntityManagerInterface $entityManager,Request $request): Response
    {
        
            //set status
            $offre = $entityManager
            ->getRepository(Offre::class)
            ->findOneBy(array('idoffre' => $idoffre));

            $offre->setStatus('D');

                $entityManager->flush();

        return $this->redirectToRoute('app_offre_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{idoffre}/edit", name="app_offre_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Offre $offre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_offre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('offre/edit.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idoffre}", name="app_offre_delete", methods={"POST"})
     */
    public function delete(Request $request, Offre $offre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offre->getIdoffre(), $request->request->get('_token'))) {
            $entityManager->remove($offre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_offre_index', [], Response::HTTP_SEE_OTHER);
    }
}
