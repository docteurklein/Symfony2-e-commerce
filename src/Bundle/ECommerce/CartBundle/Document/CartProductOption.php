<?php

namespace Bundle\ECommerce\CartBundle\Document;

use Bundle\ECommerce\ProductBundle\Document\Attribute;

/**
 * CartProductOption
 *
 * @author Klein Florian
 *
 * @EmbeddedDocument
 */
class CartProductOption
{
    /**
     * @Id
     */
    protected $id;

    /**
     * @String
     */
    protected $value;

    /**
     * @EmbedOne(targetDocument="Bundle\ECommerce\ProductBundle\Document\Attribute")
     */
    protected $attribute;

    public function  __toString()
    {
        return sprintf('%s: %s', $this->getAttribute(), $this->getValue());
    }

    public function getId() {
        return $this->id;
    }
    
    public function getAttribute() {
        return $this->attribute;
    }

    public function setAttribute(Attribute $attribute) {
        $this->attribute = $attribute;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
    }
}

