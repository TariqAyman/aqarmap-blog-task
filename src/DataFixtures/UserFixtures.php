<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:40 PM
 * Last Modified: 11/10/21, 3:45 AM
 * Project Name: aqarmap-blog-task
 * File Name: UserFixtures.php
 */

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture
{

    const USER_REFERENCE = 'admin';

    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstName('admin');
        $user->setEmail('admin@admin.com');

        $password = $this->encoder->encodePassword($user, 'password');
        $user->setPassword($password);

        $this->addReference(self::USER_REFERENCE, $user);

        $manager->persist($user);
        $manager->flush();
    }
}
