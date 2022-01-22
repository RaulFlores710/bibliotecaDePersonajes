<?php

namespace App\Form;

use App\Entity\Clase;
use App\Entity\Personaje;
use App\Entity\Raza;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CrearPersonajeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('foto', FileType::class, [
                'label' => 'Imagen de Personaje (JPG file)',
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                'required' => false,
                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Por favor ingrese una imagen valida',
                    ])
                ],
            ])
            ->add('Nombre')
            ->add('edad')
            ->add('raza',EntityType::class,[
                // looks for choices from this entity
                'class' => Raza::class,     // uses the User.username property as the visible option string
                'choice_label' => 'nombre',
            ])
            ->add('clase',EntityType::class,[
                'class'=>Clase::class,'choice_label'=>'nombre',
            ])
            ->add('historia',TextareaType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personaje::class,
        ]);
    }
}
