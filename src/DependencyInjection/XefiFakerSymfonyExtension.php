<?php

namespace Xefi\Faker\SymfonyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Xefi\Faker\Faker;

class XefiFakerSymfonyExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $faker = $container->register('xefi.faker', Faker::class);
        $faker->setPublic(true);
        if (isset($configs[0]['locale'])) {
            $faker->setArgument('$locale', $configs[0]['locale']);
        }

        // services.yaml
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('services.yaml');
    }
}