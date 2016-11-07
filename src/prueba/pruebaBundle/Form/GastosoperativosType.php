<?php

namespace prueba\pruebaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class GastosoperativosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('conceptogasto',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('facturagasto',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('montogasto',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('observacion',TextareaType::class,array('attr' => array('class' => 'form-control')))
            ->add('fechagasto', DateType::class, array(
                    'widget' => 'single_text',                  
                    
                    // do not render as type="date", to avoid HTML5 date pickers
                    'html5' => false,
                   
                    // add a class that can be selected in JavaScript
                    'attr' => ['class' => 'js-datepicker'],
                    
                ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'prueba\pruebaBundle\Entity\Gastosoperativos'
        ));
    }
}
