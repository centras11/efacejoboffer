<?php

namespace Eface\ContactBundle\DataFixtures\ORM;;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Eface\contactBundle\Entity\Contact;

class ContactFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 8; $i++)
        {
            $contact = new Contact();
            $contact->setName('Antanas '.$i);
            $contact->setEmail('antanas'.$i.'@domenas.lt');
            $contact->setMessage('very helpful message');
            $manager->persist($contact);
        }

        $manager->flush();
    }

}