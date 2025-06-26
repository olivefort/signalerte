<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Signalement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => [
                    'mail' => 'mail',
                    'téléphone' => 'tel',                  
                    'visioconférence' => 'visio',                    
                    'présentiel' => 'presenciel'                    
                ],
                'label' => 'Type',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'empty_data' =>''
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => "Date de contact",
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'empty_data' =>''
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
