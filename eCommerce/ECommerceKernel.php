<?php

require_once __DIR__.'/../src/autoload.php';

use Symfony\Framework\Kernel;
use Symfony\Component\Routing\Loader\YamlFileLoader as RoutingLoader;

use Symfony\Component\DependencyInjection\Loader\LoaderInterface;

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
            new Symfony\Bundle\DoctrineMongoDBBundle\DoctrineMongoDBBundle,
            new Symfony\Bundle\ZendBundle\ZendBundle,

            // ECommerce Bundles
            new Application\ECommerceBundle\ECommerceBundle,
            new Bundle\ECommerce\SalesBundle\SalesBundle,
            new Bundle\ECommerce\ShippingBundle\ShippingBundle,
            new Bundle\ECommerce\ProductBundle\ProductBundle,
            new Bundle\ECommerce\CustomerBundle\CustomerBundle,
            new Bundle\ECommerce\CartBundle\CartBundle,
        );

        if ($this->isDebug()) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;
        }

        return $bundles;
    }

    public function registerBundleDirs()
    {
        $bundles = array(
            'Application'        => __DIR__.'/../src/Application',
            'Bundle\\ECommerce'  => __DIR__.'/../src/Bundle/ECommerce',
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

