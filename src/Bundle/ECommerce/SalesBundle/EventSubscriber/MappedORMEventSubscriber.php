<?php

namespace Bundle\ECommerce\SalesBundle\EventSubscriber;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LifecycleEventArgs;

use Doctrine\ODM\MongoDB\DocumentManager;

/**
* MappedORMEventSubscriber is used to set the property of an Entity instance to a reference to a Document 
*/
class MappedORMEventSubscriber
{
    protected $listeners = array();

    public function __construct(EntityManager $em, DocumentManager $dm, array $mapping)
    {
        $this->em = $em;
        $this->dm = $dm;

        $this->mapping = $mapping;
    }

    public static function initialize(EntityManager $em, DocumentManager $dm, array $listeners = array())
    {
        $eventManager = $em->getEventManager();
        foreach($listeners as $listener) {
            $eventManager->addEventListener(
                $listener['events'], new self($em, $dm, $listener['mapping'])
            );
        }
    }

    public function postLoad(LifecycleEventArgs $event_args)
    {
        $em = $event_args->getEntityManager();
        $entity = $event_args->getEntity();
    
        $reflection_property = $em->getClassMetadata($this->mapping['entity'])->reflClass->getProperty($this->mapping['property']);

        $reflection_property->setAccessible(true);
        $reflection_property->setValue(
            $entity,
            $this->dm->find($this->mapping['document'], $entity->{$this->mapping['pkeyGetter']}())
        );
    }
}

