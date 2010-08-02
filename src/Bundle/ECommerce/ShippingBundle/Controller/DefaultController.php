<?php

namespace Bundle\ECommerce\ShippingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ShippingBundle:Default:index');
    }
}
