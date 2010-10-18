<?php

namespace Bundle\ECommerce\ProductBundle\Document;

use Bundle\ECommerce\SalesBundle\Entity\Order;
use Bundle\ECommerce\ProductBundle\Document\Attribute;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Document(db="symfony2_ecommerce", collection="products")
 */
class Product
{
    /**
     * @Id
     */
    protected $id;

    /**
     * @String
     */
    protected $sku;

    /**
     * @String
     */
    protected $name;

    /**
     * @var array|ArrayCollection
     * @EmbedMany(targetDocument="Bundle\ECommerce\ProductBundle\Document\Attribute")
     */
    protected $attributes = array();

    /**
     * @var Array a collection of Bundle\ECommerce\SalesBundle\Entity\Order;
     */
    protected $orders = array();

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
    }

    public function  __toString()
    {
        return (string) $this->getName();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSKU()
    {
        return $this->sku;
    }

    public function setSKU($sku)
    {
        $this->sku = (string) $sku;
        return $this;
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

    public function getOrders()
    {
        return $this->orders;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function addAttribute(Attribute $attribute)
    {
        if (!$this->hasAttribute($attribute)) {
            $this->attributes[] = $attribute;
        }

        return $this;
    }

    public function removeAttribute(Attribute $attribute)
    {
        return $this->attributes->removeElement($attribute);
    }

    public function getAttribute(Attribute $attribute)
    {
        $key = array_search($attribute, $this->attributes->toArray(), true);
        
        if ($key !== false) {
            return $this->attributes->get($key);
        }
    }

    public function hasAttribute(Attribute $attribute)
    {
        return $this->attributes->contains($attribute);
    }
}

