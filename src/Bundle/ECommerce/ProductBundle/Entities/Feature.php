<?php

namespace Bundle\ECommerce\ProductBundle\Entities;

use Bundle\ECommerce\ProductBundle\Entities\Product;

use Symfony\Components\Validator\Constraints;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Components\Validator\Mapping\ClassMetadata;

/**
 * Describes a product feature.
 *
 * @author Klein Florian
 * @Entity
 * @Table(name="feature")
 */
class Feature
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(length=50)
     */
    private $description;

    /**
     * @ManyToOne(targetEntity="Product", inversedBy="features")
     * @JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    public function getId() {
        return $this->id;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function setDescription($description) {
        $this->description = $description;
    }
    
    public function setProduct(Product $product) {
        $this->product = $product;
    }
    
    public function removeProduct() {
        if ($this->product !== null) {
            $product = $this->product;
            $this->product = null;
            $product->removeFeature($this);
        }
    }
    
    public function getProduct() {
        return $this->product;
    }
}
