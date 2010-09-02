<?php

namespace Bundle\ECommerce\SalesBundle;

use Symfony\Framework\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

use Bundle\ECommerce\SalesBundle\EventSubscriber\MappedORMEventSubscriber;
use Bundle\ECommerce\SalesBundle\EventSubscriber\MappedODMEventSubscriber;


class SalesBundle extends Bundle
{
    public function boot()
    {
        parent::boot();

        $em = $this->container->getDoctrine_Orm_EntityManagerService();
        $dm = $this->container->getDoctrine_Odm_Mongodb_DocumentManagerService();

        MappedORMEventSubscriber::initialize($em, $dm, array(
            array(
                'events' => \Doctrine\ORM\Events::postLoad,
                'mapping' => array(
                    'entity' => 'Bundle\ECommerce\SalesBundle\Entity\Order',
                    'document' => 'Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct',
                    'property' => 'product',
                    'pkeyGetter' => 'getProductId',
                    'type' => 'one'
                )
            )
        ));

        MappedODMEventSubscriber::initialize($em, $dm, array(
            array(
                'events' => \Doctrine\ODM\MongoDB\ODMEvents::postLoad,
                'mapping' => array(
                    'document' => 'Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct',
                    'entity' => 'Bundle\ECommerce\SalesBundle\Entity\Order',
                    'property' => 'orders',
                    'pkeyGetter' => 'getId',
                    'fkey' => 'product_id',
                    'type' => 'many'
                )
            )
        ));
    }
}

