<?php

namespace Bundle\ContactBundle\Document;


/**
 * @mongodb:Document(db="symfony2_ecommerce", collection="products")
 */
class Contact
{
    /**
     * @mongodb:Id
     */
    protected $id;

    /**
     * @mongodb:String
     */
    protected $subject;

    /**
     * @mongodb:String
     * @Validation:Validation({ @Email })
     */
    protected $email;

    /**
     * @mongodb:String
     */
    protected $message;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }
}