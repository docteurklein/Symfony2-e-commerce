<?php

namespace Application\ECommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller;

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
