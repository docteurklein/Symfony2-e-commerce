<?php

namespace Bundle\ECommerce\ProductBundle\Tests\Document;

use Application\ECommerceBundle\Tests\TestCase\TestCase;

use Bundle\ECommerce\ProductBundle\Document\Attribute;

class AttributeTest extends TestCase
{
    public function testAttribute()
    {
        $attribute = new Attribute();
        
        $this->assertTrue($attribute->getName() == null);
    }
}

