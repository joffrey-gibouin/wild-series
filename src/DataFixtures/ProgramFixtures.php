<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify= $slugify;
    }
    public function load(ObjectManager $manager)
    {
        $program= new Program();
        $program->setTitle('True Detective');
        $program->setSummary('Louisiane, 1995 : deux inspecteurs de la Louisiana State Police, Rust Cohle et Martin Hart, sont chargés de résoudre le meurtre d\'une jeune femme coiffée de bois de cerfs et tatouée de dessins sataniques. Dix-sept ans plus tard, alors qu\'ils ont quitté la police, ils sont contactés par deux autres inspecteurs quand un meurtre similaire est commis.');
        $program->setCategory($this->getReference('category_5'));
        $program->setOwner(null);
        for ($i=0; $i < count(ActorFixture::ACTORS); $i++) {
            $program->addActor($this->getReference('actor_' . $i));
        }
        $program->setSlug($this->slugify->generate($program->getTitle()));
        $this->addReference('program_1', $program);
        $manager->persist($program);

        $program2= new Program();
        $program2->setTitle('Homeland');
        $program2->setSummary('Les histoires la folle Carry madison contre le reste du monde.');
        $program2->setCategory($this->getReference('category_5'));
        $program->setOwner(null);
        for ($i=0; $i < count(ActorFixture::ACTORS); $i++) {
            $program2->addActor($this->getReference('actor_' . $i));
        }
        $program2->setSlug($this->slugify->generate($program2->getTitle()));
        $this->addReference('program_2', $program2);
        $manager->persist($program2);

        $program3= new Program();
        $program3->setTitle('Game of Thrones');
        $program3->setSummary('Dallas version Fantasy');
        $program3->setCategory($this->getReference('category_1'));
        $program->setOwner(null);
        for ($i=0; $i < count(ActorFixture::ACTORS); $i++) {
            $program3->addActor($this->getReference('actor_' . $i));
        }
        $program3->setSlug($this->slugify->generate($program3->getTitle()));
        $this->addReference('program_3', $program3);
        $manager->persist($program3);

        $program4= new Program();
        $program4->setTitle('Westworld');
        $program4->setSummary('Des robots aux FarWest!');
        $program4->setCategory($this->getReference('category_0'));
        $program->setOwner(null);
        for ($i=0; $i < count(ActorFixture::ACTORS); $i++) {
            $program4->addActor($this->getReference('actor_' . $i));
        }
        $program4->setSlug($this->slugify->generate($program4->getTitle()));
        $this->addReference('program_4', $program4);
        $manager->persist($program4);

        $program5= new Program();
        $program5->setTitle('How i meet your mother');
        $program5->setSummary('Friends en plus fun');
        $program5->setCategory($this->getReference('category_0'));
        $program->setOwner(null);
        for ($i=0; $i < count(ActorFixture::ACTORS); $i++) {
            $program5->addActor($this->getReference('actor_' . $i));
        }
        $program5->setSlug($this->slugify->generate($program5->getTitle()));
        $this->addReference('program_5', $program5);
        $manager->persist($program5);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ActorFixture::class,
            CategoryFixtures::class,
        ];
    }
}
