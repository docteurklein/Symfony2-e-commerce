<?php

namespace Bundle\ECommerce\SalesBundle\Tests\Entities;

use Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration;

use Doctrine\ODM\MongoDB\DocumentManager,
    Doctrine\ODM\MongoDB\Configuration as ODM_Configuration;

use Bundle\ECommerce\SalesBundle\Entities\Order;
use Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct;

class OrderTest extends \PHPUnit_Framework_TestCase
{
    public function testOrder()
    {
        $em = $this->getEm();
        //$dm = $this->getDm();

        $product = new ConfigurableProduct();
        $product->setName('test');

        //$dm->persist($product);

        $order = new Order();
        $order->setProduct($product);

        $em->persist($order);

        $order = $em->find('Order', $order->getId());

        $this->assertEqual($order->getProduct(), $product);
    }

    public function getEm()
    {
        $lib = '/var/www/Symfony2-e-commerce/src/vendor/doctrine/lib';
        require $lib.'/vendor/doctrine-common/lib/Doctrine/Common/ClassLoader.php';

        $classLoader = new \Doctrine\Common\ClassLoader('Doctrine\Common', $lib . '/vendor/doctrine-common/lib');
        $classLoader->register();

        $classLoader = new \Doctrine\Common\ClassLoader('Doctrine\DBAL', $lib . '/vendor/doctrine-dbal/lib');
        $classLoader->register();

        $classLoader = new \Doctrine\Common\ClassLoader('Doctrine\ORM', $lib);
        $classLoader->register();

        $cache = new \Doctrine\Common\Cache\ArrayCache;

        $config = new Configuration;
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver(__DIR__.'/Document');
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);
        $config->setProxyDir(__DIR__.'/Proxies');
        $config->setProxyNamespace('Proxies');

        $config->setAutoGenerateProxyClasses(true);

        $connectionOptions = array(
            'driver' => 'pdo_sqlite',
            'path' => 'database.sqlite'
        );

        return EntityManager::create($connectionOptions, $config);
    }

    public function getDm()
    {
        $cache = new \Doctrine\Common\Cache\ArrayCache;

        $config = new ODM_Configuration;
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver(__DIR__.'/Entities');
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);

        $config->setAutoGenerateProxyClasses(true);

        return DocumentManager::create($connectionOptions);
    }
}

