<?php

namespace prueba\pruebaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

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
            ->add('tipomovimiento',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('conceptomovimiento',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('idproducto',EntityType::class,array(
                // query choices from this entity
                'class' => 'pruebaBundle:Producto',
                'placeholder'=>'Seleccione',

                // use the User.username property as the visible option string
                'choice_label' => 'nombreproducto',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,,
                'choice_attr' =>  function($val, $key, $index) {
                        // adds a class like attending_yes, attending_no, etc
                        return ['class' => 'form-control'];
                    }))
            ->add('idalmacen',EntityType::class,array(
                // query choices from this entity
                'class' => 'pruebaBundle:Almacen',
                'placeholder'=>'Seleccione',

                // use the User.username property as the visible option string
                'choice_label' => 'nombrealmacen',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,,
                'choice_attr' =>  function($val, $key, $index) {
                        // adds a class like attending_yes, attending_no, etc
                        return ['class' => 'form-control'];
                    }))
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
