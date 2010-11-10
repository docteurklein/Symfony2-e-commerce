<?php

namespace Bundle\ECommerce\CartBundle\DataFixtures\MongoDB;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Bundle\ECommerce\CartBundle\Document\Cart;
use Bundle\ECommerce\CartBundle\Document\CartProduct;
use Bundle\ECommerce\CartBundle\Document\CartProductOption;

use Bundle\ECommerce\ProductBundle\Document\Product;
use Bundle\ECommerce\ProductBundle\DataFixtures\MongoDB\LoadProductData;


class LoadCartData implements FixtureInterface
{
    public function load($manager)
    {
        $cart = $this->buildCart($manager);
        
        $manager->persist($cart);
        $manager->flush();
    }

    public function buildCart(DocumentManager $dm)
    {
        $cart = new Cart;
        
        $product_data = new LoadProductData;
        $product = $product_data->buildProduct($dm);

        $dm->persist($product);
        $dm->flush();

        $cart_product = new CartProduct;
        $cart_product->setProduct($product);

        $option = new CartProductOption;
        $option->setAttribute($product->getAttributes()->get(0));
        $option->setValue('blue');

        $cart_product->addOption($option);

        $cart->addProduct($cart_product);

        return $cart;
    }
}
