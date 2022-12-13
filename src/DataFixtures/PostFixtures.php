<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $post = new Post;
            $post->setTitle($faker->words(rand(3,10), true))
                ->setDescription($faker->paragraphs(rand(2, 10), true))
                ->setAuthor($faker->firstname())
                ->setImage('http://placeimg.com/30'.$i.'/300/any');
            
            for($j = 0; $j < rand(1, 3); $j++) {
                $post->addCategory($this->getReference('category' . rand(0, 4)));
            }
                

            $manager->persist($post);
        }

        $manager->flush();
    }
}
