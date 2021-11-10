<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:58 PM
 * Last Modified: 7/16/19, 9:17 AM
 * Project Name: aqarmap-blog-task
 * File Name: CurrentLoginUserIsAdminExtension.php
 */

namespace App\Twig;

use App\Entity\User;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * @package App\Twig
 */
class CurrentLoginUserIsAdminExtension extends AbstractExtension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new TwigFilter('isUserAdmin', [$this, 'isCurrentLoginUserWithAdminRole'])
        ];
    }

    /**
     * @param User $currentUser
     * @return bool
     */
    public function isCurrentLoginUserWithAdminRole(User $currentUser): bool
    {
        return true;
//        return ($currentUser->getRole() === User::ADMIN_ROLE);
    }
}
