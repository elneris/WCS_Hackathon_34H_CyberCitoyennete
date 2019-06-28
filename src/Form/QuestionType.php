<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Question;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value', TextType::class, [

                'label' => 'Question',

            ])
            ->add('goodAnswer', TextType::class, [

                'label' => 'Bonne réponse',])

            ->add('wrongAnswerOne', TextType::class, [

                'label' => 'Mauvaise réponse n°1',])

            ->add('wrongAnswerTwo', TextType::class, [

                'label' => 'Mauvaise réponse n°2',])

            ->add('wrongAnswerThree', TextType::class, [

                'label' => 'Mauvaise réponse n°3',])

            ->add('category',EntityType::class, [

                'class'=> Category::class,
                'label' => 'Catégorie',
                'choice_label'=> 'name',
                'by_reference'=>false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
