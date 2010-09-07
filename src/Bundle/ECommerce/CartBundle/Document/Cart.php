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
 * @Document(db="symfony2_ecommerce", collection="carts")
 */
class Cart
{
    /**
     * @Id
     */
    protected $id;

    /**
     * @String
     */
    protected $payment;

    /**
     * @ReferenceOne(targetDocument="Bundle\ECommerce\CustomerBundle\Document\Customer")
     */
    protected $customer;

    /**
     * @EmbedMany(targetDocument="Bundle\ECommerce\CartBundle\Document\CartProduct")
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

    public function getProducts()
    {
        return $this->cart_products;
    }

    public function addProduct(CartProduct $product) {
        $this->cart_products[] = $product;
    }

    public function removeProduct(CartProduct $product) {
        return $this->cart_products->removeElement($product);
    }
}
