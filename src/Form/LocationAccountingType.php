<?php

namespace App\Form;

use App\Entity\Label;
use App\Entity\Location;
use App\Entity\LocationAccounting;
use App\Entity\OperationType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationAccountingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value', MoneyType::class, [
                'label' => 'Montant :',
                'divisor' => 100,
            ])
            ->add('date', DateType::class, [
                'label' => 'Date :'
            ])
            ->add('comment', TextType::class, [
                'label' => 'Commentaire :'
            ])
            ->add('operationType', EntityType::class, [
                'class' => OperationType::class,
                'label' => 'Type d\'opération :',
            ])
            ->add('label', EntityType::class, [
                'class' => Label::class,
                'label' => 'Libellé :',
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
            'data_class' => LocationAccounting::class,
        ]);
    }
}
