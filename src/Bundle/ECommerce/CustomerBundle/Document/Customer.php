<?php

namespace Bundle\ECommerce\CustomerBundle\Document;


/**
 * Customer
 * Represents a registered user of a shopping application.
 *
 * @author Klein Florian
 *
 * @mongodb:Document(db="symfony2_ecommerce", collection="customers")
 */
class Customer
{
    /**
     * @mongodb:Id
     */
    private $id;

    /**
     * @mongodb:String
     */
    private $name;

    /**
     * @mongodb:ReferenceMany(targetDocument="Bundle\ECommerce\CartBundle\Document\Cart")
     */
    private $cart;

    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }

    public function setCart(Cart $cart)
    {
        $this->cart = $cart;
    }
    
    public function getCart() {
        return $this->cart;
    }

    public function removeCart()
    {
        $this->cart = null;
    }
}
