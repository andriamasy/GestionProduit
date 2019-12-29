<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\CommandProduit;
use App\Entity\Produit;
use App\Entity\User;
use App\Form\Type\ProduitType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference', TextType::class,[
                'label'  => ' Reference',
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ])

            ->add('code', TextType::class, [
                'label'  => ' Code',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('createdAt', DateTimeType::class, [
                'label'  => ' Date de Commande',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'form-control date_creation'
                ]
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder("u")
                        ->andWhere("u.roles LIKE  '%_CUSTOMER%' ")
                        ->orderBy("u.firstname", "ASC");
                },
                'label'  => ' Client',
                'attr' => ['class' => 'form-control '],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Déscription',
                'attr' => ['class' => 'form-control '],
            ])
            ->add('commandProduits', CollectionType::class, [
                'entry_options' => [
                    'label' => 'Produit',
                ],
                'allow_delete' => true,
                'allow_add' => true,
                'prototype' => true,
                'label' => 'Ajouter Produit et Qte',
                'entry_type' => CommandProduitType::class,
                'attr' => [
                    'class' => 'my-selector',
                ],
            ])
            ->addEventListener(
                FormEvents::PRE_SUBMIT,
                [$this, 'onPreSubmit']
            )
            ->add('Enregistrer', SubmitType::class, [
                'attr' => ['class' => 'form-control btn btn-info'],
            ])
        ;
    }

    public function onPreSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $oDate = new \DateTime($data['createdAt']);
        $data['createdAt'] = $oDate->format('Y-m-d H:m:s');
        //dump($data); die;
        $event->setData($data);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
