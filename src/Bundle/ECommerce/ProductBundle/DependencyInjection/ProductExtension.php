<?php

namespace Bundle\ECommerce\ProductBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Doctrine\ODM\MongoDB\Query\Builder;

class ProductExtension extends Extension
{
    public function configLoad(array $config, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
        $loader->load('model.xml');
        $loader->load('paginator.xml');
        $loader->load('menu.xml');
        $loader->load('filter.xml');
        $loader->load('param_converter.xml');
    }

    /**
     * Get a DocumentRepository
     *
     * @param mixed $objectManager a DocumentManager
     * @param mixed $objectClass the class of the document
     * @return DocumentRepository
     */
    public static function getRepository($objectManager, $objectClass)
    {
        return $objectManager->getRepository($objectClass);
    }

    /**
     * Get a closure that instanciates a paginator
     *
     * Call it like this:
     *   $builder = $this->get('ecommerce.repository.product')->getBuilder();
     *   $pagerFactory = $this->get('ecommerce.paginator.product.factory');
     *   $pager = \call_user_func($pagerFactory, $builder);
     *   // or
     *   $pager = $pagerFactory($builder);
     *
     * @static
     * @param  $paginatorClass the paginator class name
     * @param  $paginatorAdapterClass the adapter class name
     * @return Closure the closure to invoke with a Query builder as first argument
     */
    public static function getPaginatorFactory($paginatorClass, $paginatorAdapterClass)
    {
        return function(Builder $builder) use ($paginatorClass, $paginatorAdapterClass) {
            $adapter = new $paginatorAdapterClass($builder);
            
            return new $paginatorClass($adapter);
        };
    }

    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    public function getNamespace()
    {
        return 'http://www.symfony-project.org/schema/dic/ecommerce/product';
    }

    public function getAlias()
    {
        return 'ecommerce_product';
    }
}
