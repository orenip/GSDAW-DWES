<?php

namespace App\Form;

use App\Entity\Partidos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartidosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha')
            ->add('puntosEquipo1')
            ->add('puntosEquipo2')
            ->add('codEquipo2')
            ->add('codEquipo1')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Partidos::class,
        ]);
    }
}
