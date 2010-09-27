<?php

namespace Application\ECommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/")
 * @Cached(expires="tomorrow")
 */
class ECommerceController extends Controller
{
    public function indexAction()
    {
        return $this->render('ECommerceBundle:ECommerce:index');
    }
    
    public function dashboardAction()
    {
        return $this->render('ECommerceBundle:ECommerce:dashboard');
    }
}
