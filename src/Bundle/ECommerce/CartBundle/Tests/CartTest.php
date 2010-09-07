<?php

namespace Bundle\ECommerce\CartBundle\Tests\Document;

use Application\ECommerceBundle\Tests\TestCase\TestCase;

use Bundle\ECommerce\CartBundle\Document\Cart;
use Bundle\ECommerce\CartBundle\Document\CartProduct;
use Bundle\ECommerce\CartBundle\Document\CartProductOption;

use Bundle\ECommerce\ProductBundle\Document\Product;

class CartTest extends TestCase
{
    public function testCart()
    {
        $dm = $this->getDm();

        $cart = $this->buildCart();

        $dm->persist($cart);
        $dm->flush();

        $this->assertTrue( (string) $cart->getProducts()->get(0)->getOptions()->get(0) == 'color: blue');
        $this->assertTrue($cart->getProducts()->get(0)->getOptions()->get(0)->getValue() == 'blue');
    }
}

