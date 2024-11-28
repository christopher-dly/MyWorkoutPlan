<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface as FormFormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class SignupForm extends AbstractType
{
    public function buildForm(FormFormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'attr' => ['placeholder' => 'Entrez votre prenom']
            ])
            ->add('name', TextType::class, [
                'attr' => ['placeholder' => 'Entrez votre nom']
            ])
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'Entrez votre e-mail'],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'attr' => ['placeholder' => 'Entrez votre mot de passe'],
                'first_options'  => array('label' => 'mot de passe'),
                'second_options' => array('label' => 'confirmation de mot de passe'),
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'html5' => false,
            ])
            ->add('size', NumberType::class, [
            ])
            ->add('weight', NumberType::class, [
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Inscription',
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
