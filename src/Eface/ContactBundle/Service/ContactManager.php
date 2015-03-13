<?php

namespace Eface\ContactBundle\Service;

use Doctrine\Common\Persistence\ManagerRegistry;
use Eface\ContactBundle\Entity\Contact;

/**
 * ContactManager manager object
 *
 * @package Contact
 */
class ContactManager
{
    /**
     * @var ManagerRegistry
     */
    protected $managerRegistry;

    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @param ManagerRegistry $managerRegistry
     * @param \Swift_Mailer   $mailer
     */
    public function __construct(ManagerRegistry $managerRegistry, $mailer)
    {
        $this->managerRegistry = $managerRegistry;
        $this->mailer = $mailer;
    }

    /**
     * updates Contact
     *
     * @param Contact     $contact
     * @param boolean     $andFlush
     *
     * @return Contact
     */
    public function update(Contact $contact, $andFlush = true)
    {
        $this->getEntityManager()->persist($contact);

        if ($andFlush) {
            $this->getEntityManager()->flush();
        }

        return $contact;
    }

    /**
     * sends Contact message
     *
     * @param string $email
     * @param string $body
     */
    public function sendMessage($email, $body)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Contact from web page')
            ->setFrom($email)
            ->setTo($email)
            ->setBody($body);

        $this->mailer->send($message);
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    private function getEntityManager()
    {
        return $this->managerRegistry->getManager();
    }
}
