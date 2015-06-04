<?php

namespace VM\Cron\DependencyInjection;

use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;    
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class CronExtension extends Extension{

    public function load(array $configs, ContainerBuilder $container){
        
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        $container->setParameter('cron', $config);
        
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
