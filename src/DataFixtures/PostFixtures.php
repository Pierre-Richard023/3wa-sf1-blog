<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $post = new Post;
            $post->setTitle('titre n° ' . $i)
                ->setDescription('Description n° ' . $i)
                ->setAuthor('camile');

            $manager->persist($post);
        }

        $manager->flush();
    }
}
