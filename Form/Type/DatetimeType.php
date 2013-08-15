<?php

/*
* This file is part of the StephanecollotDatetimepickerBundle package.
*
* (c) Stephane Collot
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace SC\DatetimepickerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType as BaseDateType;

/**
* DatetimeType
*
*/
class DatetimeType extends AbstractType
{
    private $options;

    /**
    * Constructs
    *
    * @param array $options
    */
    public function __construct(array $options)
    {
        $this->options = $options;
    }
    
    /**
    * {@inheritdoc}
    */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $pickerOptions = $options['pickerOptions'];

        if(!isset($options['pickerOptions']['language']))
            $pickerOptions['language'] = \Locale::getDefault();
        
        if($pickerOptions['language'] == 'en')
            unset($pickerOptions['language']);

        $view->vars = array_replace($view->vars, array(
            'pickerOptions' => $pickerOptions,
        ));
    }

    /**
    * {@inheritdoc}
    */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'widget' => 'single_text',
                'pickerOptions' => array(),
            ));
    }

    /**
    * {@inheritdoc}
    */
    public function getParent()
    {
        return 'datetime';
    }

    /**
    * {@inheritdoc}
    */
    public function getName()
    {
        return 'collot_datetime';
    }

}
