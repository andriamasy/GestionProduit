<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
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
            ->add('quantite', IntegerType::class, [
                'label'  => ' Quantité Produit',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('code', IntegerType::class, [
                'label'  => ' Code',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('created_at', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'label' => ' Date de commande',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.firstname', 'ASC');
                },
                'choice_label' => 'firstname',
                'label'  => ' Client',
                'attr' => ['class' => 'form-control '],
            ])
            //->add('user')
           // ->add('produit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
