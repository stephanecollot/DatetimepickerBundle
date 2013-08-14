<?php

namespace StephaneCollot\Bundle\DatetimepickerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class StephaneCollotDatetimepickertExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        
        
        if (isset($configs["picker"]) && !empty($configs["picker"]['enabled'])) {
            $method = 'register' . ucfirst("picker") . 'Configuration';

            $this->$method($configs["picker"], $container);
        }
        
        
        
    }
    
    /**
     * Loads Picker configuration
     *
     * @param array            $config    A configuration array
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    private function registerPickerConfiguration(array $configs, ContainerBuilder $container)
    {
        $container->setParameter('stephanecollot.form.type.datetime', $configs['configs']);
    }
}
