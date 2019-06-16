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


    public function getExchangeRates()
    {
        $exchangeRates = file_get_contents('https://api.exmo.com/v1/trades/?pair=USD_RUB,BTC_USD,LTC_USD,ETH_USD,NEO_USD,USDT_USD');
        $exchangeRates = json_decode($exchangeRates);

        $exchangeRatesReturn = [];
        foreach ($exchangeRates as $k=>$v) {
            foreach ($v as $_k => $_v) {
                $exchangeRatesReturn[$k] = $_v->price;

            }
        }

        return $exchangeRatesReturn;
    }

}
