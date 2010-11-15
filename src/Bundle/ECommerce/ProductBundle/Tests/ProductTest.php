<?php

namespace Bundle\ECommerce\ProductBundle\Tests\Document;

use Application\ECommerceBundle\Tests\TestCase\TestCase;

use Bundle\ECommerce\ProductBundle\Document\Product;
use Bundle\ECommerce\ProductBundle\Document\Attribute;
use Bundle\ECommerce\ProductBundle\Document\Option;


class ProductTest extends TestCase
{
    public function testProduct()
    {
        $dm = $this->getDm();
        $this->loadMongoDBDataFixtures();

        $product = $dm->getRepository('Bundle\ECommerce\ProductBundle\Document\Product')->findAll()->getSingleResult();
        
        //$this->assertTrue($product->getSlug() == 'a-super-product');

        $product->setName('a test product');
        //$this->assertTrue($product->getSlug() == 'a-super-product');

        $dm->persist($product);
        $dm->flush();
        //$this->assertTrue($product->getSlug() == 'a-test-product');

        $product_ref = $dm->find('Bundle\ECommerce\ProductBundle\Document\Product', $product->getId());

        $this->assertTrue($product_ref->getAttributes()->get(0)->getOptions()->get(0)->getValue() == 'blue');
    }
}

