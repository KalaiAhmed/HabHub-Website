<?php

namespace App\Form;

use App\Entity\Revue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RevueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbetoiles')
            ->add('commentaire')
            //->add('datepublication')
            //->add('idproduit')
            //->add('idindividu')
            //->add('idbusiness')
            ->add('Save',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Revue::class,
        ]);
    }
}
