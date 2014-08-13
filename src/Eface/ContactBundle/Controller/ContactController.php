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
     * @Route("/contact-us", name="EfaceContactBundle_contact")
     * @Method({"GET", "POST"})
     * @return generated contact form
     */
    public function contactAction()
    {
        $contact = new Contact();
        $form = $this->createForm(new ContactType(), $contact);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind( $request );
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($contact);
                $em->flush();
                $message = \Swift_Message::newInstance()
                    ->setSubject('Contact from web page')
                    ->setFrom($this->container->getParameter('eface_contact.admin_email'))
                    ->setTo($this->container->getParameter('eface_contact.admin_email'))
                    ->setBody($this->renderView('EfaceContactBundle:Page:contactEmail.txt.twig', array('contact' => $contact)));
                $this->get('mailer')->send($message);
                $this->get('session')->getFlashBag()->add('success', 'Your message was successfully sent. Thank you!');
                
                return $this->redirect($this->generateUrl('EfaceContactBundle_contact'));
            }
        }

        return $this->render('EfaceContactBundle:Page:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
