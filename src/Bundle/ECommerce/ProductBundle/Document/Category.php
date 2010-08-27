<?php

namespace Bundle\ECommerce\ProductBundle\Entities;

use Bundle\ECommerce\ProductBundle\Entities\Product;

use Symfony\Component\Validator\Constraints;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Category
 * Represents a tag applied on particular products.
 *
 * @author Klein Florian
 * @Entity
 * @Table(name="category")
 */
class Category
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Column(type="string", length=50)
     */
    private $name;

    /**
     * @ManyToMany(targetEntity="Product", mappedBy="category")
     */
    private $products;

    /**
     * @OneToMany(targetEntity="Category", mappedBy="parent", cascade={"persist"})
     */
    private $children;

    /**
     * @ManyToOne(targetEntity="Category", inversedBy="children")
     * @JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->children = new ArrayCollection();
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
        $this->name = $name;
    }

    public function addProduct(Product $product)
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->addCategory($this);
        }
    }

    public function removeProduct(Product $product)
    {
        $removed = $this->products->removeElement($product);
        if ($removed !== null) {
            $removed->removeCategory($this);
        }
    }

    public function getProducts()
    {
        return $this->products;
    }

    private function setParent(Category $parent)
    {
        $this->parent = $parent;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function addChild(Category $child)
    {
        $this->children[] = $child;
        $child->setParent($this);
    }

    public function removeChild(Category $child)
    {
        $removed = $this->children->removeElement($child);
        if ($removed !== null) {
            $removed->removeParent();
        }
    }

    private function removeParent()
    {
        $this->parent = null;
    }
}
