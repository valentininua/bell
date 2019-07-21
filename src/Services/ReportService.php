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

    /**
     * @param $user
     * @return array
     */
    public function getBalanceAllReport($user = null)
    {
        if (!$user) {
            return 0;
        }

        if (!$user) {
            return 0;
        }
        $arr = $this->report->getBalanceAllReport($user->getId());

        $summ = 0;
        foreach ($arr as $key=>$value) {
            $summ +=$value;
        }
        return $summ;

    }

    /**
     * @param $user
     * @return array
     */
    public function getProfitAllReport($user = null)
    {
        if (!$user) {
            return 0;
        }
        return $this->report->getProfitAllReport($user->getId());
    }
    /**
     * @param $user
     * @return array
     */
    public function getProfitSummAllReport($user = null)
    {
        if (!$user) {
            return 0;
        }
        $arr = $this->report->getProfitAllReport($user->getId());

        $summ = 0;
        foreach ($arr as $key=>$value) {
            $summ += $value->getBalanceIpo();
            $summ +=  $value->getBalanceConservative();
            $summ +=  $value->getBalanceFive();
            $summ +=  $value->getBalance04();

        }
        return $summ;
    }




}
