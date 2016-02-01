<?php

namespace FilmoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', 'text')
            ->add('description', 'textarea')
            ->add('categorie', 'entity', array(
                'class' => 'FilmoBundle\Entity\Categorie',
                'choice_label' => 'nom'))
            ->add('acteur', 'entity', array(
                'class' => 'FilmoBundle\Entity\Acteur',
                'choice_label' => 'prenom',
                'multiple' => true));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FilmoBundle\Entity\Films'
        ));
    }
}
