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
        foreach($products = $product_data->getProducts() as $product)
        {
            $cart_product = new CartProduct;
            $cart_product->setProduct($product);

            foreach($product->getAttributes() as $attribute)
            {
                $option = new CartProductOption;
                $option->setAttribute($attribute);
                $choices = $attribute->getOptions();
                $option->setValue($choices[2]);

                $cart_product->addOption($option);
            }

            $cart->addCartProduct($cart_product);
        }
        return $cart;
    }
}
