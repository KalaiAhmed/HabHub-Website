<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datereservation',DateType::class)
            ->add('heurereservation' ,ChoiceType::class, [
        'choices'  => [
            '9AM-10AM'=>'9AM-10AM',
            '10AM-11AM'=>'10AM-11AM',
            '11AM-12PM'=>'11AM-12PM',
            '12PM-13PM'=>'12PM-13PM',
            '15PM-16PM'=> '15PM-16PM',
            '16PM-17PM'=>'16PM-17PM',
            '17PM-18PM'=> '17PM-18PM',
        ],
    ])
            ->add('Book',SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
