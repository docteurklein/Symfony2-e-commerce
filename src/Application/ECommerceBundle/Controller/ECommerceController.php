<?php

namespace Application\ECommerceBundle\Controller;

use Symfony\Component\Security\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/")
 * @Cached(expires="tomorrow")
 */
class ECommerceController extends Controller
{
    public function indexAction()
    {
        return $this->render('ECommerceBundle:ECommerce:index.php');
    }
    
    public function dashboardAction()
    {
        return $this->render('ECommerceBundle:ECommerce:dashboard.php');
    }

    public function notFoundAction()
    {
        return $this->render('ECommerceBundle:ECommerce:notFound.php');
    }
    
    public function loginAction()
    {
        // get the error if any (works with forward and redirect -- see below)
        if ($this['request']->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $this['request']->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $this['request']->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('ECommerceBundle:ECommerce:login.php', array(
            // last username entered by the user
            'last_username' => $this['request']->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }
}
