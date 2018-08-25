<?php

namespace App\Form;

use App\Entity\Bets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('stakes');
        $builder->add('position', ChoiceType::class, array(
            'choices' => array(
                'Is gonna go up-desu' => 'up',
                'Is gonna go down-desu' => 'down',
                'Is gonna stay same-desu' => 'same',
            ),            
        ));
        $timestamp = date("Y-m-d h:i:sa");
        $builder->add('timestamp', TextType::class, array(
            'attr' => array(
                'readonly' => true,
            ),
            'data' => $timestamp,
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bets::class,
        ]);
    }
}
