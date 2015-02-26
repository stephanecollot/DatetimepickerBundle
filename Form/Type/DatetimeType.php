<?php

/*
* This file is part of the SCDatetimepickerBundle package.
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
    /**
     *
     * @var array
     */
    private $options;

    /**
     *
     * @var array
     */
    private static $malotFormater = array("yyyy", "yyyy", "ss", "ii", "hh", "HH", "dd", "mm", "MM",   "yy", "p", "P", "s", "i", "h", "H", "d", "m", "M");

    /**
     *
     * @var array
     */
    private static $intlFormater  = array("y", "yyyy", "ss", "mm", "HH", "hh", "dd", "MM", "MMMM", "yy", "a", "a", "s", "m", "H", "h", "d", "M", "MMM");

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
        $pickerOptions = array_merge($this->options, $options['pickerOptions']);

        //Set automatically the language
        if(!isset($pickerOptions['language']))
            $pickerOptions['language'] = \Locale::getDefault();
        if($pickerOptions['language'] == 'en')
            unset($pickerOptions['language']);

        //Set the defaut format of malot.fr/bootstrap-datetimepicker
        if(!isset($pickerOptions['format']))
            $pickerOptions['format'] = 'mm/dd/yyyy HH:ii';

        if ($pickerOptions['formatter'] == 'php'){
            $pickerOptions['format'] = DatetimeType::convertIntlFormaterToMalot( $pickerOptions['format'] );
        }

        $view->vars = array_replace($view->vars, array(
            'pickerOptions' => $pickerOptions,
        ));
    }

    /**
    * {@inheritdoc}
    */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $configs = $this->options;

        $resolver
            ->setDefaults(array(
                'widget' => 'single_text',
                'format' => function (Options $options, $value) use ($configs) {
                    $pickerOptions = array_merge($configs, $options['pickerOptions']);

                    if ($pickerOptions['formatter'] == 'php'){
                        if (isset($pickerOptions['format'])){
                            return $pickerOptions['format'];
                        } else {
                            return 'mm/dd/yyyy HH:ii';
                        }
                    } elseif ($pickerOptions['formatter'] == 'js'){
                        if (isset($pickerOptions['format'])){
                            return DatetimeType::convertMalotToIntlFormater( $pickerOptions['format'] );
                        } else {
                            return DatetimeType::convertMalotToIntlFormater( 'mm/dd/yyyy HH:ii' );
                        }
                    }
                },
                'pickerOptions' => array(),
            ));
    }

    /**
     * Convert the PHP date format to Bootstrap Datetimepicker date format
     */
    public static function convertIntlFormaterToMalot($formatter)
    {
        $intlToMalot = array_combine(self::$intlFormater, self::$malotFormater);

        $patterns = preg_split('([\\\/.:_;,\s-\ ]{1})', $formatter);
        $exits = array();

        foreach ($patterns as $val) {
            if (isset($intlToMalot[$val])){
                $exits[$val] = $intlToMalot[$val];
            } else {
                // it can throw an Exception
                $exits[$val] = $val;
            }
        }

        return str_replace(array_keys($exits), array_values($exits), $formatter);
    }

    /**
     * Convert the Bootstrap Datetimepicker date format to PHP date format
     */
    public static function convertMalotToIntlFormater($formatter)
    {
        $malotToIntl = array_combine(self::$malotFormater, self::$intlFormater);

        $patterns = preg_split('([\\\/.:_;,\s-\ ]{1})', $formatter);
        $exits = array();

        foreach ($patterns as $val) {
            if (isset($malotToIntl[$val])){
                $exits[$val] = $malotToIntl[$val];
            } else {
                // it can throw an Exception
                $exits[$val] = $val;
            }
        }

        return str_replace(array_keys($exits), array_values($exits), $formatter);
    }

    /**
     *
     * @see \Symfony\Component\Form\AbstractType::getParent()
     */
    public function getParent()
    {
        return 'datetime';
    }

    /**
     *
     * @see \Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName()
    {
        return 'collot_datetime';
    }
}
