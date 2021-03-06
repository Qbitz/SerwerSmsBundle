<?php

namespace Qbitz\SerwerSmsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class QbitzSerwerSmsExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('qbitz_serwer_sms.url',       $config['url']);
        $container->setParameter('qbitz_serwer_sms.login',     $config['login']);
        $container->setParameter('qbitz_serwer_sms.password',  $config['password']);
        $container->setParameter('qbitz_serwer_sms.test',      $config['test']);
    }
}
