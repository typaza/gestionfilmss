<?php

namespace FilmoBundle\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActeurType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text')
            ->add('prenom','text')
            ->add('datenaissance', 'birthday',array('format' => 'dd-MM-yyyy'))
            ->add('sexe','choice', array(
                // Shows "Male" to the user, returns "m" when selected
                'choices' => array('Homme' => 'h', 'Femme' => 'f'), 'expanded'=>true,
                'choices_as_values' => true,
            ));

    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FilmoBundle\Entity\Acteur'
        ));
    }
}
