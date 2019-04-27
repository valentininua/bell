<?php

namespace App\Services;

use App\Entity\User;

use App\Repository\UserRepository;

class UserService
{


    private $user;

    public function __construct( UserRepository $user )
    {
        $this->user = $user;
    }

    public function getTreeUsers()
    {
        return $this->user->getUsers();
    }

}
