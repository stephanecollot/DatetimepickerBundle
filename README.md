#DatetimepickerBundle

This bundle implements the [Bootstrap DateTime Picker](https://github.com/smalot/bootstrap-datetimepicker) in a Form Type for Symfony 2.*. The bundle structure is inspired by GenemuFormBundle.

Demo : http://www.malot.fr/bootstrap-datetimepicker/demo.php

Please feel free to contribute, to fork, to send merge request and to create ticket.

##Installation

### Step 1: Install DatetimepickerBundle

Add the bundle to your composer.json file:

```bash
php composer.phar require stephanecollot/datetimepicker-bundle
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
php app/console assets:install
```

###Step 4: Add CSS an JS to your main template

Probably somewhere inside <head>..</head>
``` twig
	{% stylesheets
	    "@SCDatetimepickerBundle/Resources/public/css/datetimepicker.css"
	%}
	<link type="text/css" rel="stylesheet" media="screen" href="{{ asset_url }}" />
	{% endstylesheets %}
```

Probably shortly before ..</body>. Change the line referencing the second .js file
for a translation other than German ("de") or remove if your are fine with English.
``` twig
	{% javascripts
	    "@SCDatetimepickerBundle/Resources/public/js/bootstrap-datetimepicker.js"
	    "@SCDatetimepickerBundle/Resources/public/js/locales/bootstrap-datetimepicker.de.js"
	%}
	<script src="{{ asset_url }}"></script>
	{% endjavascripts %}
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

Create a new JavaScript file (or add to one of your existing ones):

''' js
$(document).ready(function() {
	$('*[data-autostart-datetimepicker]').datetimepicker();
});
```

Adding that fragment directly in your view templates would also work, but mixing 
HTML and JS is not a good idea from an architectural point.


## DateTimePicker Documentation

The documentation of the datetime picker is here : http://www.malot.fr/bootstrap-datetimepicker/#options

## Notes

The date format from ``` php 'pickerOptions' => array('format'=>'dd MM yyyy - HH:ii p') ``` is used to set automatically the date format of Symfony in order to make compatible Symfony and JavaScript output.
But there are some problems for example with ``` php MM``` which display "décembre" in PHP intl translation and "Decembre" in Bootstrap translation. That is why I edited js/locales/bootstrap-datetimepicker.fr.js

