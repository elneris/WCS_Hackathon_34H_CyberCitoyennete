<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',null ,[
                'label' => "Prénom"
            ])
            ->add('lastname', null, [
                'label' => "Nom"
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent être identiques',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe',
                    ],
                'second_options' => [
                    'label' => 'Répéter le Mot de passe',
                    ],
                'mapped' => false,
                'constraints' => [ new NotBlank([
                    'message' => 'Entrer un mot de passe',
                ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au minimum {{ limit }} caractères',
                        'max' => 4096,]),
                ],
            ])
            ->add('class', EntityType::class, [
                'choice_label' => 'name',
                'label' => 'Choix de la classe',
                'class' => Classe::class,
                'required' => false,
                'by_reference' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
