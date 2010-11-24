<?php

namespace Bundle\ECommerce\ProductBundle\DataFixtures\MongoDB;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Collections\ArrayCollection;

use Bundle\ECommerce\ProductBundle\Document\Category;
use Bundle\ECommerce\ProductBundle\Document\Product;
use Bundle\ECommerce\ProductBundle\Document\Option;
use Bundle\ECommerce\ProductBundle\Document\Attribute;


class LoadProductData implements FixtureInterface
{
    public function load($manager)
    {
        $this->buildProducts($manager);
    }
    
    public function getProducts()
    {
        $products = array();
        for($i = 1; $i <= 20; $i++)
        {
            $product = new Product;
            $product->setAttributes($this->getAttributes());
            $product->setName(sprintf('a super product n°%d', $i));
            $products[] = $product;
        }

        return $products;
    }

    public function buildProducts(DocumentManager $dm)
    {
        foreach($this->getCategories() as $category)
        {
            foreach($this->getProducts($dm) as $product)
            {
                $dm->persist($product);
            }

            $category->addProduct($product);
            $dm->persist($category);

            $dm->flush();
        }
    }

    protected function getCategories()
    {
        $categories = new ArrayCollection;
        for($i = 1; $i < 15; $i++)
        {
            $category = new Category;
            $category->setName('Category '.$i);

            $categories[] = $category;
        }

        return $categories;
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
