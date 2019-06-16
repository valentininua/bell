<?php

namespace App\Services;

use App\Entity\Report;

use App\Repository\ReportRepository;

class ReportService
{

    /**
     * @var ReportRepository
     */
    private $report;

    public function __construct( ReportRepository $report )
    {
        $this->report = $report;
    }

    /**
     * @param $user
     * @return array
     */
    public function getReport($user = null):array
    {
        if (!$user) {
            return [];
        }
      $arr = $this->report->getBalanceReport($user->getId());
      $arrOutput = [];
      foreach ($arr as $k => $v) {
          $arrOutput[$k] = $v??0;
      }
      return $arrOutput;
    }

}
