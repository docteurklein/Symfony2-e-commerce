<?php

namespace Bundle\ECommerce\CartBundle\Controller;

use Bundle\ECommerce\ProductBundle\Document\Product;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CartController extends Controller
{
    public function indexAction()
    {
        return $this->render('CartBundle:Default:index.php');
    }

    public function addAction(Product $product)
    {
        return $this->render('CartBundle:Cart:show.php', array('product' => $product));
    }
}
