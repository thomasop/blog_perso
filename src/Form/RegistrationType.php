<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Image as Img;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', TextType::class, [
                'label' => 'Prénom :',
                'attr'   =>  array(
                    'class'   => 'form-control')
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom :',
                'attr'   =>  array(
                    'class'   => 'form-control')
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email :',
                'attr'   =>  array(
                    'class'   => 'form-control')
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe :', 'attr'   =>  array(
                    'class'   => 'form-control')],
                'second_options' => ['label' => 'Répéter le mot de passe :', 'attr'   =>  array(
                    'class'   => 'form-control')],
                'invalid_message' => 'Les mots de passe doivent etre similaires.',
            ])
            ->add('avatar', FileType::class, [
                'label' => 'Avatar (champ non obligatoire) :',
                'data_class' => null,
                'required' => false,
                'constraints' => [
                    new Img([
                        'maxSize' => '500K',
                        'mimeTypes' => ["image/jpeg", "image/jpg", "image/png"],
                        'mimeTypesMessage' => "Le fichier ne possède pas une extension valide ! Veuillez insérer une image en .jpg, .jpeg ou .png",
                    ])
                ]
            ])
            ->add('age', BirthdayType::class, [
                'label' => 'Age :',
                'widget' => 'choice',
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                ],
            ])
            ->add('sexe', ChoiceType::class, [
                'label' => 'Sexe :',
                'choices' => [
                    'Femme' => true,
                    'Homme' => false
                ],
                'attr'   =>  array(
                    'class'   => 'form-control')
            ])
            ->add('submit', SubmitType::class, [
                'attr'   =>  array(
                    'class'   => 'btn btn-primary')
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}
