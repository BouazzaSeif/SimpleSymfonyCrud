<?php

namespace App\Form;

use App\Entity\Rdv;
use App\Entity\Voyageur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RdvSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('voyageur', EntityType::class,[
            // looks for choices from this entity
            'class' => Voyageur::class,
            // uses the voyageur.name property as the visible option string
            'choice_label' => 'nom'])
            ->add('Search',SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rdv::class,
        ]);
    }
}
