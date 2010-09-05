<?php

namespace Bundle\ECommerce\ProductBundle\Tests\Document;

use Application\ECommerceBundle\Tests\TestCase\TestCase;

use Bundle\ECommerce\ProductBundle\Document\Product;
use Bundle\ECommerce\ProductBundle\Document\Category;

class CategoryTest extends TestCase
{
    public function testCategory()
    {
        $dm = $this->getDm();

        $dm->query('remove Bundle\ECommerce\ProductBundle\Document\Category')->execute();

        $product = new Product();
        $product->setName('categorized product');
        $dm->persist($product);

        $category = new Category;
        $category->addProduct($product);

        $dm->persist($category);
        $dm->flush();
        
        $product_ref = $dm->find('Bundle\ECommerce\ProductBundle\Document\Product', $product->getId());

        $this->assertTrue($category->hasProduct($product_ref));
        $this->assertTrue($category->getProduct($product_ref)->getName() == 'categorized product');
    }
}

