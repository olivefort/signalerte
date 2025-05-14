<?php

namespace App\Form;

use App\Entity\Structure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class StructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control text-uppercase',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Nom de la structure',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('finessG', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '9',
                    'maxlength' => '9'
                ],
                'label' => 'Numéro de Finess Géographique',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 9, 'max' => 9]),
                    new Assert\Positive(),
                    new Assert\NotNull()
                ]
            ])
            ->add('finessJ', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '9',
                    'maxlength' => '9'
                ],
                'label' => 'Numéro de Finess Juridique',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 9, 'max' => 9]),
                    new Assert\Positive(),
                    new Assert\NotNull()
                ]
            ])
            ->add('numero', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '1',
                    'maxlength' => '5'
                ],
                'label' => 'Numéro de Voie',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 1, 'max' => 5]),
                    new Assert\Positive(),
                    new Assert\NotNull()
                ]
            ])
            ->add('voie', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => [
                    'avenue' => 'AV',
                    'rue' => 'RUE',
                    'allée' => 'ALL',
                    'boulevard' => 'BLV',
                    'place' => 'PL',
                    'route' => 'RTE',
                    'chemin' => 'CHE',
                    'mail' => 'MAIL',
                    'rempart' => 'REM',
                    'faubourg' => 'FG',
                    'lotissement' => 'LOT',
                    'cité' => 'CITE',
                    'esplanade' => 'ESP',
                    'enclos' => 'ENC',
                    'château' => 'CHT',
                    'résidence' => 'RES',
                    'passage' => 'PAS',
                    'grande rue' => 'GR',
                    'village' => 'VGE',
                    'cours' => 'COURS',
                    'quartier' => 'QUA',
                    'quai' => 'QUAI',
                    'rond-point' => 'RPT',
                    'domaine' => 'DOM',
                    'clos' => 'CLOS',
                    'petite rue' => 'PTR',
                    'promenade' => 'PROM',
                    'square' => 'SQ',
                    'levée' => 'LEVE',
                    'ancienne route' => 'ART',
                    'centre' => 'CTRE',
                    'vieille route' => 'VTE',
                    'voie' => 'VOIE',
                    'sentier' => 'SEN',
                ],
                'label' => 'Type de voie',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('adresse', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Nom de la voie',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('cp', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '5',
                    'maxlength' => '5'
                ],
                'label' => 'Code Postale',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 5, 'max' => 5]),
                    new Assert\Positive(),
                    new Assert\NotNull()
                ]
            ])
            ->add('ville', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Ville',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('departement', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => [
                    'Cher' => '18-CHER',
                    'Eure et Loir' => '28-EURE ET LOIR',
                    'Indre' => '36-INDRE',
                    'Indre et Loire' => '37-INDRE ET LOIRE',
                    'Loir et Cher' => '41-LOIR ET CHER',
                    'Loiret' => '45-LOIRET'
                ],
                'label' => 'Département',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('longitude', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '10',
                    'maxlength' => '10'
                ],
                'label' => 'Longitude',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    // new Assert\Length(['min' => 10, 'max' => 10]),
                    new Assert\Positive(),
                    new Assert\NotNull()
                ]
            ])
            ->add('latitude', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '11',
                    'maxlength' => '11'
                ],
                'label' => 'Latitude',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    // new Assert\Length(['min' => 11, 'max' => 11]),
                    new Assert\Positive(),
                    new Assert\NotNull()
                ]
            ])
            ->add('type', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-select'
                ],
                'choices' => [                    
                    "Appartement Thérapeutique" => '412-AT',
                    "Centre d'Accueil Thérapeutique à Temps Partiel" => '425-CATTP',
                    "Centre de Dialyse" => '141-CD',
                    "Centre Hospitalier" => '355-CH',
                    "Centre Hospitalier Régional" => '101-CHR',
                    "Centre Hospitalier Spécialisé lutte Maladies Mentales" => '292-CHSMM',
                    "Établissement d'Accueil Médicalisé" => '448-EAM',
                    "Établissement pour Enfants ou Adolescents Polyhandicapés" => '188-EEAP',
                    "Établissement d'Hébergement pour Personnes Agées Dépendantes" => '500-EHPAD',
                    "Établissement de Soins Chirurgicaux" => '128-ESC',
                    "Établissement de Soins Longue Durée" => '362-ESLD',
                    "Établissement de Soins Médicaux" => '129-ESM',
                    "Établissement de Soins Pluridisciplinaire" => '365-ESP',
                    "Établissement de Santé Privé Autorisé en SSR" => '109-ESPASSR',
                    "Foyer d'Accueil Médicalisé pour Adulte Handicapés" => '437-FAM',
                    "Hospitalisation à Domicile" => '127-HAD',
                    "Hôpital Local" => '106-HL',
                    "Institut pour Déficients Auditifs" => '195-IDA',
                    "Institut d'Éducation Motrice" => '192-IEM',
                    "Institut Médicaux-Éducatif" => '183-IME',
                    "Institut Thérapeutique Éducatif et Pédagogique" => '186-ITEP',
                    "Maison d'Accueil Spécialisée" => '255-MAS',
                    "Maison de Santé pour Maladies Mentales" => '161-MSMM',
                    "Structure d'Alternative à la Dialyse en centre" => '146-SAD',
                    "Service Médico-Psychologique Régional" => '415-SMPR'
                ],
                'label' => "Catégorie de l'établissement",
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary mt-4'],
                'label' => 'Ajouter la structure'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Structure::class,
        ]);
    }
}
