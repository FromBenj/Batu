<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', ChoiceType::class, [
                'required'   => true,
                'choices'  => [
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
                'choices'  => [
                    'English' => 'English',
                    'اللغة العربية' => 'Arabic',
                    'Français' => 'French',
                ],
            ])
            ->add('specialization')
            ->add('description')
            ->add('address')
            ->add('addressDetails')
            ->add('price')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
