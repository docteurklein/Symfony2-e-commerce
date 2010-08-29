<?php

namespace Bundle\ECommerce\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct;

class ProductController extends Controller
{
    public function indexAction()
    {
        $dm = $this->container->getDoctrine_Odm_Mongodb_DocumentManagerService();
        
        $products = $dm->find('Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct');
        return $this->render('ProductBundle:Product:index', array('products' => $products));
    }

    public function showAction($id)
    {
        $dm = $this->container->getDoctrine_Odm_Mongodb_DocumentManagerService();
        
        $product = $dm->find('Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct', $id);

        if( ! $product) {
            throw new NotFoundHttpException('The product does not exist.');
        }

        return $this->render('ProductBundle:Product:show', array('product' => $product));
    }
}

