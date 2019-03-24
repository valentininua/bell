<?php
// src/Entity/Contactform.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bb_contactform")
 */
class Contactform
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", options={"default" : 0}, nullable=true)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", options={"default" : 0}, nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", options={"default" : 0}, nullable=true)
     */
    protected $subject;

    /**
     * @ORM\Column(type="string", options={"default" : 0}, nullable=true)
     */
    protected $message;

    /**
     * @ORM\Column(type="integer", options={"default" : 0}, nullable=true)
     */
    protected $approved;

    /**
     * @ORM\Column(type="datetime", columnDefinition="DATETIME on update CURRENT_TIMESTAMP")
     */
    private $updatedAt;
    /**
     * @var \DateTime
     *@ORM\Column(name="created_at", type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    /**
     * @param mixed $approved
     */
    public function setApproved($approved): void
    {
        $this->approved = $approved;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }


}
