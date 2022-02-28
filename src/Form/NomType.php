<?php

namespace App\Form;

use App\Entity\Nom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class NomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prix')
            ->add('quantite')
            ->add('origine')
            ->add('categ')
            ->add('photo', Filetype::class,[
                'label' => 'ajouter une photo',
                'mapped'=>false,
                'required'=>false,
                'constraints' =>[
                    new File([
                        'maxSize'=>'10240k',
                        'mimeTypes'=>[
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'Veuillez insérer un jpeg ou un png uniquement'
                    ])
                ],
            ])
        ;
    }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Nom::class,
        ]);
    }
}
