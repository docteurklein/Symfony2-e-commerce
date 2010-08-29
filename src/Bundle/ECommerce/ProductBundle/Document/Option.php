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
     * @EmbedOne(targetDocument="Bundle\ECommerce\ProductBundle\Document\Money")
     * @var float
     */
    protected $money;

    /**
     * @ReferenceOne(targetDocument="Bundle\ECommerce\ProductBundle\Document\StockItem", cascade="all")
     * @var Documents\StockItem
     */
    protected $stockItem;

    /**
     * @param string $name
     * @param float $price
     * @param StockItem $stockItem
     */
    public function __construct($name, Money $money, StockItem $stockItem)
    {
        $this->name = (string) $name;
        if (empty($this->name)) {
            throw new \InvalidArgumentException('option name cannot be empty');
        }
        $this->money = $money;
        if (empty($this->money)) {
            throw new \InvalidArgumentException('option price cannot be empty');
        }
        $this->stockItem = $stockItem;
    }

    public function  __toString()
    {
        return (string) $this->getName();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice($object = false)
    {
        if (true === $object) {
            return $this->money;
        }
        return $this->money->getAmount();
    }

    /**
     * @return StockItem
     */
    public function getStockItem()
    {
        return $this->stockItem;
    }
}

