<?php

namespace Bundle\ECommerce\ProductBundle\Entities;

use Bundle\ECommerce\ProductBundle\Entities\Category;
use Bundle\ECommerce\ShippingBundle\Entities\Shipping;

use Symfony\Components\Validator\Constraints;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Components\Validator\Mapping\ClassMetadata;

/**
 * Product
 * Represents a type of product of a shopping application.
 *
 * @author Klein Florian
 * @Entity
 * @Table(name="product",indexes={@Index(name="name_idx", columns={"name"})})
 */
class Product
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="string", length=255, nullable="true")
     */
    private $name;

    /**
     * @OneToOne(targetEntity="Bundle\ECommerce\ShippingBundle\Entities\Shipping", cascade={"persist"})
     * @JoinColumn(name="shipping_id", referencedColumnName="id")
     */
    private $shipping;

    /**
     * @OneToMany(targetEntity="Feature", mappedBy="product", cascade={"persist"})
     */
    private $features;

    /**
     * @ManyToMany(targetEntity="Category", cascade={"persist"}, inversedBy="product")
     * @JoinTable(name="product_category",
     *      joinColumns={@JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="category_id", referencedColumnName="id")})
     */
    private $categories;

    /**
     * This relation is saved with two records in the association table for 
     * simplicity.
     * @ManyToMany(targetEntity="Product", cascade={"persist"})
     * @JoinTable(name="product_related",
     *      joinColumns={@JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="related_id", referencedColumnName="id")})
     */
    private $related;

    public function __construct()
    {
        $this->features = new ArrayCollection;
        $this->categories = new ArrayCollection;
        $this->related = new ArrayCollection;
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

    public function getShipping()
    {
        return $this->shipping;
    }

    public function setShipping(Shipping $shipping)
    {
        $this->shipping = $shipping;
    }

    public function removeShipping()
    {
        $this->shipping = null;
    }

    public function getFeatures()
    {
        return $this->features;
    }

    public function addFeature(Feature $feature)
    {
        $this->features[] = $feature;
        $feature->setProduct($this);
    }

    public function removeFeature(Feature $feature)
    {
        $removed = $this->features->removeElement($feature);
        if ($removed !== null) {
            $removed->removeProduct();
            return true;
        }
        return false;
    }

    public function addCategory(Category $category)
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addProduct($this);
        }
    }

    public function removeCategory(Category $category)
    {
        $removed = $this->categories->removeElement($category);
        if ($removed !== null) {
            $removed->removeProduct($this);
        }
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function getRelated()
    {
        return $this->related;
    }

    public function addRelated(Product $related)
    {
        if (!$this->related->contains($related)) {
            $this->related[] = $related;
            $related->addRelated($this);
        }
    }

    public function removeRelated(Product $related)
    {
        $removed = $this->related->removeElement($related);
        if ($removed) {
            $related->removeRelated($this);
        }
    }
}
