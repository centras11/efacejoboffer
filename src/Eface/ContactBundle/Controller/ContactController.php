<?php

namespace Eface\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Eface\ContactBundle\Entity\Contact;
use Eface\ContactBundle\Form\ContactType;

class ContactController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/", name="EfaceContactBundle_contact")
     * @Method({"GET", "POST"})
     *
     * @return Response
     */
    public function contactAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(new ContactType(), $contact);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->getContactManager()->update($contact);
            $this->getContactManager()->sendMessage($this->container->getParameter('eface_contact.admin_email'), $this->renderView('EfaceContactBundle:Page:contactEmail.txt.twig', array('contact' => $contact)));

            $this->get('session')->getFlashBag()->add('success', 'Your message was successfully sent. Thank you!');

            return $this->redirect($this->generateUrl('EfaceContactBundle_contact'));
        }

        return $this->render('EfaceContactBundle:Page:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @return \Eface\ContactBundle\Service\ContactManager
     */
    protected function getContactManager()
    {
        return $this->get('eface.service.contact_manager');
    }
}
