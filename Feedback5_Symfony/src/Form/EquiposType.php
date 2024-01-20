<?php

namespace App\Form;

use App\Entity\Equipos;
use App\Entity\Zonas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquiposType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //SE PUEDEN AÑADIR CAMPOS O MODIFICAR Y CAMBIAR EN VISTA POR EJEMPLO: EQUIPO.ZONA.GETNOMBREZONA
        $builder
            ->add('NOMBRE_EQUIPO')
            ->add('PRESUPUESTO')
            ->add('FECHA_FUNDACION')
            ->add('TITULOS')
            ->add('ZONA', EntityType::class, [
                'class' => Zonas::class,
                'choice_label' => 'NOMBRE_ZONA', //Para que no coja ID se cambia aqui y apareceria el nombre.
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipos::class,
        ]);
    }
}
