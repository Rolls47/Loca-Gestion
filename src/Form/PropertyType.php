<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Property;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom :'
            ])
            ->add('comment', TextType::class, [
                'label' => 'Commentaire :'
            ])
            ->add('propertyType', EntityType::class, [
                'class' => \App\Entity\PropertyType::class,
                'label' => 'Type de propriété :'
            ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'label' => 'Localisation :'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
}
