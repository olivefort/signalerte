<?php

namespace App\Repository;

use App\Model\SearchData;
use App\Entity\Signalement;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Signalement>
 */
class SignalementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Signalement::class);
    }

    public function findBySearch(SearchData $searchData): PaginatorInterface
    {
        $data = $this->createQueryBuilder('u')
            ->from(Signalement::class, 'u')
            ->where('u.type LIKE :type')
            ->setParameter('type', '%%');
            // ->addOrderBy('p.createdAt', 'DESC');

        if(!empty($searchData->q)){
            $data = $data
            ->andWhere('u.type = :q')
            ->setParameter('q', '%{$searchData->q}%');
        }
        
        $data = $data
        ->getQuery()
        // dd($data)
        ->getResult();
        $posts = $this->paginatorInterface->paginate($data, $searchData->page, 9);

        return $posts;
    }
}
