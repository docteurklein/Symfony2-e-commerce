<?php

namespace Bundle\ECommerce\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Bundle\ECommerce\ProductBundle\Document\Product;

class ProductController extends Controller
{
    public function indexAction()
    {
        $dm = $this->container->getDoctrine_Odm_Mongodb_DocumentManagerService();
        
        $products = $dm->find('Bundle\ECommerce\ProductBundle\Document\Product');
        return $this->render('ProductBundle:Product:index.php', array('products' => $products));
    }

    public function showAction($id)
    {
        $dm = $this->container->getDoctrine_Odm_Mongodb_DocumentManagerService();
        
        $product = $dm->getRepository('Bundle\ECommerce\ProductBundle\Document\Product')->find($id);

        if( ! $product) {
            throw new NotFoundHttpException('The product does not exist.');
        }

        return $this->render('ProductBundle:Product:show.php', array('product' => $product));
    }
}

