<?php

namespace prueba\pruebaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class InventarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidad')
            ->add('observacion')
            ->add('productoproducto',EntityType::class,array(
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
            ->add('almacenalmacen',EntityType::class,array(
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
            'data_class' => 'prueba\pruebaBundle\Entity\Inventario'
        ));
    }
}
