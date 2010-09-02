<?php

namespace Bundle\ECommerce\SalesBundle\EventSubscriber;

use Doctrine\ORM\EntityManager;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;

/**
* MappedODMEventSubscriber is used to set the property of a Document instance to a reference to an Entity
*/
class MappedODMEventSubscriber
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
        $eventManager = $dm->getEventManager();
        foreach($listeners as $listener) {
            $eventManager->addEventListener(
                $listener['events'], new self($em, $dm, $listener['mapping'])
            );
        }
    }

    public function postLoad(LifecycleEventArgs $event_args)
    {
        $dm = $event_args->getDocumentManager();
        $document = $event_args->getDocument();
    
        $reflection_property = $dm->getClassMetadata($this->mapping['document'])->reflClass->getProperty($this->mapping['property']);

        $reflection_property->setAccessible(true);
        $reflection_property->setValue($document, $this->getValue($document));

    }

    public function getValue($document)
    {
        if($this->mapping['type'] == 'one') {
            return $this->em->find($this->mapping['entity'], $document->{$this->mapping['pkeyGetter']}());
        }

        if($this->mapping['type'] == 'many') {
            return $this->em->getRepository($this->mapping['entity'])->findBy(array(
                $this->mapping['fkey'] => $document->{$this->mapping['pkeyGetter']}()
            ));
        }
    }
}

