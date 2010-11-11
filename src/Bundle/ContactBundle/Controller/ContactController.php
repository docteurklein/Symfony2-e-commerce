<?php

namespace Bundle\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Bundle\ContactBundle\Document\Contact;


class ContactController extends Controller
{
    public function contactAction()
    {
        $form = $this['contact.form'];

        $contact = new Contact;
        $form->setData($contact);

        if ($this['request']->getMethod() == 'POST') {
            $form->bind($this->getRequest()->getParameter($form->getName()));

            if ($form->isValid()) {
                $dm = $this['doctrine.odm.mongodb.document_manager'];
                $dm->persist($contact);
                $dm->flush();
            }
        }
        
        return $this->render('ContactBundle:Contact:form.php', array('form' => $this['templating.form']->get($form)));
    }
}
