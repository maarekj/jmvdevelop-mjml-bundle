<?php

declare(strict_types=1);

namespace JmvDevelop\MjmlBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class JmvDevelopMjmlExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('services.yaml');

        $withNodi = (bool) $config['with_nodi'];
        if (true === $withNodi) {
            $loader->load('nodi.yaml');
        }

        $withTwig = (bool) $config['with_twig'];
        if (true === $withTwig) {
            $loader->load('twig.yaml');
        }

        $container->setAlias('jmv_develop_mjml.cache', (string) $config['cache_service']);
        $container->setParameter('jmv_develop_mjml.nodejs_bin', (string) $config['nodejs_bin']);
        $container->setParameter('jmv_develop_mjml.mjml_bin', (string) $config['mjml_bin']);
    }
}
