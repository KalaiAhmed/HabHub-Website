<?php

namespace App\Form;

use App\Entity\Chien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Validator\Constraints\File;

class AdoptionChienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('sexe', TextType::class)
            ->add('age', TextType::class)
            //->add('vaccination',RadioType::class)
            ->add('description', TextareaType::class)
            ->add('image', FileType::class, [
                'label' => false,
                'multiple' => false,
                'mapped'=> false,
                'required' =>false
            ])
            ->add('color')
            ->add('race')
            ->add('groupe')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chien::class,
        ]);
    }
}
