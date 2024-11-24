<?php

namespace Xefi\Faker\SymfonyBundle\Tests\Unit;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Xefi\Faker\SymfonyBundle\DependencyInjection\XefiFakerSymfonyExtension;
use Xefi\Faker\Faker;

class XefiFakerSymfonyTest extends TestCase
{
    public function testServiceIsLoaded(): void
    {
        $container = new ContainerBuilder();
        $extension = new XefiFakerSymfonyExtension();

        $configs = [];

        $extension->load($configs, $container);

        $this->assertTrue($container->has('xefi.faker'));

        $definition = $container->getDefinition('xefi.faker');
        $this->assertSame(Faker::class, $definition->getClass());

        $arguments = $definition->getArguments();
        $this->assertArrayNotHasKey('$locale', $arguments);
    }

    public function testServiceIsLoadedWithLocaleConfiguration(): void
    {
        $container = new ContainerBuilder();
        $extension = new XefiFakerSymfonyExtension();

        $configs = [['locale' => 'fr_FR']];

        $extension->load($configs, $container);

        $this->assertTrue($container->has('xefi.faker'));

        $definition = $container->getDefinition('xefi.faker');
        $this->assertSame(Faker::class, $definition->getClass());

        $arguments = $definition->getArguments();
        $this->assertArrayHasKey('$locale', $arguments);
        $this->assertEquals('fr_FR', $arguments['$locale']);
    }
}
