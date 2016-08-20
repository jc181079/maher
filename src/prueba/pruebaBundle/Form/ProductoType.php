<?php

namespace prueba\pruebaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use prueba\pruebaBundle\Entity\Und;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreproducto',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('marca',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('referencia',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('familia',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('stockmaximo',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('stockminimo',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('preciocosto',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('precioventa',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('idund',EntityType::class,array(
                // query choices from this entity
                'class' => 'pruebaBundle:Und',
                'placeholder'=>'Seleccione',

                // use the User.username property as the visible option string
                'choice_label' => 'nombreund',

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
            'data_class' => 'prueba\pruebaBundle\Entity\Producto'
        ));
    }
}
