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

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' =>'Titre : '
            ])
            ->add('content', TextType::class, [
                'label' =>'Contenue : '
            ])
            ->add('images', FileType::class, [
                'label' => 'Images secondaires :',
                'multiple' => true,
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new All([
                        new Img([
                            'maxSize' => '2M',
                            'mimeTypes' => ["image/jpeg", "image/jpg", "image/png"],
                            'mimeTypesMessage' => "Le fichier ne possède pas une extension valide ! Veuillez insérer une image en .jpg, .jpeg ou .png",
                        ])
                    ])
                ]
            ])
            ->add('videos', CollectionType::class, [
                'entry_type' => VideoType::class,
                'label' => false,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'required' => false,
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
