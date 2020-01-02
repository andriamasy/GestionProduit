<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'required' => true,
                'label'  => ' Nom Production',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('isActivated', CheckboxType::class,[
                'required' => false,
                'label'  => false,
                'attr' => [
                    'class' => 'form-control',
                   "name"=>"my-checkbox",
                   "data-bootstrap-switch" => "",
                    "data-on-text"=>"Actif",
                    "data-off-text"=>"Désactiver",
                   "data-off-color"=>"danger",
                   "data-on-color"=>"success"
                ],
            ])
            ->add('prix', NumberType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('taxe', NumberType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false
            ])
            ->add('submit', SubmitType::class,[
                'attr' => [
                    'class' => 'form-control btn btn-info',
                ],
                'label' => 'Enregistrer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
