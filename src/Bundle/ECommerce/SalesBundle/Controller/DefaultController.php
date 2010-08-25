<?php

namespace Bundle\ECommerce\SalesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SalesBundle:Default:index');
    }
}
