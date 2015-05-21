<?php

namespace Crontab\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('crontab');

        $rootNode
            ->prototype('array')
                ->children()
                    ->scalarNode('format')->end()
                    ->scalarNode('command')->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
