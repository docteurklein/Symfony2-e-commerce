<?php

namespace Bundle\ECommerce\SalesBundle;

use Symfony\Framework\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

use Bundle\ECommerce\SalesBundle\EventSubscriber\OrderEventSubscriber;


class SalesBundle extends Bundle
{
    public function boot()
    {
        parent::boot();

        $em = $this->container->getDoctrine_Orm_EntityManagerService();
        $dm = $this->container->getDoctrine_Odm_Mongodb_DocumentManagerService();

        OrderEventSubscriber::initialize($em, $dm);
    }
}

