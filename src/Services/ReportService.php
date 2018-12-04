<?php

namespace App\Services;

// use App\Entity\Report;

class ReportService
{
    public function getReport($user)
    {
        return[
            'conservative' => 0,
            'optimum' => 0,
            'ipo' => 0,
            'available_funds' => $user->getBalance(),
        ];

    }
}
