<?php

namespace Application\ECommerceBundle\Tests\TestCase;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestCase extends WebTestCase
{
    public function getKernel(array $options = array())
    {
        if( ! $this->kernel) {
            $this->kernel = $this->createKernel($options);
            $this->kernel->boot();
        }

        return $this->kernel;
    }

    public function getEm()
    {
        $kernel = $this->getKernel();

        return $kernel->getContainer()->getDoctrine_Orm_DefaultEntityManagerService();
    }

    public function getDm()
    {
        $kernel = $this->getKernel();

        return $kernel->getContainer()->getDoctrine_Odm_Mongodb_DefaultDocumentManagerService();
    }

    public function buildProduct()
    {
        $dm = $this->getDm();

        $dm->query('remove Bundle\ECommerce\ProductBundle\Document\Option')->execute();
        $dm->query('remove Bundle\ECommerce\ProductBundle\Document\Attribute')->execute();
        $dm->query('remove Bundle\ECommerce\ProductBundle\Document\Product')->execute();

        $option = new \Bundle\ECommerce\ProductBundle\Document\Option;
        $option->setValue('blue');

        $attribute = new \Bundle\ECommerce\ProductBundle\Document\Attribute();
        $attribute->setName('color');
        $attribute->addOption($option);

        $product = new \Bundle\ECommerce\ProductBundle\Document\Product();
        $product->addAttribute($attribute);

        return $product;
    }

    public function buildCart()
    {
        $dm = $this->getDm();

        $cart = new \Bundle\ECommerce\CartBundle\Document\Cart;

        $product = $this->buildProduct();

        $dm->persist($product);
        $dm->flush();

        $cart_product = new \Bundle\ECommerce\CartBundle\Document\CartProduct;
        $cart_product->setProduct($product);

        $option = new \Bundle\ECommerce\CartBundle\Document\CartProductOption;
        $option->setAttribute($product->getAttributes()->get(0));
        $option->setValue('blue');

        $cart_product->addOption($option);

        $cart->addProduct($cart_product);

        return $cart;
    }
}

