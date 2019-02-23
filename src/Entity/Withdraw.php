<?php
// src/Entity/Report.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bb_withdraw")
 */
class Withdraw
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $uid;

    /**
     * @var string
     * @ORM\Column(type="decimal", precision=65, scale=2, options={"default" : 0}, nullable=true)
     */
    protected $balanceOutput;


    /**
     * @var string
     * @ORM\Column(type="text", options={"default" : 0}, nullable=true)
     */
    protected $accountNumber;

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
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid): void
    {
        $this->uid = $uid;
    }

    /**
     * @return string
     */
    public function getBalanceOutput(): string
    {
        return $this->balanceOutput;
    }

    /**
     * @param string $balanceOutput
     */
    public function setBalanceOutput(string $balanceOutput): void
    {
        $this->balanceOutput = $balanceOutput;
    }

    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    /**
     * @param string $accountNumber
     */
    public function setAccountNumber(string $accountNumber): void
    {
        $this->accountNumber = $accountNumber;
    }

    /**
     * @return mixed
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * @param mixed $approved
     */
    public function setApproved($approved): void
    {
        $this->approved = $approved;
    }
}
