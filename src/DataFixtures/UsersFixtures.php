<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:40 PM
 * Last Modified: 11/10/21, 3:49 AM
 * Project Name: aqarmap-blog-task
 * File Name: UsersFixtures.php
 */

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersFixtures extends BaseFixture
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        /**
         * @throws \Exception
         */
        $this->createMany(User::class, 10, function (User $user) {
            $user->setFirstName($this->faker->firstName);
            $user->setEmail($this->faker->safeEmail);

            $password = $this->encoder->encodePassword($user, 'password');
            $user->setPassword($password);

        });

        $manager->flush();
    }
}
