<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 11/10/21, 7:38 PM
 * Last Modified: 11/9/21, 10:56 PM
 * Project Name: aqarmap-blog-task
 * File Name: ArticleFixtures.php
 */

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Article::class, 10, function (Article $article) {
            $article->setTitle($this->faker->jobTitle)->setContent($this->faker->text);
            $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
            $article->setAuthor($this->getReference(UserFixtures::USER_REFERENCE));
            $article->setCategory($this->getReference(CategoryFixtures::CATEGORY_REFERENCE));
        });

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            CategoryFixtures::class
        ];
    }
}
