<?php

namespace Bundle\ECommerce\CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CustomerBundle:Default:index');
    }
}
