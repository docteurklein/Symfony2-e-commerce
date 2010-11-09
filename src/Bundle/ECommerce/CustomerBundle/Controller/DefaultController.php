<?php

namespace Bundle\ECommerce\CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Bundle\ECommerce\CustomerBundle\Document\Customer;


class DefaultController extends Controller
{
    public function indexAction()
    {
        $dm = $this['doctrine.odm.mongodb.documentManager'];

        $customers = $dm->find('Bundle\ECommerce\CustomerBundle\Document\Customer');
        return $this->render('CustomerBundle:Default:index.php', array('customers' => $customers));
    }
    
    public function showAction($id)
    {
        $dm = $this['doctrine.odm.mongodb.documentManager'];
        
        $customer = $dm->getRepository('Bundle\ECommerce\CustomerBundle\Document\Customer')->find($id);

        if( ! $customer) {
            throw new NotFoundHttpException('The customer does not exist.');
        }

        return $this->render('ContactBundle:Default:show.php', array('customer' => $customer));
    }
}
