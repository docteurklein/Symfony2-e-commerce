<?php

namespace Bundle\ECommerce\SalesBundle\Tests\Entity;

use Application\ECommerceBundle\Tests\TestCase\TestCase;

use Bundle\ECommerce\SalesBundle\EventSubscriber\MappedORMEventSubscriber;
use Bundle\ECommerce\SalesBundle\EventSubscriber\MappedODMEventSubscriber;

use Bundle\ECommerce\SalesBundle\Entity\Order;
use Bundle\ECommerce\ProductBundle\Document\Product;


class OrderTest extends TestCase
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
                    'document' => 'Bundle\ECommerce\ProductBundle\Document\Product',
                    'property' => 'product',
                    'pkeyGetter' => 'getProductId',
                    'type' => 'one'
                )
            )
        ));

        MappedODMEventSubscriber::initialize($em, $dm, array(
            array(
                'events' => \Doctrine\ODM\MongoDB\Events::postLoad,
                'mapping' => array(
                    'document' => 'Bundle\ECommerce\ProductBundle\Document\Product',
                    'entity' => 'Bundle\ECommerce\SalesBundle\Entity\Order',
                    'property' => 'orders',
                    'pkeyGetter' => 'getId',
                    'fkey' => 'product_id',
                    'type' => 'many'
                )
            )
        ));

        $product = new Product();
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
        $product_ref = $dm->find('Bundle\ECommerce\ProductBundle\Document\Product', $product->getId());
        
        // get product from mongodb with a postLoad MappedORMEventListener
        $_product = $order_ref->getProduct();

        $this->assertTrue($product_ref->getName() == 'test');
        $this->assertTrue($_product->getName() == 'test');
        $this->assertTrue($_product->getId() == $product_ref->getId());

        $orders = $_product->getOrders();
        $this->assertTrue(count($orders) > 0);
        $this->assertTrue($orders[0]->getProduct() == $order_ref->getProduct());
    }
}

