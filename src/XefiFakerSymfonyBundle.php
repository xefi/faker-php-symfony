<?php

namespace Xefi\Faker\SymfonyBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Xefi\Faker\Container\Container;
use Xefi\Faker\SymfonyBundle\DependencyInjection\XefiFakerSymfonyExtension;

class XefiFakerSymfonyBundle extends AbstractBundle
{
    public function boot(): void
    {
        $projectDir = $this->container->getParameter('kernel.project_dir');
        $cacheDir = $this->container->getParameter('kernel.cache_dir');

        Container::basePath(sprintf('%s/', $projectDir));
        Container::packageManifestPath(sprintf('%s/faker-packages.php', $cacheDir));
        Container::containerMixinManifestPath(sprintf('%s/vendor/xefi/faker-php/src/Container/ContainerMixin.php', $projectDir));
    }

    public function build(ContainerBuilder $container): void
    {
        $container->registerExtension(new XefiFakerSymfonyExtension());
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
           ->children()
               ->arrayNode('xefi_faker')
                   ->children()
                       ->integerNode('locale')->defaultNull()->end()
                   ->end()
               ->end()
           ->end()
        ;
    }
}