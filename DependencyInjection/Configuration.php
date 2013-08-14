<?php

namespace StephaneCollot\Bundle\DatetimepickerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('stephanecollot_datetimepicker');
        
        $this->addPicker($rootNode);

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
    
    
    /**
     * Add configuration Picker
     *
     * @param ArrayNodeDefinition $rootNode
     */
    private function addPicker(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('date')
                    ->canBeUnset()
                    ->addDefaultsIfNotSet()
                    ->treatNullLike(array('enabled' => true))
                    ->treatTrueLike(array('enabled' => true))
                    ->children()
                        ->booleanNode('enabled')->defaultTrue()->end()
                        ->variableNode('configs')->defaultValue(array())->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
