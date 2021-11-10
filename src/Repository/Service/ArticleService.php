<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:51 PM
 * Last Modified: 11/9/21, 6:00 PM
 * Project Name: aqarmap-blog-task
 * File Name: ArticleService.php
 */
namespace App\Repository\Service;

use App\Entity\AbstractEntity;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\Service\Abstracts\AbstractDBService;
use App\Repository\Service\Interfaces\ActiveRecordInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @package App\Repository\Service
 */
class ArticleService extends AbstractDBService
{
    /**
     * @var ManagerRegistry
     */
    private ManagerRegistry $doctrineManager;

    /**
     * ArticleService constructor.
     * @param ArticleRepository $repository
     * @param ManagerRegistry $manager
     */
    public function __construct(ArticleRepository $repository, ManagerRegistry $manager)
    {
        parent::__construct($repository);
        $this->doctrineManager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function find(int $id): AbstractEntity
    {
        /** @var Article $entity */
        $entity = $this->repository->find($id);

        if (!$entity) {
            throw new \Exception("Article not found");
        }

        return $entity;
    }

    /**
     * {@inheritdoc}
     */
    public function findByCriteria(array $criteria, int $counter = ActiveRecordInterface::DEFAULT_COUNTER, int $offset = 0, string $order = ActiveRecordInterface::ASC, string $orderWith = null): array
    {
        $orderCriteria = [];
        if ($orderWith) {
            $orderCriteria = [$orderWith => $order];
        }
        return $this->repository->findBy($criteria, $orderCriteria, $counter, $offset);
    }

    /**
     * {@inheritdoc}
     * @param Article $entity
     * @throws \Exception
     */
    public function create(AbstractEntity $entity): AbstractEntity
    {
        $entityManager = $this->doctrineManager->getManager();
        $entityManager->persist($entity);
        $entityManager->flush();

        return $this->find($entity->getId());
    }

    /**
     * {@inheritdoc}
     * @throws \Exception
     */
    public function update(AbstractEntity $entity): AbstractEntity
    {
        throw new \Exception("Method not needed");
    }

    /**
     * {@inheritdoc}
     * @throws \Exception
     */
    public function delete(int $id)
    {
        throw new \Exception("Method not needed");
    }

    /**
     * @param int $categoryId
     * @return array
     */
    public function findByCategoryId(int $categoryId): array
    {
        return $this->repository->getArticlesFilteredByCategory($categoryId);
    }
}
