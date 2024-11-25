<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface as FormFormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class UserForm extends AbstractType
{
    public function buildForm(FormFormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', TextType::class, [
                'attr' => ['placeholder' => 'Entrez votre prenom'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champs ne peut pas etres vide']),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 50,
                        'minMessage' => 'le prénom doit contenir au moins 3 caractères',
                        'maxMessage' => 'le prénom ne peut pas dépasser 50 caractère'
                    ])
                ],
            ])
            ->add('nom', TextType::class, [
                'attr' => ['placeholder' => 'Entrez votre nom'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champs ne peut pas etres vide']),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 50,
                        'minMessage' => 'le nom doit contenir au moins 3 caractères',
                        'maxMessage' => 'le nom ne peut pas dépasser 50 caractère'
                    ])
                ],
            ])
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'Entrez votre e-mail'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champs ne peut pas etres vide']),
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'attr' => ['placeholder' => 'Entrez votre mot de passe'],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champs ne peut pas etres vide']),
                    new Assert\Length(['min' => 6, 'minMessage' => 'le pseudo doit contenir au moins 6 caractères'])
                ],
                'first_options'  => array('label' => 'mot de passe'),
                'second_options' => array('label' => 'confirmation de mot de passe'),
            ])
            ->add('birthdate', DateType::class, [
                'constraint' => [
                    new Assert\NotBlank(['message' => 'Le champs ne peut pas etres vide'])
                ],
            ])
            ->add('size', IntegerType::class, [
                'constraint' => [
                    new Assert\NotBlank(['message' => 'Le champs ne peut pas etres vide'])
                ],
            ])
            ->add('weight', IntegerType::class, [
                'constraint' => [
                    new Assert\NotBlank(['message' => 'Le champs ne peut pas etres vide'])
                ],
            ])
            ->add('submit', SubmitType::class);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
