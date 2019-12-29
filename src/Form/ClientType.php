<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClientType extends AbstractType
{
    private $passwordEncoder;
    private $user;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->user = $options['data'];
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Nom client',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Prenom client',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('email', TextType::class, [
                'label' => 'Email client',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse client',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('password', HiddenType::class, [
                'data' => '123456',
            ])
            ->add('Enregistrer', SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-info btn-sm float-right',
                ],
            ])
            ->addEventListener(FormEvents::PRE_SUBMIT,[$this, 'onPreSubmitData'])
        ;
    }

    public function onPreSubmitData(FormEvent $event)
    {
        $aData = $event->getData();

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
