<?php

declare(strict_types=1);

namespace Mezcalito\SyliusFileUploadPlugin\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class MezcalitoSyliusFileUploadExtension extends Extension
{
    /** @psalm-suppress UnusedVariable */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $configs);

        $container->setParameter(sprintf('%s.driver.%s', $this->getAlias(), $config['driver']), true);
        $container->setParameter(sprintf('%s.driver', $this->getAlias()), $config['driver']);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $loader->load('services.xml');
    }
}
