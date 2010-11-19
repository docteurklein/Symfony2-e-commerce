<?php

namespace Bundle\ECommerce\ProductBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class ProductBundle extends Bundle
{
    /**
     * Get a EntityRepository or a DocumentRepository, based on db driver configuration
     *
     * @param mixed $objectManager a EntityManager or a DocumentManager
     * @param mixed $objectClass the class of the entity or document
     * @return mixed a EntityRepository or DocumentRepository
     */
    public static function getRepository($objectManager, $objectClass)
    {
        return $objectManager->getRepository($objectClass);
    }
}
