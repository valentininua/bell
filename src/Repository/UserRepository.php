<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getUsers()
    {
        $data = $this->createQueryBuilder("r")
            ->select()
            //            ->andWhere('r.referralLink = :referralLink')
            //            ->setParameter('referralLink', $id)
            ->getQuery()
            ->getResult();

        foreach ($data as $key => &$value) {
            $output[$value->getId()] = &$value;
        }

        foreach ($data as $key => &$value) {
            if ($value->getReferralLink() && isset($output[$value->getReferralLink()])) {
                $output[$value->getReferralLink()]->nodes[] = &$value;

            }
        }

        foreach ($data as $key => &$value) {
            if ($value->getReferralLink() && isset($output[$value->getReferralLink()])) {
                unset($data[$key]);
            }
        }

        return $data;
    }

}
