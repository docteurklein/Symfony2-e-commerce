<?php

namespace Bundle\ECommerce\OrderBundle\Document;

use Bundle\ECommerce\CartBundle\Document\CartProduct;

use Bundle\ECommerce\OrderBundle\Document\OrderProductOption;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * OrderProduct
 *
 * @author Klein Florian
 *
 * @EmbeddedDocument
 */
class OrderProduct
{
    /**
     * @Id
     */
    protected $id;

    /**
     * @EmbedOne(targetDocument="Bundle\ECommerce\CartBundle\Document\CartProduct")
     */
    protected $cart_product;

    /**
     * @EmbedMany(targetDocument="Bundle\ECommerce\OrderBundle\Document\OrderProductOption")
     */
    protected $options = array();

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function setCartProduct(CartProduct $cart_product) {
        $this->cart_product = $cart_product;
    }

    public function getCartProduct() {
        return $this->cart_product;
    }

    public function addOption(OrderProductOption $option)
    {
        if (!$this->hasOption($option)) {
            $this->options[] = $option;
        }

        return $this;
    }

    public function removeOption(OrderProductOption $option)
    {
        return $this->options->removeElement($option);
    }

    public function getOption(OrderProductOption $option)
    {
        $key = array_search($option, $this->options->toArray(), true);
        
        if ($key !== false) {
            return $this->options->get($key);
        }
    }

    public function hasOption(OrderProductOption $option)
    {
        return $this->options->contains($option);
    }

    public function getOptions()
    {
        return $this->options;
    }
}
