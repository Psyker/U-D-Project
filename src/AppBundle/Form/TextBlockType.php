<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextBlockType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du bloc de texte :',
                'attr' => [
                    'class' => 'form-input'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Texte',
                'attr' => [
                    'class' => 'form-input'
                ]
            ])
            ->add('position', IntegerType::class, [
                'label' => 'Position',
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

    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_text_content_block';
    }


}
