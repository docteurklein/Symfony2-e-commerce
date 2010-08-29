<?php

namespace Bundle\ECommerce\SalesBundle\Tests\Entities;

// [Entity|Document]Manager creation specific
use Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration;

use Doctrine\Common\ClassLoader,
    Doctrine\Common\Annotations\AnnotationReader,
    Doctrine\ODM\MongoDB\DocumentManager,
    Doctrine\ODM\MongoDB\Mongo,
    Doctrine\ODM\MongoDB\Configuration as ODM_Configuration,
    Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
// end [Entity|Document]Manager creation specific

use Bundle\ECommerce\SalesBundle\EventSubscriber\OrderEventSubscriber;

use Bundle\ECommerce\SalesBundle\Entities\Order;
use Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct;


class OrderTest extends \PHPUnit_Framework_TestCase
{
    public function testOrder()
    {
        $em = $this->getEm();
        $dm = $this->getDm();

        OrderEventSubscriber::initialize($em, $dm);

        $product = new ConfigurableProduct();
        $product->setName('test');

        $dm->persist($product);
        $dm->flush();
        $dm->clear();

        $order = new Order();
        $order->setProduct($product);

        $em->persist($order);
        $em->flush();
        $em->clear();

        // get reference order directly from relational db
        $order_ref = $em->find('Bundle\ECommerce\SalesBundle\Entities\Order', $order->getId());
        
        // get reference product directly from mongodb
        $product_ref = $dm->find('Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct', $product->getId());
        
        // get product from mongodb indirectly
        $_product = $order_ref->getProduct();

        $this->assertTrue($product_ref->getName() == 'test');
        $this->assertTrue($_product->getName() == 'test');
        $this->assertTrue($_product->getId() == $product_ref->getId());
    }

    public function getEm()
    {
        $cache = new \Doctrine\Common\Cache\ArrayCache;

        $config = new Configuration;
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver(__DIR__.'/Entities');
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);
        $config->setProxyDir(__DIR__.'/ORM/Proxies');
        $config->setProxyNamespace('ORM\Proxies');
        $config->setAutoGenerateProxyClasses(true);

        $connectionOptions = array(
            'driver' => 'pdo_sqlite',
            'path'   => __DIR__.'/OrderTests.sqlite',
        );

        return EntityManager::create($connectionOptions, $config);
    }

    public function getDm()
    {
        $config = new ODM_Configuration;
        $config->setProxyDir(__DIR__.'/ODM/Proxies');
        $config->setProxyNamespace('ODM\Proxies');
        $config->setAutoGenerateProxyClasses(true);

        $reader = new AnnotationReader();
        $reader->setDefaultAnnotationNamespace('Doctrine\ODM\MongoDB\Mapping\\');
        $config->setMetadataDriverImpl(new AnnotationDriver($reader, __DIR__ . '/Document'));

        return DocumentManager::create(new Mongo(), $config);
    }
}

