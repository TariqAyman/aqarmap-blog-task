<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:50 PM
 * Last Modified: 11/9/21, 1:59 PM
 * Project Name: aqarmap-blog-task
 * File Name: ActiveRecordInterface.php
 */

namespace App\Repository\Service\Interfaces;

use App\Entity\AbstractEntity;

/**
 * @package App\Service\Interfaces
 */
interface ActiveRecordInterface
{
    /**
     * @const ActiveRecordInterface::DESC
     */
    const DESC = 'DESC';

    /**
     * @const ActiveRecordInterface::ASC
     */
    const ASC = 'ASC';

    /**
     * @const ActiveRecordInterface::DEFAULT_COUNTER
     */
    const DEFAULT_COUNTER = 100;

    /**
     * @param int $id
     * @return AbstractEntity
     * @throws \Exception
     */
    public function find(int $id) : AbstractEntity;

    /**
     * @param array $criteria
     * @param int $counter
     * @param int $offset
     * @param string $order
     * @param string|null $orderWith
     * @return array
     */
    public function findByCriteria(array $criteria, int $counter = ActiveRecordInterface::DEFAULT_COUNTER, int $offset = 0, string $order = ActiveRecordInterface::ASC, string $orderWith = null) : array;

    /**
     * @param AbstractEntity $entity
     * @return AbstractEntity
     */
    public function create(AbstractEntity $entity) : AbstractEntity;

    /**
     * @param AbstractEntity $entity
     * @return AbstractEntity
     */
    public function update(AbstractEntity $entity) : AbstractEntity;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id);
}
