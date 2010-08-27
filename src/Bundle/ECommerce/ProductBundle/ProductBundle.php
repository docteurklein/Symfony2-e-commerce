<?php

namespace Bundle\ECommerce\ProductBundle;

use Symfony\Framework\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ProductBundle extends Bundle
{
    public function boot()
    {
        $em = $this->container->getDoctrine_Orm_EntityManagerService();
        $dm = $this->container->getDoctrine_Odm_Mongodb_DocumentManagerService();

        $eventManager = $em->getEventManager();
        $eventManager->addEventListener(
            array(\Doctrine\ORM\Events::postLoad), new ECommerceEventSubscriber($dm)
        );
    }
}

class ECommerceEventSubscriber
{
    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
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

