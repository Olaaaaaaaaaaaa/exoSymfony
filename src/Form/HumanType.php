<?php

namespace App\Form;

use App\Entity\Hobby;
use App\Entity\Human;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HumanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('birthAt')
            ->add('firstName')
            ->add('lastName')
            ->add('genre')
            ->add('hobbies', EntityType::class, [
                'class' => Hobby::class,
                'choice_label' => 'label',
                'multiple' => true,
                'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Human::class,
        ]);
    }
}
