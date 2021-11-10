<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:51 PM
 * Last Modified: 11/10/21, 4:03 AM
 * Project Name: aqarmap-blog-task
 * File Name: ArticleRepository.php
 */

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends AbstractDBRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param int $categoryId
     * @return array
     */
    public function getArticlesFilteredByCategory(int $categoryId) : array
    {
        $query = $this->createQueryBuilder('a')
            ->andWhere('a.category = :categoryId')
            ->setParameter('categoryId', $categoryId)
            ->addOrderBy('a.publishedAt', 'DESC')
            ->getQuery();

        return $query->execute();
    }
}
