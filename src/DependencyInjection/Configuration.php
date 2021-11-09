<?php

declare(strict_types=1);

namespace JmvDevelop\MjmlBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('jmv_develop_mjml');

        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('with_nodi')->defaultFalse()->end()
            ->scalarNode('with_twig')->defaultFalse()->end()
            ->scalarNode('cache_service')->isRequired()->end()
            ->scalarNode('nodejs_bin')->isRequired()->end()
            ->scalarNode('mjml_bin')->isRequired()->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
