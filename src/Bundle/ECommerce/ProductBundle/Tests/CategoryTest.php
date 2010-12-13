<?php

namespace Bundle\ECommerce\ProductBundle\Tests\Document;

use Application\ECommerceBundle\Tests\TestCase\TestCase;

use Bundle\ECommerce\ProductBundle\Document\Product;
use Bundle\ECommerce\ProductBundle\Document\Category;

class CategoryTest extends TestCase
{
    public function testCategory()
    {
        $this->loadMongoDBDataFixtures();

        $category = $this->getKernel()->getContainer()->get('ecommerce.repository.category')->findOneBySlug('category-23');
        $this->assertTrue($category->getLevel() === 3);

        $product = $this->getKernel()->getContainer()->get('ecommerce.repository.product')->findOneBySlug('a-super-product-n-20');
        var_dump((string)$product);
        var_dump((string)$category->getProducts()->get(0));

        $this->assertTrue($category->hasProduct($product));
        $this->assertTrue($category->getProduct($product)->getName() == 'a super product n°20');
    }
}

