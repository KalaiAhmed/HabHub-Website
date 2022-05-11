<?php

namespace App\Form;

use App\Entity\Message;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('message', TextareaType::class, [
                "attr" => [
                    "class" => "form-control",
                    "placeholder"=>"enter your message"
                ]
            ])
            ->add('recipient', EntityType::class, [
                "class" => Utilisateur::class,
                "choice_label" => "email",
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('envoyer', SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-primary"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}