<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:50 PM
 * Last Modified: 11/9/21, 6:00 PM
 * Project Name: aqarmap-blog-task
 * File Name: AbstractDBService.php
 */

namespace App\Repository\Service\Abstracts;

use App\Repository\AbstractDBRepository;
use App\Repository\Service\Interfaces\ActiveRecordInterface;

/**
 * @package App\Service\Abstracts
 */
abstract class AbstractDBService implements ActiveRecordInterface
{
    /**
     * @var AbstractDBRepository
     */
    protected AbstractDBRepository $repository;

    /**
     * AbstractDBService constructor.
     * @param AbstractDBRepository $repository database repository instance
     */
    public function __construct(AbstractDBRepository $repository)
    {
        $this->repository = $repository;
    }
}
