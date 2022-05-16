<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email' , TextType::class,  array('label' =>false,'attr' => ['placeholder' => 'email ']))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' =>false,'attr' => ['placeholder' => 'Password ']),
                'second_options' => array('label' => false,'attr' => ['placeholder' => 'Repeat Password ']),
                'options' => array('attr' => array('class' => 'form-control'))
            ))
            ->add('numtel', TextType::class,  array('label' =>false,'attr' => ['placeholder' => 'Phone Number ']))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
