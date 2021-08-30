<?php

namespace App\DataFixtures;

use DateTime;
use DateTimeImmutable;
use App\Entity\TypeAssociation;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class TypesAssociations extends Fixture
{
    private $slugger;

    public function __construct(SluggerInterface $slugger) {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->getTypeData() as [$cote, $description, $slug, $createdAt]) {
            // instancier un objet $Type
            $types = new TypeAssociation();
            $types->setCote($cote);
            $types->setDescription($description);
            $types->setSlug($slug);
            $types->setCreatedAt($createdAt);

            // persister l'entity en base
            $manager->persist($types);
        }

        $manager->flush();
    }

    private function getTypeData(): array
    {
        //$slug = $this->slugger->slug();
        $createdAt = new \DateTimeImmutable('now');

        return[
            // $typeData = [$cote, $description, $slug, $createdAt]
            ['General', 'Général', $this->slugger->slug(''), $createdAt],
            ['ASC', 'Association Sportive et Culturelle (ASC)', $this->slugger->slug('Association Sportive et Culturelle (ASC)'), $createdAt],
            ['DC', 'Développement Communaitaire (DC)', $this->slugger->slug('Développement Communaitaire DC'), $createdAt],
            ['AR', 'Association Religieuse (AR)', $this->slugger->slug('Association Religieuse AR'), $createdAt],
            ['APROF', 'Association Professionnelle (APROF)', $this->slugger->slug('Association Professionnelle APROF'), $createdAt],
            ['ED', 'Association Educative (ED)', $this->slugger->slug('Association Educative ED'), $createdAt],
        ];
    }
}
