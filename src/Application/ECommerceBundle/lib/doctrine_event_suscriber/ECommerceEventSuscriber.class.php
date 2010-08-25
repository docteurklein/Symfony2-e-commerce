<?php

namespace Application\ECommerceBundle\lib\doctrine_event_suscriber;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ECommerceEventSubscriber
{
    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    public function postLoad(LifecycleEventArgs $event_args)
    {
        $entity = $eventArgs->getEntity();
        $em = $event_args->getEntityManager();
        
        $reflection_property = $em->getClassMetadata('Bundle\ECommerce\SalesBundle\Entities\Order')->reflClass->getProperty('product');
        
        $reflection_property->setAccessible(true);
        $reflection_property->setValue(
            $entity, 
            $this->dm->getReference('Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct', $entity->getProductId())
        );
    }
}

