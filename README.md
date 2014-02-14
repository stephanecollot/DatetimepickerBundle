#DatetimepickerBundle

This bundle implements the [Bootstrap DateTime Picker](https://github.com/smalot/bootstrap-datetimepicker) in a Form Type for Symfony 2.*. The bundle structure is inspired by GenemuFormBundle.

Demo : http://www.malot.fr/bootstrap-datetimepicker/demo.php

Please feel free to contribute, to fork, to send merge request and to create ticket.

##Installation

### Step 1: Install DatetimepickerBundle

Add the following dependency to your composer.json file:

``` json
{
    "require": {

        "stephanecollot/datetimepicker-bundle": "dev-master"
    }
}
```

and then run

```bash
php composer.phar update stephanecollot/datetimepicker-bundle
```

### Step 2: Enable the bundle

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new SC\DatetimepickerBundle\SCDatetimepickerBundle(),
    );
}
```

``` yml
# app/config/config.yml
sc_datetimepicker:
    picker: ~
```

### Step 3: Initialize assets

``` bash
$ php app/console assets:install web/
```

## Usages

``` php
<?php
// ...
public function buildForm(FormBuilder $builder, array $options)
{
    $builder
        // defaut options
        ->add('createdAt', 'collot_datetime') 
        
        // full options
        ->add('updatedAt', 'collot_datetime', array( 'pickerOptions' =>
            array('format' => 'mm/dd/yyyy',
                'weekStart' => 0,
                'startDate' => date('m/d/Y'), //example
                'endDate' => '01/01/3000', //example
                'daysOfWeekDisabled' => '0,6', //example
                'autoclose' => false,
                'startView' => 'month',
                'minView' => 'hour',
                'maxView' => 'decade',
                'todayBtn' => false,
                'todayHighlight' => false,
                'keyboardNavigation' => true,
                'language' => 'en',
                'forceParse' => true,
                'minuteStep' => 5,
                'pickerReferer ' => 'default', //deprecated
                'pickerPosition' => 'bottom-right',
                'viewSelect' => 'hour',
                'showMeridian' => false,
                'initialDate' => date('m/d/Y', 1577836800), //example
                ))) ; 

}
```

Add form_javascript and form_stylesheet

The principle is to separate the javascript, stylesheet and html.
This allows better integration of web pages.

### Example:

``` twig
{% block stylesheets %}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    
    {{ form_stylesheet(form) }}
{% endblock %}

{% block javascripts %}
    <script src="{{ asset('js/jquery.min.jss') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    
    {{ form_javascript(form) }}
{% endblock %}

{% block body %}
    <form action="{{ path('my_route_form') }}" type="post" {{ form_enctype(form) }}>
        {{ form_widget(form) }}

        <input type="submit" />
    </form>
{% endblock %}
```

## Documentation

The documentation of the datetime picker is here : http://www.malot.fr/bootstrap-datetimepicker/#options

## Notes

The date format from ``` php 'pickerOptions' => array('format'=>'dd MM yyyy - HH:ii p') ``` is used to set automatically the date format of Symfony in order to make compatible Symfony and JavaScript output.
But there are some problems for example with ``` php MM``` which display "décembre" in PHP intl translation and "Decembre" in Bootstrap translation. That is why I edited js/locales/bootstrap-datetimepicker.fr.js

