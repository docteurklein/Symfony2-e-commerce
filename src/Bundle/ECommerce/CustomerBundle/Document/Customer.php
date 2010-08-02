<?php

namespace Bundle\ECommerce\CustomerBundle\Entities;

use Bundle\ECommerce\CartBundle\Entities\Cart;

/**
 * Customer
 * Represents a registered user of a shopping application.
 *
 * @author Klein Florian
 * @Entity
 * @Table(name="customer")
 */
class Customer
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Column(type="string", length=50)
     */
    private $name;

    /**
     * @OneToOne(targetEntity="Bundle\ECommerce\CartBundle\Entities\Cart", mappedBy="customer", cascade={"persist"})
     */
    private $cart;

    /**
     * Example of a one-one self referential association. A mentor can follow
     * only one customer at the time, while a customer can choose only one
     * mentor. Not properly appropriate but it works.
     * 
     * @OneToOne(targetEntity="Customer", cascade={"persist"})
     * @JoinColumn(name="mentor_id", referencedColumnName="id")
     */
    private $mentor;
    
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
        if ($this->cart !== $cart) {
            $this->cart = $cart;
            $cart->setCustomer($this);   
        }
    }
    
    public function getCart() {
        return $this->cart;
    }

    public function removeCart()
    {
        if ($this->cart !== null) {
            $cart = $this->cart;
            $this->cart = null;
            $cart->removeCustomer();
        }
    }

    public function setMentor(Customer $mentor)
    {
        $this->mentor = $mentor;
    }

    public function removeMentor()
    {
        $this->mentor = null;
    }

    public function getMentor()
    {
        return $this->mentor;
    }
}
