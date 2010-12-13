<?php

namespace Bundle\ECommerce\ProductBundle\Filter;

use Symfony\Component\Form\PropertyPath;
use Doctrine\ODM\MongoDB\Query\Builder;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Form\Form;


class Filter
{
    protected $dm;
    protected $documentName;
    protected $form;

    public function __construct($documentName, DocumentManager $dm, Form $form)
    {
        $this->documentName = $documentName;
        $this->dm = $dm;
        $this->form = $form;
    }

    /**
     * builds a Query\Builder from an array of field => values
     *
     * checks for methods in this order:
     *   - add*Criteria (where * is the field name)
     *   - add*TypeCriteria (where * is the doctrine field type)
     *
     * @throws InvalidArgumentException if no method found to handle the field
     * @param array $values
     * @param Builder|null $builder
 *
     * @return Builder
     */
    public function buildQuery(array $values = array(), Builder $builder = null)
    {
        $repository = $this->dm->getRepository($this->documentName);
        $metadata = $repository->getClassMetadata();
        if( ! $builder) {
            $builder = $repository->createQueryBuilder();
        }

        foreach($values as $path => $value) {
            $propertyPath = new PropertyPath($path);
            $method = sprintf('add%sCriteria', $path);
            if( ! \method_exists($this, $method) and $mapping = $metadata->getFieldMapping($propertyPath->getElement(0))) {
                $method = sprintf('add%sTypeCriteria', $mapping['type']);
            }
            if( ! \method_exists($this, $method)) {
                throw new \InvalidArgumentException(sprintf('Unable to filter: "%s" => "%s", type %s', $path, \var_export($value, true), $mapping['type']));
            }

            $this->$method($builder, $path, $mapping, $value);
        }
        
        return $builder;
    }

    protected function addStringTypeCriteria(Builder &$builder, $path, array $mapping, $value)
    {
        $builder->field($mapping['fieldName'])->in((array) $value);

        return $this;
    }

    protected function addManyTypeCriteria(Builder &$builder, $path, array $mapping, $value)
    {
        if( ! isset($mapping['embedded']) or ! $mapping['embedded']) {
            throw new \InvalidArgumentException(sprintf('Unable to filter a non embedded field: "%s" => "%s", type %s', $path, \var_export($value, true), $mapping['type']));
        }

        $builder->field($path)->in((array) $value);

        return $this;
    }

    public function setForm(Form $form)
    {
        $this->form = $form;
    }

    public function getForm()
    {
        return $this->form;
    }
}

