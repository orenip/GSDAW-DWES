<?php

namespace App\Form;

use App\Entity\Equipos;
use App\Entity\Partidos;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartidosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('FECHA')
            ->add('COD_EQUIPO1', EntityType::class, [
                'class' => Equipos::class,
                'choice_label' => 'NOMBRE_EQUIPO', //SE MODIFICA PARA QUE MUESTRE EL NOMBRE DEL EQUIPO EN VEZ DE EL ID
            ])
            ->add('PUNTOS_EQUIPO1')
            ->add('COD_EQUIPO2', EntityType::class, [
                'class' => Equipos::class,
            'choice_label' => 'NOMBRE_EQUIPO',
            ])
            ->add('PUNTOS_EQUIPO2')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Partidos::class,
        ]);
    }
}
