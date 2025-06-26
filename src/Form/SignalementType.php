<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Numero;
use App\Entity\Souche;
use App\Entity\Service;
use App\Entity\Cotation;
use App\Form\SoucheType;
use App\Entity\Etiologie;
use App\Entity\Infection;
use App\Entity\Organisme;
use App\Entity\Structure;
use App\Form\ContactType;
use App\Entity\Resistance;
use App\Entity\Signalement;
use App\Repository\AgentRepository;
use App\Repository\NumeroRepository;
use App\Repository\SoucheRepository;
use App\Repository\ServiceRepository;
use App\Repository\EtiologieRepository;
use App\Repository\InfectionRepository;
use App\Repository\OrganismeRepository;
use App\Repository\StructureRepository;
use App\Repository\ResistanceRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class SignalementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => [
                    'ESIN' => 'ESIN',
                    'Portail' => 'Portail',
                    'Aucun' => 'Aucun'                   
                ],
                'label' => 'Type',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('numero', TelType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => '6',
                    'minlength' => '5'
                ],
                'label' => 'Numéro du signalement',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\NotNull()
                ]
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'attr' => [
                    'class' => 'form-control',
                    'max' => date('Y-m-d')
                ],
                'label' => 'Date du signalement',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\LessThan("today")
                ]
            ])
            ->add('structure', EntityType::class,[
                'class' => Structure::class,
                'autocomplete' => true,
                'query_builder' => function (StructureRepository $r) {
                    return $r->createQueryBuilder('i')
                    ->orderBy('i.nom', 'ASC');
                },
                'attr' => [
                    'class' => 'form-select'
                ],
                'label' => "Nom de la structure",
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'choice_label' => 'nom',
                // 'multiple' => true,
            ])
            // ->add('structure', EntityType::class,[
            //     'class' => Structure::class,
            //     'autocomplete' => true,
            //     'query_builder' => function (StructureRepository $r) {
            //         return $r->createQueryBuilder('i')
            //         ->orderBy('i.finessG', 'ASC');
            //     },
            //     'attr' => [
            //         'class' => 'form-select'
            //     ],
            //     'label' => "Finess de la structure",
            //     'label_attr' => [
            //         'class' => 'form-label mt-4'
            //     ],
            //     'choice_label' => 'finessG',
            //     'multiple' => true,
            // ])
            // ->add('agent', EntityType::class,[
            //     'class' => Agent::class,
            //     // 'autocomplete' => true,
            //     'query_builder' => function (AgentRepository $r) {
            //         return $r->createQueryBuilder('i')
            //         ->orderBy('i.id', 'ASC');
            //     },
            //     'attr' => [
            //         'class' => 'form-select'
            //     ],
            //     'label' => "Nom de l'agent infectieux",
            //     'label_attr' => [
            //         'class' => 'form-label mt-4'
            //     ],
            //     'choice_label' => 'organisme',
            //     'multiple' => true,
            // ])
            // ->add('organisme', EntityType::class,[
            //     'class' => Organisme::class,
            //     'query_builder' => function (OrganismeRepository $r) {
            //         return $r->createQueryBuilder('i')
            //         ->orderBy('i.type', 'ASC');
            //     },
            //     'attr' => [
            //         'class' => 'test'
            //     ],
            //     'label' => "Organisme",
            //     'label_attr' => [
            //         'class' => 'form-label mt-4'
            //     ],                                
            //     'choice_label' => 'type',
            //     'multiple' => true,
            //     // 'expanded' => true,                
            // ])
            // ->add('resistance', EntityType::class,[
            //     'class' => Resistance::class,
            //     'query_builder' => function (ResistanceRepository $r) {
            //         return $r->createQueryBuilder('i')
            //         ->orderBy('i.type', 'ASC');
            //     },
            //     'attr' => [
            //         'class' => 'test3'
            //     ],
            //     'label' => "Resistance",
            //     'label_attr' => [
            //         'class' => 'form-label mt-4'
            //     ],                                
            //     'choice_label' => 'type',
            //     'multiple' => true,
            //     // 'expanded' => true,                
            // ])
            ->add('agent', CollectionType::class,[
                'entry_type' => AgentType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                // 'required' => false,
                'label' => false,
                'entry_options' => ['label' => false ],
                'attr' => ['data-controller' => 'form-agent', 'class' => 'agents'],
            ])
            ->add('infection', EntityType::class,[
                'class' => Infection::class,
                'query_builder' => function (InfectionRepository $r) {
                    return $r->createQueryBuilder('i')
                    ->orderBy('i.infection', 'ASC');
                },
                'attr' => [
                    'class' => 'form-select'
                ],
                'label' => "Type d'infection",
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],                
                'choice_label' => 'infection',
                // 'multiple' => true,
            ])            
            ->add('etiologie', EntityType::class,[
                'class' => Etiologie::class,
                'query_builder' => function (EtiologieRepository $r) {
                    return $r->createQueryBuilder('i')
                    ->orderBy('i.agent', 'ASC');
                },
                'attr' => [
                    'class' => 'form-select'
                ],
                'label' => "Agent étiologique",
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ], 
                'choice_value' => function (?Etiologie $entity): string {
                    return $entity ? $entity->getAgent() : '';
                },               
                'choice_label' => 'agent',
                // 'multiple' => true,
            ])         
            ->add('cas', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nombre de cas',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\NotNull()
                ]
            ])
            ->add('service', EntityType::class,[
                'class' => Service::class,
                'query_builder' => function (ServiceRepository $r) {
                    return $r->createQueryBuilder('i')
                    ->orderBy('i.nom', 'ASC');
                },
                'attr' => [
                    'class' => 'service'
                ],
                'label' => "Service",
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],                                
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,                
            ])

            ->add('commentaire', TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Commentaire',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('souche', CollectionType::class,[
                'entry_type' => SoucheType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                // 'required' => false,
                'prototype' => true,
                'label' => false,
                'entry_options' => ['label' => false ],
                'attr' => ['data-controller' => 'form-souche', 'class' => 'souche'],

            ])
            ->add('contact', CollectionType::class,[
                'entry_type' => ContactType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                // 'required' => false,
                'label' => false,
                'entry_options' => ['label' => false ],
                'attr' => ['data-controller' => 'form-contact', 'class' => 'contact'],
            ])
            ->add('epidemie', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => [
                    'Épidémie' => 'Épidémie',
                    'Cas isolé' => 'Cas isolé'                    
                ],
                'label' => 'Type de cas',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('gravite', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => [
                    'Aucun critère de gravité ou non applicable' => 'Aucun critère de gravité ou non applicable',
                    'Gravité avérée' => 'Gravité avérée'                    
                ],
                'label' => 'Gravité',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('population', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => [
                    'Immunodéprimés Nouveau-nés et prémaRéanimation Dialyse EHPAD' => 'Immunodéprimés Nouveau-nés et prémaRéanimation Dialyse EHPAD',
                    'Population non à risque ou non applicable' => 'Population non à risque ou non applicable'                    
                ],
                'label' => 'Population à risque',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('reco', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => [
                    'Oui' => 'Oui',
                    'Non' => 'Non'                    
                ],
                'label' => 'Mesure conforme aux recommandations',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('mesure', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => [
                    'Oui' => 'Oui',
                    'Non' => 'Non'                    
                ],
                'label' => 'Mesures efficaces',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('capacite', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => [
                    'OK' => 'OK',
                    'Dépassement' => 'Dépassement'                    
                ],
                'label' => 'Capacité de gestion locale',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('impact', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => [
                    'Oui' => 'Oui',
                    'Non' => 'Non'                    
                ],
                'label' => 'Impact échelle régionale ou nationale',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('ARS', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => [
                    'aucune' => 'aucune',
                    'vert' => 'vert',
                    'bleu' => 'bleu',
                    'rouge' => 'rouge'                   
                ],
                'label' => 'Note',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('clotureARS', DateType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Cloture',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('ES', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => [
                    'aucune' => 'aucune',
                    'vert' => 'vert',
                    'bleu' => 'bleu',
                    'rouge' => 'rouge'                   
                ],
                'label' => 'Note',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('clotureES', DateType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Cloture',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('CPIAS', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => [
                    'aucune' => 'aucune',
                    'vert' => 'vert',
                    'bleu' => 'bleu',
                    'rouge' => 'rouge'                   
                ],
                'label' => 'Note',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('clotureCPIAS', DateType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Cloture',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('SPF', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => [
                    'aucune' => 'aucune',
                    'vert' => 'vert',
                    'bleu' => 'bleu',
                    'rouge' => 'rouge'                   
                ],
                'label' => 'Note',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('clotureSPF', DateType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Cloture',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('score', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Score Total',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                // 'constraints' => [
                //     new Assert\Positive(),
                //     new Assert\NotNull()
                // ]
            ])
            // ->add('score',ButtonType::class, [
            //     'attr' => [
            //         'class' => 'form-control button-score',
            //     ],
            //     'label' => 'Calculer le score',
            // ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary mt-4 valider'],
                'label' => 'Ajouter le signalement'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Signalement::class,
        ]);
    }
}
