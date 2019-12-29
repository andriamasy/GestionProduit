<?php

namespace App\Form;

use App\Entity\CommandProduit;
use App\Entity\Produit;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('produit', EntityType::class, [
                'class' => Produit::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder("p")
                        ->andWhere("p.isDelete = 0 ");
                },
                'choice_label' => 'category.name',
                'label' => false,
                'attr' => ['class' => 'form-control '],
                'placeholder' => '-- Sélectionner un type de produit --',
            ])
            ->add('qte', IntegerType::class, [
                'label' => 'Quantité',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommandProduit::class,
        ]);
    }
}
