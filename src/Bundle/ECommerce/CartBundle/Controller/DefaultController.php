<?php

namespace Bundle\ECommerce\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CartBundle:Default:index.php');
    }
}
