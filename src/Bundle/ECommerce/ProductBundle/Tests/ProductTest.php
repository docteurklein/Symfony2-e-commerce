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
        $dm->query('remove Bundle\ECommerce\ProductBundle\Document\Option')->execute();
        $dm->query('remove Bundle\ECommerce\ProductBundle\Document\Attribute')->execute();
        $dm->query('remove Bundle\ECommerce\ProductBundle\Document\Product')->execute();

        $option = new Option;
        $option->setValue('blue');

        $attribute = new Attribute();
        $attribute->setName('color');
        $attribute->addOption($option);

        $product = new Product();
        $product->addAttribute($attribute);

        $dm->persist($product);
        $dm->flush();

        $product_ref = $dm->find('Bundle\ECommerce\ProductBundle\Document\Product', $product->getId());

        $this->assertTrue($product_ref->hasAttribute($attribute));

        $this->assertTrue($product_ref->getAttributes()->get(0)->getOptions()->get(0)->getValue() == 'blue');
    }
}

