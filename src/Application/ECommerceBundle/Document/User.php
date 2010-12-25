<?php
namespace Application\ECommerceBundle\Document;
use Bundle\FOS\UserBundle\Model\User as BaseUser;

/**
 * @mongodb:Document
 */
class User extends BaseUser
{
    /**
     * @mongodb:Id
     */
    protected $id;
}