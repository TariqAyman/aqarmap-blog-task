<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:51 PM
 * Last Modified: 11/9/21, 2:25 PM
 * Project Name: aqarmap-blog-task
 * File Name: UserService.php
 */

declare(strict_types=1);

namespace App\Repository\Service;

use App\Entity\AbstractEntity;
use App\Entity\User;
use App\Repository\Service\Abstracts\AbstractDBService;
use App\Repository\UserRepository;
use App\Repository\Service\Interfaces\ActiveRecordInterface;
use PHPUnit\Runner\Exception;

/**
 * @package App\Service
 */
class UserService extends AbstractDBService
{
    /**
     * UserService constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * {@inheritdoc}
     */
    public function find(int $id): AbstractEntity
    {
        /** @var User $entity */
        $entity = $this->repository->find($id);

        if (!$entity) {
            throw new \Exception("User not found");
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
            $orderCriteria  = [$orderWith => $order];
        }
        return $this->repository->findBy($criteria, $orderCriteria, $counter, $offset);
    }

    /**
     * {@inheritdoc}
     * @throws \Exception
     */
    public function create(AbstractEntity $entity): AbstractEntity
    {
        throw new Exception("Method not needed");
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function update(AbstractEntity $entity): AbstractEntity
    {
        throw new Exception("Method not needed");
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function delete(int $id)
    {
        throw new Exception("Method not needed");
    }
}
