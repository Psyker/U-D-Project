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
            ->add('firstname')
            ->add('lastname')
            ->add('phone')
            ->add('email', EmailType::class)
            ->add('subject', TextType::class, [
                'label' => 'Sujet',
            ])
            ->add('message', TextareaType::class, [
                'label' => 'message',
                'attr' => [
                    'placeholder' => 'votre message'
                ]
            ])
            ->add('callAt', DateTimeType::class, array(
                'date_widget' => "single_text",
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
