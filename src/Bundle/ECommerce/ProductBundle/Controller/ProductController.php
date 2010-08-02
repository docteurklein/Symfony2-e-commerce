<?php

namespace Bundle\ECommerce\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller;

use Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct;

class ProductController extends Controller
{
    public function indexAction()
    {
        $dm = $this->container->getDoctrine_Odm_Mongodb_DocumentManagerService();
        
        new ConfigurableProduct('test');
        $products = $dm->find('Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct');
        return $this->render('ProductBundle:Product:index', array('products' => $products));
    }
}
