<?php

namespace App\Controller;

use App\Entity\Chien;
use App\Form\ChienType;
use App\Form\CommentType;
use App\Entity\Comment;
use App\Entity\AnnonceAdoption;
use App\Entity\Individu;
use App\Entity\Offre;
use App\Form\AnnonceAdoptionType;
use App\Form\BackOfficeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Snappy\Pdf;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Bundle\SnappyBundle\Snappy;
use Knp\Bundle\SnappyBundle\DependencyInjection;
use Symfony\Component\HttpFoundation\JsonResponse;



/**
 * @Route("/annonce/adoption")
 */
class AnnonceAdoptionController extends AbstractController
{
    /**
     * @Route("/", name="app_annonce_adoption_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        //on récupère les filtres
        $filtres=$request->get("individus");

        //on récupère les individus
        $individus = $entityManager
            ->getRepository(Individu::class)
            ->findindiv();

        // on récupère les annonces
        $annonceAdoptions = $entityManager
            ->getRepository(AnnonceAdoption::class)
            ->getAnnonces($filtres);

        // On vérifie si on a une requête Ajax
            if($request->get('ajax')){
                return new JsonResponse([
                    'content' => $this->renderView('annonce_adoption/_contenu.html.twig',
                    ['annonceAdoptions' => $annonceAdoptions,])
                ]);
            }
            


        return $this->render('annonce_adoption/show.html.twig', [
            'annonceAdoptions' => $annonceAdoptions,
            'individus'=>$individus
        ]);
    }
    /**
     * @Route("/back-office", name="app_annonce_adoption_index_back_office", methods={"GET"})
     */
    public function index_BackOffice(EntityManagerInterface $entityManager): Response
    {
        $annonceAdoptions = $entityManager
            ->getRepository(AnnonceAdoption::class)
            ->findAll();

        return $this->render('annonce_adoption/backOfficeShow.html.twig', [
            'annonceAdoptions' => $annonceAdoptions,
        ]);
    }


    /**
     * @Route("/stats", name="app_annonce_adoption_stats", methods={"GET"})
     */
    public function statistiques(Request $request, EntityManagerInterface $entityManager): Response
    {

        $offres = $entityManager
            ->getRepository(Offre::class)
            ->findAll();
           

        $offreStatus = [];
        $offreFoster = [];

       
        foreach($offres as $offre){

            $offreStatus[] = $offre->getStatus();
            $offreFoster[] = $offre->getFoster()->getNom();
            
        }

        
        
        
        $annonces = $entityManager
            ->getRepository(AnnonceAdoption::class)
            ->countByDate();

        $dates = [];
        $annoncesCount = [];

        foreach($annonces as $annonce){
            $dates[] = $annonce['dateAnnonces'];
            $annoncesCount[] = $annonce['count'];
        }

        return $this->render('annonce_adoption/statistique.html.twig', [
            'offreStatus' => json_encode($offreStatus),
            'offreFoster' => json_encode($offreFoster),
            'dates' => json_encode($dates),
            'annoncesCount' => json_encode($annoncesCount),
            
        ]);
    }





    /**
     * @Route("/new", name="app_annonce_adoption_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $annonceAdoption = new AnnonceAdoption();
        $chien = new Chien();
        $annonceAdoption->setIdchien($chien);
        //get loggedinUser
        $loggedinUser = $entityManager
            ->getRepository(Individu::class)
            ->findOneBy(array('idindividu' => '2'));

        $form = $this->createForm(AnnonceAdoptionType::class, $annonceAdoption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //set foster,date and status
           $annonceAdoption->setIdindividu($loggedinUser);
           $annonceAdoption->setStatus('P');
           $annonceAdoption->setDatepublication(new \DateTime('now'));

            //recuperation des images transmises
            $image = $form->get('idchien')->get('image')->getData();
            $fichier = md5(uniqid()) . '.' . $image->guessExtension();
            //On copie le fichier dans le dossier upload
            $image->move(
                $this->getParameter('upload_directory'),
                $fichier
                );
                // on stocke l'image dans la bdd (son nom)
            //recuperation des descriptions
            /*$desc = $form->get('description')->getData();
            //the bad words
            $desc_to_array= explode(" ",$desc);
            foreach($desc_to_array as $word)
                {

                }
            //replacements
            $good_words=array('*******************************************************************************************************************************************************************************************************************************************************************************************************************');
            for($i=0;$i < count($bad_words); $i++){

                $desc=str_replace($bad_words[$i],$good_words,$desc);
            }*/

            $chien->setImage($fichier);
            $entityManager->persist($annonceAdoption);
            $entityManager->persist($chien);
            $entityManager->flush();

