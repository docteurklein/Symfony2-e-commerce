<?php

namespace Bundle\ECommerce\SalesBundle\Document;

use Symfony\Component\Validator\Constraints;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Mapping\ClassMetadata;

use Bundle\ECommerce\CartBundle\Document\Cart;
use Bundle\ECommerce\CustomerBundle\Document\Address;

/**
 * Order
 * Represents an order.
 *
 * @author Klein Florian
 *
 * @Document(db="symfony2_ecommerce", collection="orders")
 */
class Order
{
    /**
     * @Id
     */
    private $id;

    /**
     * @EmbedOne(targetDocument="Bundle\ECommerce\CartBundle\Document\Cart")
     */
    protected $cart;

    /**
     * @ReferenceOne(targetDocument="Bundle\ECommerce\CustomerBundle\Document\Customer")
     */
    protected $customer;

    /**
     * @EmbedOne(targetDocument="Bundle\ECommerce\CustomerBundle\Document\Address")
     */
    protected $shipping_address;

    /**
     * @EmbedOne(targetDocument="Bundle\ECommerce\CustomerBundle\Document\Address")
     */
    protected $payment_address;

    public function getId()
    {
        return $this->id;
    }

    public function getCart()
    {
        return $this->cart;
    }

    public function setCart(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function getPaymentAddress()
    {
        return $this->payment_address;
    }

    public function setPaymentAddress(Address $address)
    {
        $this->payment_address = $address;
    }

    public function getShippingAddress()
    {
        return $this->shipping_address;
    }

    public function setShippingAddress(Address $address)
    {
        $this->shipping_address = $address;
    }
}

