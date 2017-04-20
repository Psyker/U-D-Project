<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuotesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom :',
                'attr' => [
                    'class' => 'form-input'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => "Nom :",
                'attr' => [
                    'class' => 'form-input'
                ]
            ])
            ->add('function', TextType::class, [
                'label' => 'Poste :',
                'attr' => [
                    'class' => 'form-input'
                ]
            ])
            ->add('company', TextType::class, [
                'label' => 'Entreprise :',
                'attr' => [
                    'class' => 'form-input'
                ]
            ])
            ->add('text', TextareaType::class, [
                'label' => 'Citation :',
                'attr' => [
                    'class' => 'form-input'
                ]
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Quotes'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_quotes';
    }


}
