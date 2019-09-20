<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Menus;
use App\Entity\Photos;
use App\Entity\SousMenus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accroche')
            ->add('titre')
            ->add('texte')
            ->add('resume')
            ->add('photos', FileType::class,[
                'label' => 'Images',
                'mapped' => false,
                'required' => false
            ])
            ->add('menus', EntityType::class,[
                'class' => Menus::class,
                'choice_label' => 'Libelle'
            ])
            ->add('sousMenu', EntityType::class,[
                'class' => SousMenus::class,
                'choice_label' => 'libelle'
            ])
            ->add('enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