            return $this->redirectToRoute('app_annonce_adoption_index', [], Response::HTTP_SEE_OTHER);
            
        }

        return $this->render('annonce_adoption/new.html.twig', [
            'annonce_adoption' => $annonceAdoption,
            'f' => $form->createView(),
        ]);
    }

    

    /**
     * @Route("/new-back-office", name="app_annonce_adoption_new_back_office", methods={"GET", "POST"})
     */
    public function newBackOffice(Request $request, EntityManagerInterface $entityManager): Response
    {
        $annonceAdoption = new AnnonceAdoption();
        $form = $this->createForm(BackOfficeType::class, $annonceAdoption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $annonceAdoption->setDatepublication(new \DateTime('now'));
            $annonceAdoption->setStatus('P');
            $entityManager->persist($annonceAdoption);
            $entityManager->flush();

            return $this->redirectToRoute('app_annonce_adoption_index_back_office', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('annonce_adoption/newBackOffice.html.twig', [
            'annonce_adoption' => $annonceAdoption,
            'f' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idannonceadoption}", name="app_annonce_adoption_show", methods={"GET"})
     */
    public function show(Request $request,AnnonceAdoption $annonceAdoption,EntityManagerInterface $entityManager ): Response
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

            //$this->addFlash('message', 'Votre commentaire a bien été envoyé');
            /*return $this->redirectToRoute('app_annonce_adoption_show',array(
                'annonceAdoption' => $annonceAdoption));*/
        }

        return $this->render('annonce_adoption/moreDetails.html.twig', [
            'annonceAdoption' => $annonceAdoption,
            'form'=>$commentForm->createView(),
        ]);
    }



    

    /**
     * @Route("/pdf/{idannonceadoption}", name="app_annonce_adoption_pdf", methods={"GET"})
     */
    public function pdf(AnnonceAdoption $annonceAdoption): Response
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        //$options->set('isRemoteEnabled', true);
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->setIsRemoteEnabled(TRUE);
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);
        $dompdf->setHttpContext($context);
        //l'image

        $image = $annonceAdoption->getIdchien()->getImage();
        $pic = strval($image);
        //$pic=str_replace("png","jpg",$pic);
        $dogpic=file_get_contents('FrontOffice/uploads/'.$pic);
        $logo=file_get_contents('FrontOffice/uploads/278226457_5296483267131938_3636257523128327412_n.png');
        //$png = file_get_contents('FrontOffice/uploads/'.$pic);
        $logopngbase64 = base64_encode($logo);
        $picpngbase64 = base64_encode($dogpic);



        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('annonce_adoption/download.html.twig', [
            'annonceAdoption' => $annonceAdoption,
            "logo"=>$logopngbase64,
            "dogpic"=>$picpngbase64

        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');
        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }

    /**
     * @Route("/newpdf/{idannonceadoption}", name="app_annonce_adoption_new_pdf", methods={"GET"})
     */
    public function newpdf(AnnonceAdoption $annonceAdoption): Response
    {   
        $snappy = $this->get('knp_snappy.pdf');
        
        $html = $this->renderView('annonce_adoption/pdf.html.twig', [
            'annonceAdoption' => $annonceAdoption,
        ]);
        
        $filename = 'myFirstSnappyPDF';

        return new PdfResponse(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );
    }

    /**
     * @Route("/{idannonceadoption}/edit", name="app_annonce_adoption_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, AnnonceAdoption $annonceAdoption, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AnnonceAdoptionType::class, $annonceAdoption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_annonce_adoption_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('annonce_adoption/edit.html.twig', [
            'annonce_adoption' => $annonceAdoption,
            'f' => $form->createView(),
        ]);
    }

     /**
     * @Route("/{idannonceadoption}/edit-back-office", name="app_annonce_adoption_edit_back_office", methods={"GET", "POST"})
     */
    public function editBackOffice(Request $request, AnnonceAdoption $annonceAdoption, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BackOfficeType::class, $annonceAdoption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_annonce_adoption_index_back_office', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('annonce_adoption/editBackOffice.html.twig', [
            'annonce_adoption' => $annonceAdoption,
            'f' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idannonceadoption}", name="app_annonce_adoption_delete", methods={"POST"})
     */
    public function delete(Request $request, AnnonceAdoption $annonceAdoption, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annonceAdoption->getIdannonceadoption(), $request->request->get('_token'))) {
            $entityManager->remove($annonceAdoption);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_annonce_adoption_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/{idannonceadoption}", name="app_annonce_adoption_delete_back_office", methods={"POST"})
     */
    public function deleteBackOffice(Request $request, AnnonceAdoption $annonceAdoption, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annonceAdoption->getIdannonceadoption(), $request->request->get('_token'))) {
            $entityManager->remove($annonceAdoption);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_annonce_adoption_index_back_office', [], Response::HTTP_SEE_OTHER);
    }

    
}
