<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Utilisateur;
use App\Entity\Individu;
use App\Form\MessageType;
use App\Form\ContactMessageType;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
     * @Route("/message")
     */
class MessageController extends AbstractController
{
    /**
     * @Route("/", name="message", methods={"GET"})
     */
    public function index(): Response
    {

        return $this->render('message/index.html.twig', [
            
        ]);
    }

    /**
     * @Route("/send", name="send")
     */
    public function send(EntityManagerInterface $entityManager,Request $request): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $loggedinUser = $entityManager
            ->getRepository(Utilisateur::class)
            ->findOneBy(array('idutilisateur' => '2'));

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $message->setSender($loggedinUser);
            $message->setIsRead(FALSE);
            $message->setCreatedat(new \DateTime('now'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
            return $this->redirectToRoute("message");
        }

        return $this->render("message/send.html.twig", [
            "form" => $form->createView()
        ]);
    }


    /**
     * @Route("/send/{id}", name="contact")
     */
    public function contact(EntityManagerInterface $entityManager,Request $request ,int $id): Response
    {
        $message = new Message();
        
        

        $individu = $entityManager
        ->getRepository(Individu::class)
        -> findOneBy(array('idindividu' =>$id ));

        //utilisateur recipient
        $utilisateur=$individu->getIdutilisateur();
        
        $form = $this->createForm(ContactMessageType::class, $message);
        
        //utlisateur sender
        $loggedinUser = $entityManager
            ->getRepository(Utilisateur::class)
            ->findOneBy(array('idutilisateur' => '2'));

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $message->setSender($loggedinUser);
            $message->setRecipient($utilisateur);
            $message->setIsRead(FALSE);
            $message->setCreatedat(new \DateTime('now'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            
            return $this->redirectToRoute("message");
        }

        return $this->render("message/contact.html.twig", [
            "form" => $form->createView()
        ]);
    }
    /**
     * @Route("/received/{id}", name="received")
     */
    public function received(EntityManagerInterface $entityManager,int $id): Response
    {
   
        $receivedMessages = $entityManager
        ->getRepository(Message::class)
        ->receivedMessages(array('recipient'=>'2'));
        $nbrec=count($receivedMessages);

        return $this->render('message/received.html.twig', [
           "nbrec" => $nbrec,
            "receivedMessages" => $receivedMessages

        ]);
    }


    /**
     * @Route("/sent/{id}", name="sent")
     */
    public function sent(EntityManagerInterface $entityManager,int $id ): Response
    {
       
        $myMessages = $entityManager
        ->getRepository(Message::class)
        ->sentMessages(array('sender'=>'2'));
        $nbsent=count($myMessages);
        
        
        /*$nbSentMessages = $entityManager
        ->getRepository(Message::class)
        ->countSentMessages($id);*/

        return $this->render('message/sent.html.twig', [
            "myMessages" => $myMessages,
            "nbsent"=> $nbsent
        ]);
    }

    /**
     * @Route("/read/{id}", name="read")
     */
    public function read(Message $message): Response
    {
        $message->setIsRead(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($message);
        $em->flush();

        return $this->render('message/read.html.twig', [
            "message" => $message
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Message $message): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($message);
        $em->flush();
        $id=2;
        return $this->redirectToRoute('message', [], Response::HTTP_SEE_OTHER);
    }
}