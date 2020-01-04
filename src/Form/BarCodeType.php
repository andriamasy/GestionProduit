<?php

namespace App\Form;

use App\Entity\BarCode;
use App\Entity\Produit;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BarCodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, [
                'required' => true,
                'label'  => ' Nom Production',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('produit', EntityType::class, [
                'class' => Produit::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder("p")
                        ->andWhere("p.isDelete = 0 ");
                },
                'choice_label' => 'category.name',
                'label' => 'Produit',
                'attr' => ['class' => 'form-control '],
                'placeholder' => '-- Sélectionner un type de produit --',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Generer',
                'attr' => [
                    'class' => 'btn btn-info'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BarCode::class,
        ]);
    }
}
