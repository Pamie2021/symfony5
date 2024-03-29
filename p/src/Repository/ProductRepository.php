<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
    * @return Product[] Returns an array of Product objects
   */
    public function findWithSearch($search)
    {
        $query = $this->createQueryBuilder('p');
           //dd($query->getQuery()); visualise la requete
           if($search->getMinPrice()){
            $query = $query->andWhere('p.price > '.$search->getMinPrice()*100);
           }//structuration de la requete avec les paramètres
           if($search->getMaxPrice()){
            $query = $query->andWhere('p.price < '.$search->getMaxPrice()*100);
           }
           
           if($search->getCategories()){
            $query = $query->join('p.category', 'c')
                           ->andWhere('c.id IN (:categories)')
                           ->setParameter('categories',$search->getCategories());
           }
           //dd($query->getQuery()->getResult());
           return $query->getQuery()->getResult();
        ;
    }
    
    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
