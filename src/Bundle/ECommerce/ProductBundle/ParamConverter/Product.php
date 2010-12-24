<?php

namespace Bundle\ECommerce\ProductBundle\ParamConverter;

use Symfony\Bundle\FrameworkBundle\Request\ParamConverter\ConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * Converts a Site typehint on a controller action to an instance of that typehint
 *
 * @author Henrik Bjornskov <hb@peytz.dk>
 */
class Product implements ConverterInterface
{
    /**
     * @var DocumentRepository
     */
    protected $repository;

    protected $parameter_name;

    protected $class_name;

    /**
     * @param DocumentRepository $repository
     */
    public function __construct($parameter_name, DocumentRepository $repository, $class_name)
    {
        $this->parameter_name = $parameter_name;
        $this->repository = $repository;
        $this->class_name = $class_name;
    }

    /**
     * Applies converto to the request
     *
     * @param Request              $request
     * @param \ReflectionParameter $parameter
     */
    public function apply(Request $request, \ReflectionParameter $parameter)
    {
        $request->attributes->set($parameter->getName(), $this->repository->findOneBySlug($request->get($this->parameter_name)));
    }

    /**
     * @param  \ReflectionClass $class
     * @return boolean
     */
    public function supports(\ReflectionClass $class)
    {
        return $class->getName() == $this->class_name;
    }
}