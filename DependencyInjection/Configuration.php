<?php

namespace VM\Cron\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('cron');

        $rootNode
            ->prototype('array')
                ->children()
                    ->scalarNode('format')->end()
                    ->scalarNode('service')->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
