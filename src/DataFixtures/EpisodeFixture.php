<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $episode = new Episode();
            $episode->setTitle('Episode ' . $i);
            $episode->setNumber($i);
            $episode->setSynopsis('C\'est l\'histoire de l\'épisode ' . $i);
            $episode->setSeason($this->getReference('saison_1'));
            $manager->persist($episode);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixture::class
        ];
    }
}
