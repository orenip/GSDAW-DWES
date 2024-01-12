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
            ->add('NOMBRE_EQUIPO')
            ->add('PRESUPUESTO')
            ->add('FECHA_FUNDACION')
            ->add('TITULOS')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipos::class,
        ]);
    }
}
