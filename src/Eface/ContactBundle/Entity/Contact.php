<?php

namespace Eface\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Contact entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="eface_contact")
 * @ORM\Entity(repositoryClass="Eface\ContactBundle\Repository\ContactRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Contact
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", name="id")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=true)
     * @Assert\NotBlank(
     *     message = "Please provide your Name.",
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=64, nullable=true)
     * @Assert\NotBlank(
     *     message = "Please provide your Email.",
     * )
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     * @Assert\NotBlank()
     */
    private $message;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Contact
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Contact
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Contact
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @ORM\PrePersist
     */
    public function setDateValue()
    {
        if (!$this->getDate()) {
          $this->date = new \DateTime();
        }
    }
}
