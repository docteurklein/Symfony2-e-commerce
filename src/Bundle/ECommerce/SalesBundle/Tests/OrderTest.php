<?php

namespace Bundle\ECommerce\SalesBundle\Tests\Entities;

use Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration;

use Doctrine\Common\ClassLoader,
    Doctrine\Common\Annotations\AnnotationReader,
    Doctrine\ODM\MongoDB\DocumentManager,
    Doctrine\ODM\MongoDB\Mongo,
    Doctrine\ODM\MongoDB\Configuration as ODM_Configuration,
    Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;

use Bundle\ECommerce\SalesBundle\Entities\Order;
use Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct;

class OrderTest extends \PHPUnit_Framework_TestCase
{
    public function testOrder()
    {
        $em = $this->getEm();
        $dm = $this->getDm();

        $product = new ConfigurableProduct();
        $product->setName('test');

        $dm->persist($product);
        $dm->flush();

        $order = new Order();
        $order->setProduct($product);

        $em->persist($order);
        $em->flush();

        $order = $em->find('Bundle\ECommerce\SalesBundle\Entities\Order', $order->getId());
        
        $product2 = $dm->find('Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct', $product->getId());

        $product = $order->getProduct();

        $this->assertTrue($product2->getName() == 'test');
        $this->assertTrue($product->getId() == $product2->getId());
    }

    public function getEm()
    {
        $cache = new \Doctrine\Common\Cache\ArrayCache;

        $config = new Configuration;
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver(__DIR__.'/Document');
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);
        $config->setProxyDir(__DIR__.'/ORM/Proxies');
        $config->setProxyNamespace('ORM\Proxies');
        $config->setAutoGenerateProxyClasses(true);

        /*$connectionOptions = array(
            'driver'   => 'pdo_mysql',
            'path'     => '127.0.0.1',
            'dbname'   => 'Symfony2_ecommerce_test',
            'user'     => 'root',
            'password' => ''
        );*/

        $connectionOptions = array(
            'driver' => 'pdo_sqlite',
            'path'   => __DIR__.'Symfony2_ecommerce_test.sqlite',
        );

        return EntityManager::create($connectionOptions, $config);
    }

    public function getDm()
    {
        $config = new ODM_Configuration;
        $config->setProxyDir(__DIR__.'/ODM/Proxies');
        $config->setProxyNamespace('ODM\Proxies');

        $reader = new AnnotationReader();
        $reader->setDefaultAnnotationNamespace('Doctrine\ODM\MongoDB\Mapping\\');
        $config->setMetadataDriverImpl(new AnnotationDriver($reader, __DIR__ . '/Documents'));

        return DocumentManager::create(new Mongo(), $config);
    }
}

