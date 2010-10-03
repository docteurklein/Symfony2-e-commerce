<?php

namespace Bundle\ECommerce\CustomerBundle\Document;

/**
 * Country
 * Represents a country
 *
 * @author Klein Florian
 *
 * @Document(db="symfony2_ecommerce", collection="countries")
 */
class Country
{
    /**
     * @Id
     */
    private $id;

    /**
     * @String
     */
    private $name;

    /**
     * @String
     */
    private $iso;

    /**
     * @String
     */
    private $tva;

    public function getId() 
    {
        return $this->id;
    }
    
    public function getName() 
    {
        return $this->name;
    }
    
    public function setName($name) 
    {
        $this->name = $name;
    }

    public function getIso() 
    {
        return $this->iso;
    }
    
    public function setIso($iso) 
    {
        $this->iso = $iso;
    }

    public function getTva() 
    {
        return $this->tva;
    }
    
    public function setTva($tva) 
    {
        $this->tva = $tva;
    }
}

