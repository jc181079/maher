<?php

namespace prueba\pruebaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class SolicitudType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('fechadolicitud', DateType::class, array(
                    'widget' => 'single_text',                  
                    
                    // do not render as type="date", to avoid HTML5 date pickers
                    'html5' => false,
                   
                    // add a class that can be selected in JavaScript
                    'attr' => ['class' => 'js-datepicker'],
                    
                ))               
            ->add('fechaentrega', DateType::class, array(
                    'widget' => 'single_text',
                    // do not render as type="date", to avoid HTML5 date pickers
                    'html5' => false,
                    // add a class that can be selected in JavaScript
                    'attr' => ['class' => 'js-datepicker'],
                ))               
                ->add('numerosolicitud', TextType::class, array(
                    'attr' => array('class' => 'form-control'),
                    'data'=> date('his')  //aqui se esta colocando el numero de la solicitud                    
                ))
                ->add('tipopago', ChoiceType::class, array(
                    'choices' => array(
                        'Seleccione' => null,
                        'Efectivo' => 'Efectivo',
                        'Cheque' => 'Cheque',
                        'Transferencia' => 'Transferencia',
                        'Credito' => 'Credito',
                    ),
                    'attr'=> ['class' =>'form-control'], //manera correcta de colocar la clase de bottstrap
                ))                
                ->add('rif',HiddenType::class,array('attr' => array('class' => 'form-control')))
                            

        ;
        /*
         * los datos de fechasolicitud,estatus, idseguridad, idclientes se vana a guardar a traves de script en el controller
         * lor tal motivo se eliminarion los objetos en este formulario
         */
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'prueba\pruebaBundle\Entity\Solicitud'
        ));
    }
}
