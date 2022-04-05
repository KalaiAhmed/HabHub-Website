<?php

namespace App\Form;

use App\Entity\AnnonceProprietaireChien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnonceProprietaireChienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datepublication')
            ->add('description')
            ->add('type')
            ->add('dateperte')
            ->add('localisation')
            ->add('messagevocal')
            ->add('idchien')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AnnonceProprietaireChien::class,
        ]);
    }
}
