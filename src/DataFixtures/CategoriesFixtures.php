<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:38 PM
 * Last Modified: 11/9/21, 11:06 PM
 * Project Name: aqarmap-blog-task
 * File Name: CategoriesFixtures.php
 */

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;

class CategoriesFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Category::class, 10, function (Category $category) {
            $category->setName($this->faker->name);
        });

        $manager->flush();
    }
}
