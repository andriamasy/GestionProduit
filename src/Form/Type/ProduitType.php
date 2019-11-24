<?php


namespace App\Form\Type;

use App\Entity\Category;
use App\Entity\Produit;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * ProduitType constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'attr' => ['class' => 'form-control '],
                'required' => true,
                'label'  => ' Nom Produit',
            ])
            ->add('reference', TextType::class, [
                'attr' => ['class' => 'form-control '],
                'required' => true,
                'label'  => ' Reference',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->andWhere('c.isActivated = 1')
                        ->orderBy('c.name', 'ASC');
                },
                'choice_label' => 'name',
                'label'  => ' Categorie',
                'attr' => ['class' => 'form-control '],
            ])
            ->add('created_at', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'form-control date_creation',
                ],
                'label' => ' Date de création',
            ])
            ->add('poidDufruitAcheter', NumberType::class, [
                'attr' => [
                    'class' => 'form-control only-numeric',
                    'step' => 0.1
                ],
                'label' => ' Poid du Fruit Achetés [Kg]',
            ])
            ->add('poidDufruitepluches', NumberType::class,[
                'attr' => [
                    'class' => 'form-control only-numeric',
                    'step' => 0.1
                ],
                'label' => ' Poid du Fruit Epluchés [Kg]',
            ])
            ->add('PassageRaffiner', NumberType::class, [
                'attr' => [
                    'class' => 'form-control only-numeric',
                    'step' => 0.1
                ],
                'label' => ' Passage Raffineuse',
            ])
            ->add('nombreTamissage',NumberType::class,[
                'attr' => [
                    'class' => 'form-control only-numeric',
                    'step' => 0.1
                ],
                'label' => ' Nombre de Tamissage',
            ])
            ->add('poidDuFruitTamisse', NumberType::class, [
                'attr' => [
                    'class' => 'form-control only-numeric',
                    'step' => 0.1
                ],
                'label' => ' Poid des Fruits Tamisèe [kg]',
            ])
            ->add('passageEmissionneuse', NumberType::class, [
                'attr' => [
                    'class' => 'form-control only-numeric',
                    'step' => 0.1
                ],
                'label' => ' Passage Emuisionneuse',
            ])
            ->add('QteEau', NumberType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control only-numeric',
                    'step' => 0.1
                ],
                'label' => ' Quantité d\'Eau Ajouter [litre]',
            ])
            ->add('poidFinal', NumberType::class, [
                'attr' => [
                    'class' => 'form-control only-numeric',
                    'step' => 0.1
                ],
                'label' => ' Poids Final [kg] ',
            ])
            ->add('MesurrPHAvant', NumberType::class, [
                'attr' => [
                    'class' => 'form-control only-numeric',
                    'step' => 0.1
                ],
                'label' => ' Mesure du PH Avant Traitement',
            ])
            ->add('qteAcide', NumberType::class, [
                'attr' => [
                    'class' => 'form-control only-numeric',
                    'step' => 0.1
                ],
                'required' => false,
                'label' => ' Quantité d\'Acide Citrique Rajouter',
            ])
            ->add('mesurePHApres', NumberType::class, [
                'attr' => [
                    'class' => 'form-control only-numeric',
                    'step' => 0.1
                ],
                'label' => ' Nouvelle Mesure du PH Après T.',
            ])
            ->add('mesureBrix', NumberType::class, [
                'attr' => [
                    'class' => 'form-control only-numeric',
                    'step' => 0.1
                ],
                'label' => ' Mesure du Brix',
            ])
            ->add('qteSucre', NumberType::class, [
                'attr' => [
                    'class' => 'form-control only-numeric',
                    'step' => 0.1
                ],
                'label' => ' Quantité de Sucre Ajouté [kg]',
            ])
            ->add('mesureBrixFinal', NumberType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control only-numeric',
                    'step' => 0.1,
                ],
                'label' => ' Mesure du Brix Final',
            ])
            ->add('nbrBoiteProduite', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],

                'label' => ' Nombre de Boites Produits',
            ])
            ->add('Enregistrer', SubmitType::class, [
                'attr' => ['class' => 'btn float-right btn-info btn-sm'],
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => ' Descriptions',
            ])

            ;
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
