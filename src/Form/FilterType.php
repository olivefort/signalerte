<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Service;
use App\Data\FilterData;
use App\Entity\Etiologie;
use App\Entity\Infection;
use App\Entity\Structure;
use App\Entity\Signalement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints as Assert;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('recherche',TextType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'placeholder' => 'rechercher'
            ]
        ])
        ->add('departement', ChoiceType::class, [                
            'choices' => [
                '18 - Cher' => 18,
                '28 - Eure et Loir' => 28,
                '36 - Indre' => 36,
                '37 - Indre et Loire' => 37,
                '41 - Loire et Cher' => 41,                
                '45 - Loiret' => 45,
            ],
            // 'choice_attr' => [
            //     'class' => 'text-white'
            // ],
            'label' => false,
            'expanded' => true,
            'multiple' => true
        ])        
        ->add('infect', EntityType::class,[
            'class' => Infection::class,           
            'label' => false,
        ])
        ->add('epidemie', ChoiceType::class, [
            'label_attr' =>[
                'class' => 'radio-inline',
            ],            
            'choices' => [
                    'Épidémie' => 'Épidémie',
                    'Cas isolé' => 'Cas isolé'                    
            ],  
            'label' => false,
            'expanded' => true,
            'required' => false,
            'multiple' => false      
        ])        
        ->add('dateMin', DateType::class, [
            'widget' => 'single_text',
            'input' => 'datetime_immutable',
            'attr' => [
                'class' => 'form-control',
                'max' => date('Y-m-d')
            ],
            'label' => false,
            'required' => false,
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\LessThan("today")
            ]
        ])
        ->add('dateMax', DateType::class, [
            'widget' => 'single_text',
            'input' => 'datetime_immutable',
            'attr' => [
                'class' => 'form-control',
                'max' => date('Y-m-d')
            ],
            'label' => false,
            'required' => false,
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\LessThan("today")
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FilterData::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
