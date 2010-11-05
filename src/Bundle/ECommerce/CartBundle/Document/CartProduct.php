<?php

namespace Bundle\ECommerce\CartBundle\Document;

use Bundle\ECommerce\ProductBundle\Document\Product;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * CartProduct
 *
 * @author Klein Florian
 *
 * @mongodb:EmbeddedDocument
 */
class CartProduct
{
    /**
     * @mongodb:Id
     */
    protected $id;

    /**
     * @mongodb:ReferenceOne(targetDocument="Bundle\ECommerce\ProductBundle\Document\Product")
     */
    protected $product;

    /**
     * @mongodb:EmbedMany(targetDocument="Bundle\ECommerce\CartBundle\Document\CartProductOption")
     */
    protected $options = array();

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function setProduct(Product $product) {
        $this->product = $product;
    }

    public function getProduct() {
        return $this->product;
    }

    public function addOption(CartProductOption $option)
    {
        if (!$this->hasOption($option)) {
            $this->options[] = $option;
        }

        return $this;
    }

    public function removeOption(CartProductOption $option)
    {
        return $this->options->removeElement($option);
    }

    public function getOption(CartProductOption $option)
    {
        $key = array_search($option, $this->options->toArray(), true);
        
        if ($key !== false) {
            return $this->options->get($key);
        }
    }

    public function hasOption(CartProductOption $option)
    {
        return $this->options->contains($option);
    }

    public function getOptions()
    {
        return $this->options;
    }
}
