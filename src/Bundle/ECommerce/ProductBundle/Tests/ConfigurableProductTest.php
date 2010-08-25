<?php

namespace Bundle\ECommerce\ProductBundle\Tests\Document;

use Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct;

class ConfigurableProductTest extends \PHPUnit_Framework_TestCase
{
    public function testOrder()
    {
        $product = new ConfigurableProduct();
        
        $this->assertTrue($product->getName() == null);
    }
}

