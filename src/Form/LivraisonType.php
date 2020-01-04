<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\LivraisonClient;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivraisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('dateLivraison', DateTimeType::class,[
                //'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => ' Date de Livraison',

            ])

            ->add('transporteur',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('reference',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
           ->add('commande', EntityType::class, [
               'label' => 'Bon de Commande',
               'class' => Commande::class,
               'choice_label' => function($value){
                    return $value->getReference().': '. $value->getUser()->getLastname().' '.$value->getUser()->getFirstname();
               },
               'query_builder' => function (EntityRepository $er) {
                   return $er->createQueryBuilder("c");
               },
               'attr' => [
                   'class' => 'form-control'
               ]
           ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-info form-control '
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LivraisonClient::class,
        ]);
    }
}
