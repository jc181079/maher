<?php

namespace prueba\pruebaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use prueba\pruebaBundle\Entity\Ruta;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class SeguridadclienteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreusuario',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('login',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('pass',PasswordType::class,array('attr' => array('class' => 'form-control')))            
            ->add('rif',TextType::class,array('attr' => array('class' => 'form-control')))            
            ->add('telefono',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('direccion')
            ->add('contacto',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('idruta',EntityType::class,array(
                // query choices from this entity
                'class' => 'pruebaBundle:Ruta',
                'placeholder'=>'Seleccione',

                // use the User.username property as the visible option string
                'choice_label' => 'nombreruta',

                // used to render a select box, check boxes or radios
                'multiple' => true,
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
            'data_class' => 'prueba\pruebaBundle\Entity\Seguridad'
        ));
    }
}
