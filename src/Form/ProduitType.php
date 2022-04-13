<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('prix')
            ->add('marque')
            ->add('nbetoiles')
            //,
            // array(
               // 'attr' => array('min' => 1, 'max' => 5)
            // )
           // )
            ->add('idCategorie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'empty_data' => function (FormInterface $form) {
                return new Produit($form->get('nom')->getData());
            },
        ]);
    }
}
