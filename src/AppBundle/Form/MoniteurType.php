<?php

namespace AppBundle\Form;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MoniteurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('adresse', ChoiceType::class, [
                'choices' =>
                    [
                        'Ariana' => 'tn',
                        'Béja' => 'tn',
                        'Ben Arous' => 'tn',
                        'Bizerte' => 'tn',
                        'Gabès' => 'tn',
                        'Gafsa' => 'tn',
                        'Jendouba' => 'tn',
                        'Kairouan' => 'tn',
                        'Kasserine' => 'tn',
                        'Kébili' => 'tn',
                        'Kef' => 'tn',
                        'Mahdia' => 'tn',
                        'Manouba' => 'tn',
                        'Médenine' => 'tn',
                        'Monastir' => 'tn',
                        'Nabeul' => 'tn',
                        'Sfax' => 'tn',
                        'Sidi Bouzid' => 'tn',
                        'Siliana' => 'tn',
                        'Sousse' => 'tn',
                        'Tataouine' => 'tn',
                        'Tozeur' => 'tn',
                        'Tunis' => 'tn',
                        'Zaghouan' => 'tn',]
                ,   'preferred_choices' => ['muppets', 'arr'],])
            ->add('Email', EmailType::class)
            ->add('telephone',IntegerType::class)

        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Moniteur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_moniteur';
    }


}
