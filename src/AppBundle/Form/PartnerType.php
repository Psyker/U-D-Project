<?php

namespace AppBundle\Form;

use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class PartnerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du partenaire :',
                'attr' => [
                    'class' => 'form-input'
                ]
            ])
            ->add('logoFile', FileType::class, [
                'label' => 'Logo :',
                'attr' => [
                    'class' => 'form-input'
                ]
            ])
            ->add('url', UrlType::class, [
                'label' => 'Site web du partenaire :',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Exemple: http://www.exemple.fr'
                ]
            ])
            ->add('alt', TextType::class, [
                'label' => 'Texte alternatif :',
                'attr' => [
                    'class' => 'form-input'
                ]
            ])
            ->add('visible', CheckboxType::class, [
                'label' => 'Visible :',
            ])
            ->add('rank', IntegerType::class, [
                'label' => 'Ordre :',
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
            'data_class' => 'AppBundle\Entity\Partner'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_partner';
    }


}
