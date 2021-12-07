<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 5; $i++) {
            $season = new Season();
            $season->setDescription('Saison '. $i);
            $season->setNumber($i);
            $season->setYear(2010 + $i);
            $season->setProgram($this->getReference('program_1'));
            $this->addReference('saison_' . $i, $season);
            $manager->persist($season);
        }




        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            ProgramFixtures::class
        ];
    }
}
