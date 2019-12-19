<?php

namespace AppBundle\Form;

use AppBundle\Entity\Candidat;
use AppBundle\Entity\Moniteur;
use AppBundle\Entity\Voiture;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



class PlanningType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('date', DateType::class)
           ->add('Candidat',EntityType::class, array(
                'class' => 'AppBundle\Entity\Candidat',
                'choice_label'=>'nom',
                'expanded'=>false,
                'multiple'=>false))

           ->add('Moniteur',EntityType::class, array(
                'class' => 'AppBundle\Entity\Moniteur',
                'choice_label'=>'nom',
                'expanded'=>false,
                'multiple'=>false))

           ->add('Voiture',EntityType::class, array(
                'class' => 'AppBundle\Entity\Voiture',
                'choice_label'=>'marque',
                'expanded'=>false,
                'multiple'=>false));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Planning'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_planning';
    }


}
