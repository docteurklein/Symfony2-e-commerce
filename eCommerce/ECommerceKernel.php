<?php

require_once __DIR__.'/../src/autoload.php';

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Loader\YamlFileLoader as RoutingLoader;
use Symfony\Component\DependencyInjection\Loader\LoaderInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\EventDispatcher\EventDispatcher;

class ECommerceKernel extends Kernel
{
    public function registerRootDir()
    {
        return __DIR__;
    }

    public function registerBundles()
    {
        $bundles = array(

            // Core
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle,
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle,
            new Symfony\Bundle\DoctrineBundle\DoctrineBundle,
            new Symfony\Bundle\DoctrineMigrationsBundle\DoctrineMigrationsBundle,
            new Symfony\Bundle\DoctrineMongoDBBundle\DoctrineMongoDBBundle,
            new Symfony\Bundle\ZendBundle\ZendBundle,
            new Symfony\Bundle\TwigBundle\TwigBundle,

            // Third party
            new Bundle\ConsoleAutocompleteBundle\ConsoleAutocompleteBundle,
            new Bundle\DoctrineExtensionsBundle\DoctrineExtensionsBundle,
            new Bundle\FOS\UserBundle\FOSUserBundle,
            new Bundle\ContactBundle\ContactBundle,
            new Bundle\MenuBundle\MenuBundle,
            new Bundle\MongoAdminBundle\MongoAdminBundle,
            //new Bundle\Sensio\FrameworkExtraBundle\FrameworkExtraBundle,

            // ECommerce
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

        if ('test' == $this->getEnvironment()) {
            $bundles[] = new Bundle\TestSessionBundle\TestSessionBundle;
        }

        return $bundles;
    }

    public function registerBundleDirs()
    {
        $bundles = array(
            'Symfony\\Bundle'    => __DIR__.'/../src/vendor/symfony/src/Symfony/Bundle',
            'Bundle'             => __DIR__.'/../src/Bundle',
            'Bundle\\ECommerce'  => __DIR__.'/../src/Bundle/ECommerce',
            'Application'        => __DIR__.'/../src/Application',
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

    public function handleAndSend()
    {
        return $this->handle(new Request)->send();
    }
}

