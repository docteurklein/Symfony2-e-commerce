<?php

namespace Bundle\ECommerce\ShippingBundle\Document;

use Symfony\Component\Validator\Constraints;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Shipping
 * Represents a shipping method.
 *
 * @author Klein Florian
 * @Entity
 * @Table(name="shipping")
 */
class Shipping
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="integer")
     */
    private $days;

    public function getId()
    {
        return $this->id;
    }

    public function getDays()
    {
        return $this->days;
    }

    public function setDays($days)
    {
        $this->days = $days;
    }
}
