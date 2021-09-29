<?php

namespace App\Form;

use App\Entity\Service;
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
        $service = new Service();
        $categories = $service::CATEGORIES;
        $categoriesList = [];
        foreach ($categories as $key => $value) {
            $valueToTranslate = str_replace(' ', '-', strtolower($value));
            $valueToTranslate = $this->translator->trans('app.professional.service.category.' . $valueToTranslate);
            $categoriesList[$valueToTranslate] = $value ;
        }
        $languages = $service::LANGUAGES;
        $languagesList = [];
        foreach ($languages as $key => $value) {
            $valueToTranslate = strtolower($value);
            $valueToTranslate = $this->translator->trans('app.professional.service.language.' . $valueToTranslate);
            $languagesList[$valueToTranslate] = $value ;
        }

        $builder
            ->add('category', ChoiceType::class, [
                'required' => true,
                'choices' => $categoriesList,
            ])
            ->add('languages', ChoiceType::class, [
                'required' => true,
                'multiple' => true,
                'expanded' => true,
                'choices' => $languagesList,
            ])
            ->add('specialization')
            ->add('description')
            ->add('addressDetails')
            ->add('price', HiddenType::class)
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

