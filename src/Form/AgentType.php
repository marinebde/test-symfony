<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Specialite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AgentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('date_of_birth', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('identification_code')
            ->add('nationality', ChoiceType::class, [
                'choices' => [
                    'Française' => 'Française',
                    'Anglaise' => 'Anglaise',
                    'Portugaise' => 'Portugaise',
                    'Espagnole' => 'Espagnole',
                    'Italienne' => 'Italienne',
                    'Allemande' => 'Allemande',
                    'Polonaise' => 'Polonaise',
                    'Belge' => 'Belge',
                    'Suisse' => 'Suisse'
                ]
            ])
            ->add('specialite', EntityType::class, [
                'class' => Specialite::class,
                'label' => 'Spécialité: ',
                'choice_label' => 'name',
                'multiple' => true,   
                'expanded' => true   
                ]);
        }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agent::class,
        ]);
    }
}
