<?php

namespace Application\ECommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ECommerceController extends Controller
{
    /**
    * @Security(true)
    */
    public function indexAction()
    {
        return $this->render('ECommerceBundle:ECommerce:index');
    }
    
    public function dashboardAction()
    {
        return $this->render('ECommerceBundle:ECommerce:dashboard');
    }
}
