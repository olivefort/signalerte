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
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('q',TextType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'placeholder' => 'Rechercher'
            ]
        ])
        ->add('type', ChoiceType::class, [
            'label_attr' =>[
                'class' => 'radio-inline',
            ],            
            'choices' => [
                    'Portail' => 'Portail',
                    'ESIN' => 'ESIN',
                    'Aucun' => 'Aucun',
            ],
            'placeholder' => false,
            'label' => false,
            'expanded' => true,
            'required' => false,
            'multiple' => false      
        ])  
        ->add('departement', ChoiceType::class, [
            'attr' => [
                'class' => 'divided'
            ],            
            'choices' => [
                '18 - Cher' => '18-CHER',
                '28 - Eure et Loir' => '28-EURE ET LOIR',
                '36 - Indre' => '36-INDRE',
                '37 - Indre et Loire' => '37-INDRE ET LOIRE',
                '41 - Loire et Cher' => '41-LOIR ET CHER',                
                '45 - Loiret' => '45-LOIRET',
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
            'required' => false
        ])
        ->add('serv', EntityType::class,[
            'class' => Service::class,           
            'label' => false,            
            'required' => false
        ])
        ->add('epidemie', ChoiceType::class, [
            'label_attr' =>[
                'class' => 'radio-inline',
            ],            
            'choices' => [
                    'Épidémie' => 'Épidémie',
                    'Cas isolé' => 'Cas isolé'
            ],
            'placeholder' => false,
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
        ->add('scoreMin', NumberType::class, [                
            'label' => false,
            'required' =>false,
            'attr' => ['placeholder' => 'Score Min']
        ])
        ->add('scoreMax', NumberType::class, [                
            'label' => false,            
            'required' =>false,
            'attr' => ['placeholder' => 'Score Max']
        ])
        ->add('ARS', ChoiceType::class, [
            'attr' => [
                'class' => 'selected'
            ],
            'choices' => [
                'Aucun' => 'aucune',
                'Vert' => 'vert',
                'Bleu' => 'bleu',
                'Rouge' => 'rouge',
            ],
            'label' => 'ARS',
            'required' => false,      
        ])
        ->add('ES', ChoiceType::class, [
            'attr' => [
                'class' => 'selected'
            ],
            'choices' => [
                'Aucun' => 'aucune',
                'Vert' => 'vert',
                'Bleu' => 'bleu',
                'Rouge' => 'rouge',
            ],
            'label' => 'ES',
            'required' => false,     
        ])
        ->add('CPIAS', ChoiceType::class, [
            'attr' => [
                'class' => 'selected'
            ],
            'choices' => [
                'Aucun' => 'aucune',
                'Vert' => 'vert',
                'Bleu' => 'bleu',
                'Rouge' => 'rouge',
            ],
            'label' => 'CPIAS',
            'required' => false,        
        ])
        ->add('SPF', ChoiceType::class, [
            'attr' => [
                'class' => 'selected'
            ],
            'choices' => [
                'Aucun' => 'aucune',
                'Vert' => 'vert',
                'Bleu' => 'bleu',
                'Rouge' => 'rouge',
            ],
            'label' => 'SPF',
            'required' => false,    
        ])
        ->add('souche', ChoiceType::class, [
            'attr' => [
                'class' => 'fdr'
            ],
            'label_attr' =>[
                'class' => 'radio-inline',
            ],            
            'choices' => [
                    'CRENO' => 'CRENO',
                    'CNRS' => 'CNRS'
            ],
            'placeholder' => false,
            'label' => false,
            'expanded' => true,
            'required' => false,
            'multiple' => true     
        ])  
        ->add('contact', ChoiceType::class, [
            'attr' => [
                'class' => 'divided'
            ],
            'label_attr' =>[
                'class' => 'radio-inline',
            ],            
            'choices' => [
                'Téléphone' => 'tel',
                'Mail' => 'mail',
                'Visioconférence' => 'visio',
                'Présentiel' => 'presenciel',
            ],         
            'placeholder' => false,
            'label' => false,
            'expanded' => true,
            'required' => false,
            'multiple' => true
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
