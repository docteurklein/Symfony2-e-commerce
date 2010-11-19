<?php

namespace Bundle\ECommerce\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Bundle\ECommerce\ProductBundle\Document\Product;

class ProductController extends Controller
{
    public function indexAction()
    {
        $products = $this->get('ecommerce.repository.product')->find();
        return $this->render('ProductBundle:Product:index.php', array('products' => $products));
    }

    public function showAction($slug)
    {
        $product = $this->get('ecommerce.repository.product')->findOneBySlug($slug);

        if( ! $product) {
            throw new NotFoundHttpException('The product does not exist.');
        }

        return $this->render('ProductBundle:Product:show.php', array('product' => $product));
    }
}

