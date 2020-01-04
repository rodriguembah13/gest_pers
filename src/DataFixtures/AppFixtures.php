<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($count = 2; $count < 20; ++$count) {
            $article = new Departement();
            $article->setLibelle('Titre '.$count);
            $article->setCode('Uri Fixture'.$count);
            $manager->persist($article);
        }
        $manager->flush();
    }
}
