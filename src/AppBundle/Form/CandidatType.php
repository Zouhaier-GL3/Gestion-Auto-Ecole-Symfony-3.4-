<?php

namespace AppBundle\Form;

use AppBundle\Entity\Candidat;
use Doctrine\ORM\Mapping\Entity;
use function PHPSTORM_META\type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CandidatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom')
            ->add('Adresse', ChoiceType::class, [
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
            ->add('telephone',IntegerType::class)
            ->add('Date', DateType::class, ['widget' => 'single_text', 'format' => 'yyyy-MM-dd'])
            ->add('Email', EmailType::class)
            ->add('file', FileType::class, array('data_class' => null,'required' => false))


        ;
    }/*
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Candidat'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_candidat';
    }


}
