<?php
// src/Entity/User.php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *@ORM\Column(type="integer", options={"default" : 0}, nullable=true)
     */
    protected $referralLink;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @return mixed
     */
    public function getReferralLink()
    {
        return $this->referralLink;
    }

    /**
     * @param $referralLink
     */
    public function setReferralLink($referralLink): void
    {
        $this->referralLink = $referralLink;

    }



}
