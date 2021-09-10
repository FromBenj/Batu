<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'Psychologist' => 'Psychologist',
                    'Doctor' => 'Doctor',
                    'Accomodation' => 'Accomodation',
                    'Food & Drink' => 'Food & Drink',
                ],
            ])
            ->add('languages', ChoiceType::class, [
                'required' => true,
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'English' => 'English',
                    'اللغة العربية' => 'Arabic',
                    'Français' => 'French',
                ],
            ])
            ->add('specialization')
            ->add('description')
            ->add('addressDetails')
            ->add('price')
            ->add('housenumber', HiddenType::class)
            ->add('street', HiddenType::class)
            ->add('postcode', HiddenType::class)
            ->add('city', HiddenType::class)
            ->add('country', HiddenType::class)
            ->add('county', HiddenType::class)
            ->add('latitude', HiddenType::class)
            ->add('longitude', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}

