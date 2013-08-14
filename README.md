#DatetimepickerBundle

This bundle implement the [Bootstrap DateTime Picker](https://github.com/smalot/bootstrap-datetimepicker) in a Form Type for Symfony 2.*

Demo : http://www.malot.fr/bootstrap-datetimepicker/demo.php

Please feel free to contribute, to fork, and to send merge request.

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
        new StephaneCollot\Bundle\DatetimepickerBundle\StephaneCollotDatetimepickerBundle(),
    );
}
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
        // ...
        ->add('createdAt', 'collot_datetime')
        ->add('updatedAt', 'collot_datetime', array(
            'widget' => 'single_text'
        ));
}
```

## Documentation

The documentation of the datetime picker is here : http://www.malot.fr/bootstrap-datetimepicker/#options


