<?php

namespace Application\ECommerceBundle\Document;

use Bundle\FOS\UserBundle\Document\User as BaseUser;

/**
 * @mongodb:Document(repositoryClass="Bundle\FOS\UserBundle\Document\UserRepository")
 */
class User extends BaseUser 
{
    /**
     * @mongodb:Id
     */
    protected $id;
}
