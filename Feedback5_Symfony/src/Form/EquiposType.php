<?php

namespace App\Form;

use App\Entity\Equipos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquiposType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombreEquipo')
            ->add('presupuesto')
            ->add('fechaFundacion')
            ->add('titulos')
            ->add('zona')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipos::class,
        ]);
    }
}
