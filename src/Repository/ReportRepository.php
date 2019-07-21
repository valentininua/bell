<?php

namespace App\Repository;

use App\Entity\Report;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class ReportRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Report::class);
    }

    public function getBalanceReport($id): array
    {
        return $this->createQueryBuilder("r")
            ->select('
                SUM(r.balanceFive) as five,
                SUM(r.balanceIpo) as ipo, 
                SUM(r.balanceConservative) as conservative, 
                SUM(r.balance04) as balance04, 
                SUM(r.currentAccount) as available_funds
            ')
            ->andWhere('r.uid = :reportUid')
            ->setParameter('reportUid', $id)
            ->getQuery()
            ->getResult()[0];
    }

    public function getBalanceAllReport($id): array
    {
        return $this->createQueryBuilder("r")
            ->select('
                SUM(r.balanceFive) as five,
                SUM(r.balanceIpo) as ipo, 
                SUM(r.balanceConservative) as conservative, 
                SUM(r.balance04) as balance04, 
                SUM(r.currentAccount) as available_funds
            ')
            ->andWhere('r.uid = :reportUid')
            ->setParameter('reportUid', $id)
            ->getQuery()
            ->getResult()[0];
    }


    public function getProfitAllReport($id): array
    {
        return  $this->createQueryBuilder("r")
            ->select()
            ->andWhere('r.uid = :reportUid')
            ->andWhere('r.isProfit = 1')
            ->setParameter('reportUid', $id)
            ->getQuery()
            ->getResult();
    }

}
