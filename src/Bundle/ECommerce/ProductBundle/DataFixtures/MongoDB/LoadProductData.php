<?php

namespace Bundle\ECommerce\ProductBundle\DataFixtures\MongoDB;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Bundle\ECommerce\ProductBundle\Document\Product;
use Bundle\ECommerce\ProductBundle\Document\Option;
use Bundle\ECommerce\ProductBundle\Document\Attribute;


class LoadProductData implements FixtureInterface
{
    public function load($manager)
    {
        $product = $this->buildProduct($manager);
        
        $manager->persist($product);
        $manager->flush();
    }
    
    public function buildProduct(DocumentManager $dm)
    {
        $option = new Option;
        $option->setValue('blue');

        $attribute = new Attribute;
        $attribute->setName('color');
        $attribute->addOption($option);

        $product = new Product;
        $product->addAttribute($attribute);
        $product->setName('a super product');

        return $product;
    }
}
