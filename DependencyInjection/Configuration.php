<?php

namespace Conjecto\Bundle\EasyRdfBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('easyrdf');
        $rootNode
            ->children()
                // namespaces
                ->arrayNode('namespaces')
                    ->prototype('array')
                        ->beforeNormalization()
                        ->ifString()
                            ->then(function($v) { return array('uri'=> $v); })
                        ->end()
                        ->children()
                            ->scalarNode('uri')->isRequired()->end()
                        ->end()
                    ->end()
                ->end()
                // type maps
                ->arrayNode('type_maps')
                    ->prototype('array')
                        ->beforeNormalization()
                        ->ifString()
                            ->then(function($v) { return array('class'=> $v); })
                        ->end()
                        ->children()
                            ->scalarNode('class')->isRequired()->end()
                        ->end()
                    ->end()
                ->end()
                // endpoints
                ->arrayNode('endpoints')
                    ->prototype('array')
                        ->beforeNormalization()
                        ->ifString()
                            ->then(function($v) { return array('uri'=> $v); })
                        ->end()
                        ->children()
                            ->scalarNode('uri')->isRequired()->end()
                        ->end()
                    ->end()
                ->end()
                // default_endpoint
                ->scalarNode('default_endpoint')->end()
        ;
        return $treeBuilder;
    }
}
