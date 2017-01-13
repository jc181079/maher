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
            ->add('nombreproducto',TextType::class,array('attr' => array('class' => 'form-control'),'label'  => 'Nombre del producto:',))
            ->add('marca',TextType::class,array('attr' => array('class' => 'form-control'),'label'  => 'Marca:',))
            ->add('referencia',TextType::class,array('attr' => array('class' => 'form-control'),'label'  => 'Referencia:',))
            ->add('familia',TextType::class,array('attr' => array('class' => 'form-control'),'label'  => 'Femilia:',))
            ->add('stockmaximo',TextType::class,array('attr' => array('class' => 'form-control'),'label'  => 'Cantidad minima en almacen:',))
            ->add('stockminimo',TextType::class,array('attr' => array('class' => 'form-control'),'label'  => 'Cantidad maxima en almacen:',))
            ->add('preciocosto',TextType::class,array('attr' => array('class' => 'form-control'),'label'  => 'Precio de costo:',))
            ->add('precioventa',TextType::class,array('attr' => array('class' => 'form-control'),'label'  => 'Precio de venta:',))
            ->add('idund',EntityType::class,array(
                // query choices from this entity
                'class' => 'pruebaBundle:Und',
                'placeholder'=>'Seleccione',

                // use the User.username property as the visible option string
                'choice_label' => 'nombreund',
                'attr'=> ['class' =>'form-control', 'data-live-search'=>'true'], //manera correcta de colocar la clase de bottstrap
                'label'  => 'Unidad de medida:',
                ))
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
