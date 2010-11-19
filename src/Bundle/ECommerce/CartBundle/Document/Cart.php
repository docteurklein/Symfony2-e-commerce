<?php

namespace Bundle\ECommerce\CartBundle\Document;

use Bundle\ECommerce\CustomerBundle\Document\Customer;
use Bundle\ECommerce\ProductBundle\Document\Product;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cart
 * Represents a typical cart of a shopping application.
 *
 * @author Klein Florian
 *
 * @mongodb:Document(db="symfony2_ecommerce", collection="carts")
 */
class Cart
{
    /**
     * @mongodb:Id
     */
    protected $id;

    /**
     * @mongodb:String
     */
    protected $payment;

    /**
     * @mongodb:ReferenceOne(targetDocument="Bundle\ECommerce\CustomerBundle\Document\Customer")
     */
    protected $customer;

    /**
     * @mongodb:EmbedMany(targetDocument="Bundle\ECommerce\CartBundle\Document\CartProduct")
     */
    protected $cart_products = array();

    public function __construct()
    {
        $this->cart_products = new ArrayCollection;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getPayment() {
        return $this->payment;
    }
    
    public function setPayment($payment) {
        $this->payment = $payment;
    }
    
    public function setCustomer(Customer $customer) {
        if ($this->customer !== $customer) {
            $this->customer = $customer;
        }
    }
    
    public function removeCustomer() {
        $this->customer = null;
    }
    
    public function getCustomer() {
        return $this->customer;
    }

    public function getCartProducts()
    {
        return $this->cart_products;
    }

    public function addCartProduct(CartProduct $product) {
        $this->cart_products[] = $product;
    }

    public function removeCartProduct(CartProduct $product) {
        return $this->cart_products->removeElement($product);
    }
}
