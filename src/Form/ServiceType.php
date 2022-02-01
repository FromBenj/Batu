<?php

namespace App\Form;

use App\Entity\Language;
use App\Entity\Service;
use App\Entity\ServiceCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class ServiceType extends AbstractType
{
    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator) {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'required' => true,
                'class' => ServiceCategory::class,
                'choice_label' => 'name',

            ])
            ->add('specialization')
            ->add('description')
            ->add('addressDetails')
            ->add('price', HiddenType::class)
            ->add('priceType', HiddenType::class)
            ->add('housenumber', HiddenType::class)
            ->add('street', HiddenType::class)
            ->add('postcode', HiddenType::class)
            ->add('city', HiddenType::class)
            ->add('country', HiddenType::class)
            ->add('county', HiddenType::class)
            ->add('latitude', HiddenType::class,[
                'required' => true,
            ])
            ->add('longitude', HiddenType::class, [
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}

