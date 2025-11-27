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

    /**
     * Récupération des signalements via la recherche par le filtre
     *
     * @return Signalement[]
     */
    public function findSearch(FilterData $filter): array
    {
        $query = $this->createQueryBuilder('s')
            ->select('i', 's')
            ->select('st', 's')
            ->join('s.infection', 'i')
            ->join('s.structure', 'st');

        if(!empty($filter->q)){
            $query = $query               
                ->andWhere('s.numero LIKE :q OR s.type LIKE :q OR st.nom LIKE :q OR st.finessG LIKE :q')
                ->setParameter('q',"%{$filter->q}%");
        }

        if(!empty($filter->type)){
            $query = $query
                ->andWhere('s.type IN (:type)')
                ->setParameter('type',$filter->type);
        }

        if(!empty($filter->departement)){
            $query = $query
                ->andWhere('st.departement IN (:departement)')
                ->setParameter('departement',$filter->departement);
        }

        if(!empty($filter->longitude)){
            $query = $query
                ->andWhere('st.longitude IN (:longitude)')
                ->setParameter('longitude',$filter->longitude);
        } 

        if(!empty($filter->epidemie)){
            $query = $query
                ->andWhere('s.epidemie IN (:epidemie)')
                ->setParameter('epidemie',$filter->epidemie);
        }

        if(!empty($filter->infect)){
            $query = $query
                ->andWhere('i.id IN (:infect)')
                ->setParameter('infect',$filter->infect);
        }

        if(!empty($filter->serv)){
            $query = $query
                ->select('sv', 's')
                ->join('s.service', 'sv')
                ->andWhere('sv.id IN (:serv)')
                ->setParameter('serv',$filter->serv);
        }

        if(!empty($filter->dateMin)){
            $query = $query               
                ->andWhere('s.date >= :dateMin')
                ->setParameter('dateMin', $filter->dateMin, Types::DATE_IMMUTABLE);
        }

        if(!empty($filter->dateMax)){
            $query = $query             
                ->andWhere('s.date <= :dateMax')
                ->setParameter('dateMax', $filter->dateMax, Types::DATE_IMMUTABLE);
        }
        if(!empty($filter->scoreMin)){
            $query = $query
                ->andWhere('s.score >= :scoreMin')
                ->setParameter('scoreMin',$filter->scoreMin);
        }  
        if(!empty($filter->scoreMax)){
            $query = $query
                ->andWhere('s.score <= :scoreMax')
                ->setParameter('scoreMax',$filter->scoreMax);
        }
        if(!empty($filter->ARS)){
            $query = $query
                ->andWhere('s.ARS IN (:ARS)')
                ->setParameter('ARS',$filter->ARS);
        }
        if(!empty($filter->ES)){
            $query = $query
                ->andWhere('s.ES IN (:ES)')
                ->setParameter('ES',$filter->ES);
        }
        if(!empty($filter->CPIAS)){
            $query = $query
                ->andWhere('s.CPIAS IN (:CPIAS)')
                ->setParameter('CPIAS',$filter->CPIAS);
        }
        if(!empty($filter->SPF)){
            $query = $query
                ->andWhere('s.SPF IN (:SPF)')
                ->setParameter('SPF',$filter->SPF);
        }
        if(!empty($filter->souche)){
            $query = $query              
                ->select('so','s')
                ->join('s.souche', 'so')
                ->andWhere('so.laboratoire IN (:souche)')
                ->setParameter('souche',$filter->souche);
        }
        if(!empty($filter->contact)){
            $query = $query
                ->select('c','s')
                ->join('s.contact', 'c')
                ->andWhere('c.type IN (:contact)')
                ->setParameter('contact',$filter->contact);
        }
        return $query->getQuery()->getResult();    
    }

    // public function mapSearch(FilterData $filter): array
    // {
    //     $query = $this->createQueryBuilder('s')
    //         ->select('i', 's')
    //         ->select('st', 's')
    //         ->join('s.infection', 'i')
    //         ->join('s.structure', 'st');

    //     if(!empty($filter->longitude)){
    //         $query = $query
    //             ->andWhere('st.longitude IN (:longitude)')
    //             ->setParameter('longitude',$filter->longitude);
    //     } 
    // }
}
