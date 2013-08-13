What is Best Practice Bundle?
=============================
 

Installation
------------

Add the following line to your composer.json file.

```js
//composer.json
{
    //...

    "require": {
        //...
        "StephaneCollot/StephaneCollotDatetimepickerBundle" : "dev-master"
    }

    //...
}
```


And install the new bundle

```bash
php composer.phar update StephaneCollot/StephaneCollotDatetimepickerBundle
```


Configure
---------

The final step is to add the bundle to your AppKernel.php.

```php
<?php
   
    // Optionally place it in the dev and test-environments only
    if (in_array($this->getEnvironment(), array('dev', 'test'))) {
        // ...
        $bundles[] = new StephaneCollot\Bundle\StephaneCollotDatetimepickerBundle\StephaneCollotDatetimepickerBundle()
    }
```


