<?php

namespace Bundle\ECommerce\ProductBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\ChoiceField;
use Symfony\Component\Validator\ValidatorInterface;

class ProductFilter extends Form
{
    public function configure()
    {
        $this->add(new TextField('name'));
        $this->add(new TextField('sku'));
        $this->add(new TextField('attributes.name'));
        $this->add(new ChoiceField('attributes.options.value', array('choices' => $this->getAttributesChoices())));
    }

    public function getAttributesChoices()
    {
        return array();
    }
}
