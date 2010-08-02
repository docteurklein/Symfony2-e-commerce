<?php

namespace Bundle\ECommerce\CartBundle\Entities;

use Bundle\ECommerce\CustomerBundle\Entities\Customer;
use Bundle\ECommerce\ProductBundle\Entities\Product;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cart
 * Represents a typical cart of a shopping application.
 *
 * @author Klein Florian
 * @Entity
 * @Table(name="cart")
 */
class Cart
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(length=50, nullable=true)
     */
    private $payment;

    /**
     * @OneToOne(targetEntity="Bundle\ECommerce\CustomerBundle\Entities\Customer", inversedBy="cart")
     * @JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

    /**
     * @ManyToMany(targetEntity="Bundle\ECommerce\ProductBundle\Entities\Product", cascade={"persist"})
     * @JoinTable(name="cart_product",
            joinColumns={@JoinColumn(name="cart_id", referencedColumnName="id")},
            inverseJoinColumns={@JoinColumn(name="product_id", referencedColumnName="id")})
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection;
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
    
    public function setCustomer(ECommerceCustomer $customer) {
        if ($this->customer !== $customer) {
            $this->customer = $customer;
            $customer->setCart($this);
        }
    }
    
    public function removeCustomer() {
        if ($this->customer !== null) {
            $customer = $this->customer;
            $this->customer = null;
            $customer->removeCart();
        }
    }
    
    public function getCustomer() {
        return $this->customer;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function addProduct(ECommerceProduct $product) {
        $this->products[] = $product;
    }

    public function removeProduct(ECommerceProduct $product) {
        return $this->products->removeElement($product);
    }
}
