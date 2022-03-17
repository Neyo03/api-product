<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('kcal')
            ->add('kj')
            ->add('fat')
            ->add('saturedFat')
            ->add('carbohydrate')
            ->add('sugar')
            ->add('fiber')
            ->add('protein')
            ->add('salt')
            ->add('ean')
            ->add('ingredient', CollectionType::class,[
                "mapped"=>false,
                'label' => 'LISTE DES INGREDIENTS',
                'entry_type' => IngredientType::class,
                'entry_options' => [
                    "label" => false
                ],
                "allow_add" => true,
                "allow_delete" => true,
                "by_reference" => false 
            ]) 
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
