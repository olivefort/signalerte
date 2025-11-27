<?php

namespace App\Repository;

use App\Data\FilterData;
use App\Entity\Structure;
use App\Data\FilterStructure;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Structure>
 */
class StructureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Structure::class);
    }


    /**
     * Récupération des signalements via la recherche par le filtre
     *
     * @return Structure[]
     */
    public function findSearch(FilterStructure $filter): array
    {
        $query = $this->createQueryBuilder('st');
            // ->select('n','st');
            // ->join('st.nom', 'n');

        if(!empty($filter->q)){
            $query = $query
                ->andWhere('st.nom LIKE :q OR st.finessG LIKE :q OR st.finessJ LIKE :q OR st.ville LIKE :q OR st.cp LIKE :q OR st.departement LIKE :q OR st.type LIKE :q')
                ->setParameter('q', "%{$filter->q}%");
        }
        return $query->getQuery()->getResult();
    }

    //    /**
    //     * @return Structure[] Returns an array of Structure objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Structure
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
