<?php

namespace Bundle\ECommerce\ProductBundle\DataFixtures\MongoDB;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Collections\ArrayCollection;

use Bundle\ECommerce\ProductBundle\Document\Product;
use Bundle\ECommerce\ProductBundle\Document\Option;
use Bundle\ECommerce\ProductBundle\Document\Attribute;


class LoadProductData implements FixtureInterface
{
    public function load($manager)
    {
        return $this->buildProducts($manager);
    }
    
    public function getProducts()
    {
        $products = array();
        for($i = 1; $i <= 200; $i++)
        {
            $product = new Product;
            $product->setAttributes($this->getAttributes());
            $product->setName('a super product '.$i);
            $products[] = $product;
        }

        return $products;
    }

    public function buildProducts(DocumentManager $dm)
    {
        foreach($this->getProducts($dm) as $product)
        {
            $dm->persist($product);
        }
        $dm->flush();
    }

    protected function getAttributes()
    {
        $attributes = new ArrayCollection;
        for($i = 1; $i < 5; $i++)
        {
            $attribute = new Attribute;
            $attribute->setName('color '.$i);
            $attribute->setOptions($this->getOptions());

            $attributes[] = $attribute;
        }
        
        return $attributes;
    }

    protected function getOptions()
    {
        $options = new ArrayCollection;
        for($i = 0; $i < 4; $i++)
        {
            $choices = array('green', 'yellow', 'red', 'gold');
            $option = new Option;
            $option->setValue($choices[$i]);

            $options[] = $option;
        }

        return $options;
    }
}
