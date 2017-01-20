<?php

namespace prueba\pruebaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProveedorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('proveedornombre',TextType::class,array('attr' => array('class' => 'form-control'),'label'  => 'Nombre del proveedor:',))
            ->add('proveedorrif',TextType::class,array('attr' => array('class' => 'form-control'),'label'  => 'Rif:',))
            ->add('proveedorcontacto',TextType::class,array('attr' => array('class' => 'form-control'),'label'  => 'Nombre Contacto:',))
            ->add('proveedortlf',TextType::class,array('attr' => array('class' => 'form-control'),'label'  => 'Telefono:',))
            ->add('proveedoremail',TextType::class,array('attr' => array('class' => 'form-control'),'label'  => 'Correo:',))
            ->add('proveedorobservacion',TextareaType::class,array('attr' => array('class' => 'form-control'),'label'  => 'Observacion:',))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'prueba\pruebaBundle\Entity\Proveedor'
        ));
    }
}
