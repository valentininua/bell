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
                SUM(r.balanceIpo) as ipo, 
                SUM(r.balanceConservative) as conservative, 
                SUM(r.balanceOptimum) as optimum, 
                SUM(r.currentAccount) as available_funds
            ')
            ->andWhere('r.uid = :reportUid')
            ->setParameter('reportUid', $id)
            ->getQuery()
            ->getResult()[0];
    }

}
