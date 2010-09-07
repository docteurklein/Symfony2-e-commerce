<?php

namespace Application\ECommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/")
 * @Cached(expires="tomorrow")
 */
class ECommerceController extends Controller
{
    /**
    * @Route("/:id")
    * @Template("ECommerceBundle:ECommerce:index")
    */
    public function indexAction()
    {
    }
    
    public function dashboardAction()
    {
        return $this->render('ECommerceBundle:ECommerce:dashboard');
    }
}
