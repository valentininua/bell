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
     * @ORM\Column(type="integer", options={"default" : 0} ,  nullable=true)
     */
    protected $isProfit;


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
    protected $balance04;



    /**
     * @var string
     * @ORM\Column(type="decimal", precision=65, scale=2, options={"default" : 0} , nullable=true)
     */
    protected $balanceFive;

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
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
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
    public function getBalanceIpo():?string
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
    public function getBalanceConservative(): ?string
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
    public function getBalance04(): ?string
    {
        return $this->balance04;
    }


    /**
     * @param string $balance04
     */
    public function setBalance04(string $balance04): void
    {
        $this->balance04 = $balance04;
    }

    /**
     * @return string
     */
    public function getCurrentAccount(): ?string
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

    /**
     * @return string
     */
    public function getBalanceFive(): ?string
    {
        return $this->balanceFive;
    }

    /**
     * @param string $balanceFive
     */
    public function setBalanceFive(string $balanceFive): void
    {
        $this->balanceFive = $balanceFive;
    }

    /**
     * @return mixed
     */
    public function getisProfit()
    {
        return $this->isProfit;
    }

    /**
     * @param mixed $isProfit
     */
    public function setIsProfit($isProfit): void
    {
        $this->isProfit = $isProfit;
    }



}
