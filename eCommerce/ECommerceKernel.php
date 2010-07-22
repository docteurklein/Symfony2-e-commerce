<?php

require_once __DIR__.'/../src/autoload.php';

use Symfony\Framework\Kernel;
use Symfony\Components\Routing\Loader\YamlFileLoader as RoutingLoader;

use Symfony\Components\DependencyInjection\Loader\LoaderInterface;

class ECommerceKernel extends Kernel
{
    public function registerRootDir()
    {
        return __DIR__;
    }

    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Framework\KernelBundle,
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle,
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle,
            new Symfony\Bundle\DoctrineBundle\DoctrineBundle,
            new Symfony\Bundle\DoctrineMigrationsBundle\DoctrineMigrationsBundle,
            new Application\ECommerceBundle\ECommerceBundle,
        );

        if ($this->isDebug()) {
        }

        return $bundles;
    }

    public function registerBundleDirs()
    {
        $bundles = array(
            'Application'        => __DIR__.'/../src/Application',
            'Bundle'             => __DIR__.'/../src/Bundle',
            'Symfony\\Framework' => __DIR__.'/../src/vendor/symfony/src/Symfony/Framework',
            'Symfony\\Bundle'    => __DIR__.'/../src/vendor/symfony/src/Symfony/Bundle',
        );
        
        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        return $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }

    public function registerRoutes()
    {
        $loader = new RoutingLoader($this->getBundleDirs());

        return $loader->load(__DIR__.'/config/routing.yml');
    }
}
