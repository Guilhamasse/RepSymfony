<?php

namespace App\DataFixtures;

use App\Factory\ArtisteFactory;
use App\Factory\ChansonFactory;
use App\Factory\TypeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DiscoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        TypeFactory::createOne(["type" => "auteur", "description" => "auteur"]);
        TypeFactory::createOne(["type" => "compositeur", "description" => "compositeur"]);
        TypeFactory::createOne(["type" => "interprete", "description" => "interprete"]);
        TypeFactory::createOne(["type" => "arrangeur", "description" => "arrangeur"]);
        TypeFactory::createOne(["type" => "musicien", "description" => "musicien"]);

        ArtisteFactory::createMany(50, ['type' => TypeFactory::random()]);
        ChansonFactory::createMany(50, ['artiste' => ArtisteFactory::randomRange(1, 3)]);

        $manager->flush();
    }
}
