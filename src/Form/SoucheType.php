<?php

namespace App\Form;

use App\Entity\Souche;
use App\Entity\Signalement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints as Assert;

class SoucheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('laboratoire', ChoiceType::class, [
                
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => [
                    'CRENO' => 'CRENO',
                    'CNRS' => 'CNRS'                    
                ],
                'label' => 'Labo',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'empty_data' =>''
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'attr' => [
                    'class' => 'form-control',
                    'max' => date('Y-m-d')
                ],
                'label' => "Date de l'envoi",
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'empty_data' =>'',
                'constraints' => [
                    new Assert\LessThan("today")
                ]
            ])
            ->add('numero', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Numéro de la souche',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\NotNull()
                ],
                'empty_data' =>''
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Souche::class,
        ]);
    }
}
