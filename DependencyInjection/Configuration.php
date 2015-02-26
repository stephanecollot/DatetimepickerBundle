<?php

namespace SC\DatetimepickerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from app/config files
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('stephane_collot_datetimepicker');

        $this->addPicker($rootNode);

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
                ->arrayNode('picker')
                    ->canBeUnset()
                    ->addDefaultsIfNotSet()
                    ->treatNullLike(array('enabled' => true))
                    ->treatTrueLike(array('enabled' => true))
                    ->children()
                        ->booleanNode('enabled')->defaultTrue()->end()
                        ->arrayNode('configs')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->enumNode('formatter')->defaultValue('js')
                                    ->values(array('js', 'php'))
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
