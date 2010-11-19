<?php

namespace Bundle\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Bundle\ContactBundle\Document\Contact;


class ContactController extends Controller
{
    public function contactAction()
    {
        $form = $this->get('contact.form');

        $contact = new Contact;
        $form->setData($contact);

        if ($this->get('request')->getMethod() == 'POST') {
            $form->bind($this->get('request')->get($form->getName()));

            if ($form->isValid()) { // always valid ?! WTF
                $dm = $this->get('doctrine.odm.mongodb.document_manager');
                $dm->persist($contact);
                $dm->flush();
                // do something, ie: send an email
                // notify an event
                
                return $this->redirect($this->generateUrl('contact_index'));
            }
        }
        
        return $this->render('ContactBundle:Contact:form.php', array('form' => $form));
    }
}
