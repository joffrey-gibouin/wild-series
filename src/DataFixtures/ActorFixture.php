<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixture extends Fixture
{
    const ACTORS = [
        'Claires Danes',
        'Mandy Patinkin',
        'Rupert Friend',
        'Damian Lewis',
        'Kaley Cuoco',
        'Jim Parsons',
        'Johnny Galecki',
        'Norman Reedus',
        'Andrew Lincoln',
        'Lauren Cohan',
        'Jeffrey Dean Morgan',
        'Chandler Riggs',
    ];
    public function load(ObjectManager $manager)
    {
        foreach (Self::ACTORS as $key => $actorName) {
            $actor = new Actor();
            $actor->setName($actorName);
            $manager->persist($actor);
            $this->addReference('actor_' .$key, $actor);
        }
        $manager->flush();
    }
}
