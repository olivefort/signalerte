<?php

namespace App\Form;

use App\Entity\Upload;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('csvFile', FileType::class,[
                'label' => 'Fichier CSV3',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File(
                        maxSize: '1024k',
                        extensions: [
                            'csv' => [
                                'text/csv',
                                'application/csv',
                                'text/x-comma-separated-value',
                                'text/x-csv',
                                'text/plain',
                            ]
                        ],
                        extensionsMessage: 'Insérer un fichier de type .csv valide',                        
                    ),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary mt-4 valider'],
                'label' => 'Ajouter le csv'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Upload::class,
        ]);
    }
}
