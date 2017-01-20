<?php

namespace prueba\pruebaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class FideicomisoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fideicomisofactura',TextType::class,array('attr' => array('class' => 'form-control'),'label'  => 'Factura:',))
            ->add('fideicomisomonto',TextType::class,array('attr' => array('class' => 'form-control'),'label'  => 'Monto deducido al fideicomiso:',))
            ->add('fideicomisofecha', DateType::class, array(
                    'widget' => 'single_text',
                    // do not render as type="date", to avoid HTML5 date pickers
                    'html5' => false,
                    // add a class that can be selected in JavaScript
                    'attr' => ['class' => 'js-datepicker'],
                    'label'=>'Fecha del fideicomiso',
                ))
            ->add('idproveedor',HiddenType::class,array('attr' => array('class' => 'form-control')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'prueba\pruebaBundle\Entity\Fideicomiso'
        ));
    }
}
