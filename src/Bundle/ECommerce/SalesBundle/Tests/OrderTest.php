<?php

namespace Bundle\ECommerce\SalesBundle\Tests\Entity;

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

use Bundle\ECommerce\SalesBundle\EventSubscriber\MappedORMEventSubscriber;
use Bundle\ECommerce\SalesBundle\EventSubscriber\MappedODMEventSubscriber;

use Bundle\ECommerce\SalesBundle\Entity\Order;
use Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct;


class OrderTest extends \PHPUnit_Framework_TestCase
{
    public function testOrder()
    {
        $em = $this->getEm();
        $dm = $this->getDm();

        MappedORMEventSubscriber::initialize($em, $dm, array(
            array(
                'events' => \Doctrine\ORM\Events::postLoad,
                'mapping' => array(
                    'entity' => 'Bundle\ECommerce\SalesBundle\Entity\Order',
                    'document' => 'Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct',
                    'property' => 'product',
                    'pkeyGetter' => 'getProductId',
                    'type' => 'one'
                )
            )
        ));

        MappedODMEventSubscriber::initialize($em, $dm, array(
            array(
                'events' => \Doctrine\ODM\MongoDB\ODMEvents::postLoad,
                'mapping' => array(
                    'document' => 'Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct',
                    'entity' => 'Bundle\ECommerce\SalesBundle\Entity\Order',
                    'property' => 'orders',
                    'pkeyGetter' => 'getId',
                    'fkey' => 'product_id',
                    'type' => 'many'
                )
            )
        ));

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
        $order_ref = $em->find('Bundle\ECommerce\SalesBundle\Entity\Order', $order->getId());
        
        // get reference product directly from mongodb
        $product_ref = $dm->find('Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct', $product->getId());
        
        // get product from mongodb with a postLoad MappedORMEventListener
        $_product = $order_ref->getProduct();

        $this->assertTrue($product_ref->getName() == 'test');
        $this->assertTrue($_product->getName() == 'test');
        $this->assertTrue($_product->getId() == $product_ref->getId());

        $orders = $_product->getOrders();
        $this->assertTrue(count($orders) > 0);
        $this->assertTrue($orders[0]->getProduct() == $order_ref->getProduct());
    }

    public function getEm()
    {
        $cache = new \Doctrine\Common\Cache\ArrayCache;

        $config = new Configuration;
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver(__DIR__.'/Entity');
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

