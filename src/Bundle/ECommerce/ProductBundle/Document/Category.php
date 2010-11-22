<?php

namespace Bundle\ECommerce\ProductBundle\Document;

use Bundle\ECommerce\ProductBundle\Document\Product;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @mongodb:Document(collection="categories")
 */
class Category
{
    /**
     * @mongodb:Id
     */
    protected $id;

    /**
     * @mongodb:String
     * @gedmo:Sluggable
     */
    protected $name;

    /**
     * @mongodb:String
     * @gedmo:Slug(unique=false)
     */
    protected $slug;

    /**
     * @mongodb:ReferenceMany(targetDocument="Bundle\ECommerce\ProductBundle\Document\Product")
     */
    protected $products = array();

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function  __toString()
    {
        return (string) $this->getName();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function addProduct(Product $product)
    {
        if (!$this->hasProduct($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product)
    {
        return $this->products->removeElement($product);
    }

    public function getProduct(Product $product)
    {
        $key = array_search($product, $this->products->toArray(), true);
        
        if ($key !== false) {
            return $this->products->get($key);
        }
    }

    public function hasProduct(Product $product)
    {
        return $this->products->contains($product);
    }
}

