<?php

namespace Bundle\ECommerce\CustomerBundle\Document;

use Bundle\ECommerce\CustomerBundle\Document\Country;


/**
 * Address
 * Represents a shipping/payment address.
 *
 * @author Klein Florian
 *
 * @EmbeddedDocument
 */
class Address
{
    /**
     * @Id
     */
    private $id;

    /**
     * @String
     */
    private $address;

    /**
     * @String
     */
    private $city;

    /**
     * @EmbedOne(targetDocument="Bundle\ECommerce\CustomerBundle\Document\Country")
     */
    private $country;

    public function getId() 
    {
        return $this->id;
    }
    
    public function getAddress() 
    {
        return $this->address;
    }
    
    public function setAddress($address) 
    {
        $this->address = $address;
    }

    public function getCity() 
    {
        return $this->city;
    }
    
    public function setCity($city) 
    {
        $this->city = $city;
    }

    public function getCountry() 
    {
        return $this->country;
    }
    
    public function setCountry(Country $country) 
    {
        $this->country = $country;
    }
}

