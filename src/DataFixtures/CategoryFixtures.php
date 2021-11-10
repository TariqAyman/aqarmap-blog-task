<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:39 PM
 * Last Modified: 11/9/21, 10:55 PM
 * Project Name: aqarmap-blog-task
 * File Name: CategoryFixtures.php
 */

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends BaseFixture
{
    const CATEGORY_REFERENCE = 'category';

    protected function loadData(ObjectManager $manager)
    {
        $product = new Category();
        $product->setName($this->faker->name);
        $this->addReference(self::CATEGORY_REFERENCE, $product);

        $manager->persist($product);

        $manager->flush();
    }
}
