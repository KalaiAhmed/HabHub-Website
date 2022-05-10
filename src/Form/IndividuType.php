<?php

namespace App\Form;

use App\Entity\Individu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IndividuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('datenaissance')
            ->add('sexe')
            ->add('adresse')
            ->add('facebook')
            ->add('instagram')
            ->add('whatsapp')
            ->add('proprietairechien')
            ->add('idutilisateur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Individu::class,
        ]);
    }
}
