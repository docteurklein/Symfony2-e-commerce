<?php

namespace Bundle\ECommerce\ProductBundle\Document;

/**
 * @Document(db="symfony2_ecommerce", collection="options")
 */
class Option
{
    /**
     * @Id
     */
    protected $id;

    /**
     * @String
     * @var string
     */
    protected $name;

    /**
     * @String
     * @var string
     */
    protected $value;

    public function  __toString()
    {
        return (string) $this->getValue();
    }
    
    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return Option $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}

