<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Cible;
use App\Entity\Contact;
use App\Entity\Mission;
use App\Entity\Planque;
use App\Entity\Specialite;
use App\Entity\Status;
use App\Entity\TypeMission;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('code_name')
            ->add('country', ChoiceType::class, [
                'choices' => [
                    'France' => 'France',
                    'Angleterre' => 'Angleterre',
                    'Suisse' => 'Suisse',
                    'Allemagne' => 'Allemagne',
                    'Espagne' => 'Espagne',
                    'Portugal' => 'Portugal',
                    'Italie' => 'Italie',
                    'Belgique' => 'Belgique',
                    'Pologne' => 'Pologne',
                ]
            ])
            ->add('speciality', EntityType::class, [
                'label' => 'Choisir une spécialité: ',
                'placeholder' => 'Choisir une spécialité',
                'class' => Specialite::class,
                'choice_label' => 'name'
            ])
            ->add('agents', EntityType::class, [
                'label' => 'Choisir un ou des agent(s): ',
                'class' => Agent::class,
                'choice_label' => 'identification_code',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('contacts', EntityType::class, [
                'label' => 'Selectionner le(les) contact(s): ',
                'class' => Contact::class,
                'choice_label' => 'code_name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('cibles', EntityType::class, [
                'label' => 'Selectionner la(les) cible(s): ',
                'class' => Cible::class,
                'choice_label' => 'code_name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('planques', EntityType::class, [
                'label' => 'Selectionner la(les) planque(s): ',
                'class' => Planque::class,
                'choice_label' => 'code',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('start_date', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('end_date', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('status', EntityType::class, [
                'label' => 'Statut de la Mission: ',
                'class' => Status::class,
                'choice_label' => 'name'
            ])
            ->add('type', EntityType::class, [
                'label' => 'Type de Mission: ',
                'class' => TypeMission::class,
                'choice_label' => 'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
