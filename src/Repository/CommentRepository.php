<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:52 PM
 * Last Modified: 11/9/21, 2:07 PM
 * Project Name: aqarmap-blog-task
 * File Name: CommentRepository.php
 */

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends AbstractDBRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }
}
