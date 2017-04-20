<?php

namespace AppBundle\Form;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ContactType extends AbstractType
{

    private $mailer;
    private $twig;
    private $session;

    /**
     * ContactType constructor.
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, Session $session)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->session = $session;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', null, [
                'label' => 'Prénom',
                'label_attr' => [
                    'class' => 'form__label'
                ],
                'attr' => [
                    'class' => 'form__input'
                ]
            ])
            ->add('lastname', null, [
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form__label'
                ],
                'attr' => [
                    'class' => 'form__input'
                ]
            ])
            ->add('phone', null, [
                'label' => 'Téléphone',
                'label_attr' => [
                    'class' => 'form__label'
                ],
                'attr' => [
                    'class' => 'form__input'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'label_attr' => [
                    'class' => 'form__label'
                ],
                'attr' => [
                    'class' => 'form__input'
                ]
            ])
            ->add('subject', TextType::class, [
                'label' => 'Sujet',
                'label_attr' => [
                    'class' => 'form__label'
                ],
                'attr' => [
                    'class' => 'form__input'
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
                'label_attr' => [
                    'class' => 'form__label optional'
                ],
                'attr' => [
                    'placeholder' => 'votre message',
                    'class' => 'form__textarea'
                ]
            ])
            ->add('callAt', DateTimeType::class, array(
                'date_widget' => "single_text",
                'label' => 'Date de disponibilité',
                'label_attr' => [
                    'class' => 'form__label'
                ],
                'attr' => [
                    'class' => 'container__form__input'
                ],
                'html5' => true,
                'format' => DateTimeType::HTML5_FORMAT
            ));

        $builder->addEventListener(FormEvents::SUBMIT, function(FormEvent $event) {
            $message = \Swift_Message::newInstance()
                ->setSubject("[U&D] Vous avez un nouveau message.")
                ->setFrom("bourgoi.theo@gmail.com")
                ->setTo("bourgoi.theo@gmail.com")
                ->setBody($this->twig->render('admin/mail/message.html.twig'), 'text/html');
            $this->mailer->send($message);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Contact'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_contact';
    }


}
