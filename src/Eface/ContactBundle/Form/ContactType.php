<?php

namespace Eface\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Contact form
 *
 * Class ContactType
 *
 * @package ContactBundle
 */
class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('email', 'email');
        $builder->add('message', 'textarea');
    }

    /**
     * Get form name
     *
     * @return string
     */
    public function getName()
    {
        return 'contact';
    }
}
