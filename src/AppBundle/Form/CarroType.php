<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CarroType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
     
        $builder->add('cilindrada')
                ->add('dataVenda',DateType::class,array('format' => 'dd-MM-yyyy','years' => range(1980,2018)))
                ->add('observacoes')
                ->add('combustivel')
                ->add('cor', EntityType::class, array('class' => 'AppBundle:Cor',
                                                      'expanded' => true, 
                                                      'multiple'=>false))
                ->add('modelo')
                ->add('imageFile',VichImageType::class,[
                      'required' => false,
                      'allow_delete' => true,
                    ])
                //->add('user',EntityType::class, array('class' => 'AppBundle:User'))                               
                ;
        
           
                
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Carro'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_carro';
    }


}
