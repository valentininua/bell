<?php
// src/Entity/Report.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bb_report")
 */
class Report
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
    protected $balanceIpo;

    /**
     * @var string
     * @ORM\Column(type="decimal", precision=65, scale=2, options={"default" : 0} ,nullable=true)
     */
    protected $balanceConservative;

    /**
     * @var string
     * @ORM\Column(type="decimal", precision=65, scale=2, options={"default" : 0} , nullable=true)
     */
    protected $balanceOptimum;

    /**
     * @var string
     * @ORM\Column(type="decimal", precision=65, scale=2, options={"default" : 0}, nullable=true)
     */
    protected $currentAccount;

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
    public function getBalanceIpo(): string
    {
        return $this->balanceIpo;
    }

    /**
     * @param string $balanceIpo
     */
    public function setBalanceIpo(string $balanceIpo): void
    {
        $this->balanceIpo = $balanceIpo;
    }

    /**
     * @return string
     */
    public function getBalanceConservative(): string
    {
        return $this->balanceConservative;
    }

    /**
     * @param string $balanceConservative
     */
    public function setBalanceConservative(string $balanceConservative): void
    {
        $this->balanceConservative = $balanceConservative;
    }

    /**
     * @return string
     */
    public function getBalanceOptimum(): string
    {
        return $this->balanceAggressive;
    }

    /**
     * @param string $balanceAggressive
     */
    public function setBalanceOptimum(string $balanceOptimum): void
    {
        $this->balanceOptimum = $balanceOptimum;
    }

    /**
     * @return string
     */
    public function getCurrentAccount(): string
    {
        return $this->currentAccount;
    }

    /**
     * @param string $currentAccount
     */
    public function setCurrentAccount(string $currentAccount): void
    {
        $this->currentAccount = $currentAccount;
    }

}
