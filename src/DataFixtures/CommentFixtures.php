<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $faker=Factory::create('fr_FR');

        for ($i=0; $i < 40 ; $i++)
        {
            $comment=new Comment;
            
            $comment    ->setContent($faker->words(rand(25,60), true))
                        ->setUser($this->getReference('user' . rand(0, 4)))
                        ->setPost($this->getReference('post' . rand(0, 9)))
            ;
            $manager->persist($comment);
    
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            PostFixtures::class
        ];
    }
}
