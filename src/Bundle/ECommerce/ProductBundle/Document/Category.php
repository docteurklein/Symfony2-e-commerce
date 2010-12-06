<?php

namespace Bundle\ECommerce\ProductBundle\Document;

use Bundle\ECommerce\ProductBundle\Document\Product;
use Doctrine\Common\Collections\ArrayCollection;
use  Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;

/**
 * @mongodb:Document(collection="categories", repositoryClass="Bundle\ECommerce\ProductBundle\Document\CategoryRepository")
 * mongodb:HasLifeCycleCallbacks
 */
class Category
{
    const PATH_SEPARATOR = '/';

    /**
     * @mongodb:Id
     */
    protected $id;

    /**
     * @mongodb:String
     * @gedmo:Sluggable
     */
    protected $name;

    /**
     * @mongodb:String
     * @gedmo:Slug(unique=false)
     */
    protected $slug;

    /**
     * @mongodb:ReferenceMany(targetDocument="Bundle\ECommerce\ProductBundle\Document\Product")
     */
    protected $products = array();

    /**
     * @mongodb:ReferenceOne(targetDocument="Bundle\ECommerce\ProductBundle\Document\Category")
     */
    protected $parent_id;

    /**
     * @mongodb:String
     */
    protected $path;

    /**
     * @mongodb:Int
     */
    protected $order;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function  __toString()
    {
        return (string) $this->getName();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = (string) $name;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function countProducts()
    {
        return $this->products->count();
    }

    public function addProduct(Product $product)
    {
        if (!$this->hasProduct($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product)
    {
        return $this->products->removeElement($product);
    }

    public function getProduct(Product $product)
    {
        $key = array_search($product, $this->products->toArray(), true);
        
        if ($key !== false) {
            return $this->products->get($key);
        }
    }

    public function hasProduct(Product $product)
    {
        return $this->products->contains($product);
    }

    /**
     * @param Category $category
     * @return boolean
     */
    public function isChildOf(Category $category)
    {
        return $this->getParentPath() === $category->getPath();
    }

    /**
     * @param Category $category
     * @return boolean
     */
    public function isParentOf(Category $category)
    {
        return $this->getPath() === $category->getParentPath();
    }

    public function setChildOf(Category $category)
    {
        $this->setPath($category->getPath() . self::PATH_SEPARATOR . $this->getId());

        return $this;
    }

    public function setParentOf(Category $category)
    {
        $this->setPath($category->getParentPath());

        return $this;
    }

    public function getExplodedPath()
    {
        return \explode(self::PATH_SEPARATOR, $this->getPath());
    }

    public function getLevel()
    {
        return count($this->getExplodedPath()) - 1;
    }

    public function getParentPath()
    {
        $path = $this->getExplodedPath();
        \array_pop($path);

        $parent_path = implode(self::PATH_SEPARATOR, $path);
        
        return $parent_path ? $parent_path : '/';
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $this->setPath($this->getId());
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function setOrder($order)
    {
        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }
}

