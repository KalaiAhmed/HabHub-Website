<?php

namespace App\Form;

use App\Entity\Magasin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MagasinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nommagasin')
            ->add('nomgestionnairemagasin')
            ->add('adresse')
            ->add('codepostal')
            ->add('ville')
            ->add('nomreplegal')
            ->add('cinreplegal')
            ->add('matriculefiscale')
            ->add('identifiantfiscal')
            ->add('patente')
            ->add('rib')
            ->add('idutilisateur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Magasin::class,
        ]);
    }
}
