<?php

namespace Application\ECommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller;

class DefaultController extends Controller
{
  public function headerAction()
  {
    $response = $this->render('ECommerceBundle::header', array());
    $response->setTtl(10);
    return $response;
  }
  /**
   * Footer block
   */
  public function footerAction()
  {
    $response = $this->render('ECommerceBundle::footer', array());
    $response->setTtl(10);
    return $response;
  }
}
