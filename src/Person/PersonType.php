<?php

namespace App\Person;

use Symfony\Component\Form\{
    AbstractType,
    Extension\Core\Type\EmailType,
    FormBuilderInterface
};
use App\Entity\Person;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PersonType
 */
class PersonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('identityNumber')
            ->add('emailAddress', EmailType::class)
            ->add('phoneNumber')
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
            'allow_extra_fields' => true,
            'csrf_protection' => false,
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getBlockPrefix()
    {
        return '';
    }
}
