<?php

namespace ORM\Proxies;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class BundleECommerceSalesBundleEntitiesOrderProxy extends \Bundle\ECommerce\SalesBundle\Entities\Order implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    private function _load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    
    public function getId()
    {
        $this->_load();
        return parent::getId();
    }

    public function getProductId()
    {
        $this->_load();
        return parent::getProductId();
    }

    public function setProduct(\Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct $product)
    {
        $this->_load();
        return parent::setProduct($product);
    }

    public function getProduct()
    {
        $this->_load();
        return parent::getProduct();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'product_id');
    }
}