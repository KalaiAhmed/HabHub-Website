<?php

namespace App\Form;

use App\Entity\AnnonceAdoption;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnonceAdoptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datepublication')
            ->add('description')
            ->add('localisation')
            ->add('idindividu')
            ->add('idchien')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AnnonceAdoption::class,
        ]);
    }
}
