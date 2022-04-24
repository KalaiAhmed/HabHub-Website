<?php

namespace App\Form;

use App\Entity\AnnonceAdoption;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\ChienType;

class AnnonceAdoptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
        ->add('description', TextareaType::class, [
            "attr" => [
                "class" => "form-control"
            ]
        ])
        ->add('localisation', TextType::class, [
            "attr" => [
                "class" => "form-control"
            ]
        ])
            ->add('idchien',ChienType::class)
            ->add('add',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AnnonceAdoption::class,
        ]);
    }
}
