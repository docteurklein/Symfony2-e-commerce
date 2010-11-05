<?php

namespace Bundle\ECommerce\SalesBundle\Entity;

use Symfony\Component\Validator\Constraints;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Mapping\ClassMetadata;

use Bundle\ECommerce\ProductBundle\Document\Product;

/**
 * Order
 * Represents an order.
 *
 * @author Klein Florian
 * @orm:Entity
 * @orm:Table(name="sales_order")
 * @orm:HasLifecycleCallbacks
 */
class Order
{
    /**
     * @orm:Id @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @orm:Column(type="string")
     */
    private $product_id;

    /**
     * @var Bundle\ECommerce\ProductBundle\Document\Product;
     */
    private $product;

    public function getId()
    {
        return $this->id;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function setProduct(Product $product)
    {
        $this->product_id = $product->getId();
        $this->product = $product;
    }

    public function getProduct()
    {
        return $this->product;
    }
}

