<?php

namespace App\Form;

use App\Entity\Post;
use App\Form\VideoType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Image as img;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PosteditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = null): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' =>'Titre : ',
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('content', TextType::class, [
                'label' =>'Contenue : ',
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}