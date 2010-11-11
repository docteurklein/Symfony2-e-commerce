<?php

namespace Bundle\ContactBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\TextareaField;

use Symfony\Component\Validator\ValidatorInterface;

class ContactForm extends Form
{
    public function configure()
    {
        $this->add(new TextField('email'));
        $this->add(new TextField('subject'));
        $this->add(new TextareaField('message'));
    }
}
