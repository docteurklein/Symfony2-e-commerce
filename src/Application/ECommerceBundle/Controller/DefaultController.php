<?php

namespace Application\ECommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Security\SecurityContext;

class DefaultController extends Controller
{
    public function headerAction()
    {
        $response = $this->render('ECommerceBundle::header.php', array());
        $response->setTtl(10);
        return $response;
    }
    /**
     * Footer block
     */
    public function footerAction()
    {
        $response = $this->render('ECommerceBundle::footer.php', array());
        $response->setTtl(10);
        return $response;
    }
}
