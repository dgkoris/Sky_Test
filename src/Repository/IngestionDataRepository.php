<?php

namespace App\Repository;

use App\Entity\IngestionData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IngestionData|null find($id, $lockMode = null, $lockVersion = null)
 * @method IngestionData|null findOneBy(array $criteria, array $orderBy = null)
 * @method IngestionData[]    findAll()
 * @method IngestionData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngestionDataRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, IngestionData::class);
    }

    /**
     * @param $timestamp
     * @return IngestionData[]
     */
    public function findAllGreaterThan($timestamp): array {

        $qb = $this->createQueryBuilder('data')
                ->andWhere('data.timestamp >= :timestamp')
                ->setParameter('timestamp', $timestamp)
                ->orderBy('data.timestamp', 'ASC')
                ->getQuery();

        return $qb->execute();
    }

    /**
     * @param $timestamp
     * @return IngestionData[]
     */
    public function findAllLessThan($timestamp): array {

        $qb = $this->createQueryBuilder('data')
                ->andWhere('data.timestamp <= :timestamp')
                ->setParameter('timestamp', $timestamp)
                ->orderBy('data.timestamp', 'ASC')
                ->getQuery();

        return $qb->execute();
    }

    /**
     * @param $from_timestamp
     * @param $to_timestamp
     * @return IngestionData[]
     */
    public function findAllBetween($from_timestamp, $to_timestamp): array {

        $qb = $this->createQueryBuilder('data')
                ->andWhere('data.timestamp >= :from_timestamp')
                ->setParameter('from_timestamp', $from_timestamp)
                ->andWhere('data.timestamp <= :to_timestamp')
                ->setParameter('to_timestamp', $to_timestamp)
                ->orderBy('data.timestamp', 'ASC')
                ->getQuery();

        return $qb->execute();
    }

}
