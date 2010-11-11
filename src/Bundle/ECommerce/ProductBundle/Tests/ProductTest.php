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

        $product = $this->buildProduct();

        $dm->persist($product);
        $dm->flush();

        $product_ref = $dm->find('Bundle\ECommerce\ProductBundle\Document\Product', $product->getId());

        $this->assertTrue($product_ref->getAttributes()->get(0)->getOptions()->get(0)->getValue() == 'blue');
    }
}

