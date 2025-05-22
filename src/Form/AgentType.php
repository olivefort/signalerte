<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Organisme;
use App\Entity\Resistance;
use App\Entity\Signalement;
use App\Repository\OrganismeRepository;
use App\Repository\ResistanceRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AgentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('organisme', EntityType::class,[
                'class' => Organisme::class,
                'query_builder' => function (OrganismeRepository $r) {
                    return $r->createQueryBuilder('i')
                    ->orderBy('i.type', 'ASC');
                },
                'attr' => [
                    'class' => 'test'
                ],
                'label' => "Organisme",
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],                                
                'choice_label' => 'type',
            ])
            ->add('resistance', EntityType::class,[
                'class' => Resistance::class,
                'query_builder' => function (ResistanceRepository $r) {
                    return $r->createQueryBuilder('i')
                    ->orderBy('i.type', 'ASC');
                },
                'attr' => [
                    'class' => 'test'
                ],
                'label' => "Resistance",
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],                                
                'choice_label' => 'type',
                'multiple' => true,  
                'expanded' => true,           
            ])            
            // ->add('submit', SubmitType::class, [
            //     'attr' => ['class' => 'btn btn-primary mt-4'],
            //     'label' => "Ajouter l'agent infectieux"
            // ])
        //     ->add('signalements', EntityType::class, [
        //         'class' => Signalement::class,
        //         'choice_label' => 'id',
        //         'multiple' => true,
        //     ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agent::class,
        ]);
    }
}
