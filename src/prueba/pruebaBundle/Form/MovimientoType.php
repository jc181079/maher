<?php

namespace prueba\pruebaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MovimientoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidad',TextType::class,array('attr' => array('class' => 'form-control')
                ))
            ->add('fechamovimiento', DateType::class, array(
                'widget' => 'single_text',

                // do not render as type="date", to avoid HTML5 date pickers
                'html5' => false,

                // add a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
            ))
            ->add('tipomovimiento', ChoiceType::class, array(
                    'choices' => array(
                        'Seleccione' => null,
                        'Entrada' => 'Entrada',
                        'Salida' => 'Salida',                        
                    ),
                    'attr'=> ['class' =>'form-control'], //manera correcta de colocar la clase de bottstrap
                    ))
            ->add('conceptomovimiento',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('idproducto',EntityType::class,array(
                // query choices from this entity
                'class' => 'pruebaBundle:Producto',
                'placeholder'=>'Seleccione',

                // use the User.username property as the visible option string
                'choice_label' => 'nombreproducto',
                'attr'=> ['class' =>'form-control', 'data-live-search'=>'true'], //manera correcta de colocar la clase de bottstrap
               ))
            ->add('idalmacen',EntityType::class,array(
                // query choices from this entity
                'class' => 'pruebaBundle:Almacen',
                'placeholder'=>'Seleccione',

                // use the User.username property as the visible option string
                'choice_label' => 'nombrealmacen',

                'attr'=> ['class' =>'form-control', 'data-live-search'=>'true'], //manera correcta de colocar la clase de bottstrap
                ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'prueba\pruebaBundle\Entity\Movimiento'
        ));
    }
}
