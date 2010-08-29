<?php

namespace Bundle\ECommerce\SalesBundle\EventSubscriber;

use Doctrine\ORM\EntityManager;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
* OrderEventSubscriber is used to set the $product property of all Order instances to a reference to the ConfigurableProduct document 
*/
class OrderEventSubscriber
{
    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    public static function initialize(EntityManager $em, DocumentManager $dm)
    {
        $eventManager = $em->getEventManager();
        $eventManager->addEventListener(
            array(\Doctrine\ORM\Events::postLoad), new self($dm)
        );
    }

    public function postLoad(LifecycleEventArgs $event_args)
    {
        $entity = $event_args->getEntity();
        $em = $event_args->getEntityManager();
        
        $reflection_property = $em->getClassMetadata('Bundle\ECommerce\SalesBundle\Entities\Order')->reflClass->getProperty('product');

        $reflection_property->setAccessible(true);
        $reflection_property->setValue(
            $entity, 
            $this->dm->getReference('Bundle\ECommerce\ProductBundle\Document\ConfigurableProduct', $entity->getProductId())
        );
    }
}

