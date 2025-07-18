<?php

namespace App\Repository;

// use App\Model\SearchData;
use App\Data\FilterData;
use App\Entity\Signalement;
// use Knp\Component\Pager\PaginatorInterface;
// use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Signalement>
 */
class SignalementRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry, 
        // private PaginatorInterface $paginatorInterface
    )
    {
        parent::__construct($registry, Signalement::class);
    }

    public function findSearch(FilterData $filter): array
    {
        $query = $this
            ->createQueryBuilder('s');
            
            

        if(!empty($filter->recherche)){
            $query
                ->where($query->expr()->like('s.type', ':recherche'))
                ->setParameter('recherche',"%{$filter->recherche}%");
        }

        if(!empty($filter->departement)){
            $c
                ->select('st', 's')
                ->join('s.structure', 'st')
                ->where($query->expr()->in('st.departement', $filter->departement));
        }

        if(!empty($filter->infect)){
            $query
                ->select('i', 's')
                ->join('s.infection', 'i')
                ->where($query->expr()->in('i.infection', $filter->infect));                
        }

        if(!empty($filter->dateMin)){
            $query
                ->andWhere($query->expr()->gte('s.date', ':dateMin'))
                ->setParameter('dateMin', $filter->dateMin, Types::DATE_IMMUTABLE);
        }

        if(!empty($filter->dateMax)){
            $query
                ->andWhere($query->expr()->lte('s.date', ':dateMax'))
                ->setParameter('dateMax', $filter->dateMax, Types::DATE_IMMUTABLE);
        }
            // ->select('d', 's')
            // ->join('s.agent', 'a');
            // ->join('s.structure', 'd');

            // if(!empty($search->recherche)){
            //     $query = $query
            //         ->andWhere('s.structure.nom LIKE :recherche')
            //         ->setParameter('recherche', "%{$filter->s}%");
            // }

            // if (!empty($search->infection)) {
            //     $query = $query
            //         ->andWhere('s.epidemie = 1');
            // }

            // if (!empty($search->departement)) {
            //     $query = $query
            //         ->andWhere('d.departement IN (:structure)')
            //         ->setParameter('departement', $search->departement);
            // }
            // dd($query);
            // dd($query);
            // if(!empty($search->recherche)){
            //     $query = $query
            //         ->andWhere('s.type LIKE :recherche')
            //         ->setParameter('recherche', "%{$filter->s}%");
            // }
        return $query
            ->getQuery()
            ->getResult();    
    }
}
