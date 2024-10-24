<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomevent', TextType::class, [
                'label' => 'Nom de l\'événement',
                'attr' => [
                    'placeholder' => 'Entrez le nom de l\'événement',
                    'class' => 'form-control'
                ]
            ])
            ->add('adresseevent', TextType::class, [
                'label' => 'Adresse de l\'événement',
                'attr' => [
                    'placeholder' => 'Entrez l\'adresse',
                    'class' => 'form-control'
                ]
            ])
            ->add('capaciteevent', IntegerType::class, [
                'label' => 'Capacité de l\'événement',
                'attr' => [
                    'placeholder' => 'Nombre maximum de participants',
                    'class' => 'form-control'
                ]
            ])
            ->add('nbrticketdispo', IntegerType::class, [
                'label' => 'Nombre de tickets disponibles',
                'attr' => [
                    'placeholder' => 'Nombre de tickets disponibles',
                    'class' => 'form-control'
                ]
            ])
            ->add('datedebutevent', TextType::class, [
                'label' => 'Date de début',
                'attr' => [
                    'placeholder' => 'Entrez la date de début (format: YYYY-MM-DD)',
                    'class' => 'form-control'
                ]
            ])
            ->add('datefinevent', TextType::class, [
                'label' => 'Date de fin',
                'attr' => [
                    'placeholder' => 'Entrez la date de fin (format: YYYY-MM-DD)',
                    'class' => 'form-control'
                ]
            ])
            ->add('descriptionevent', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Entrez une description de l\'événement',
                    'class' => 'form-control',
                    'rows' => 4
                ]
            ])
            ->add('prixentre', MoneyType::class, [
                'label' => 'Prix d\'entrée',
                'currency' => 'EUR',
                'attr' => [
                    'placeholder' => 'Entrez le prix d\'entrée',
                    'class' => 'form-control'
                ]
            ])
            ->add('image', FileType::class, [
                'label' => 'Image de l\'événement',
                'mapped' => false,
                'attr' => [
                    'class' => 'form-control-file'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
