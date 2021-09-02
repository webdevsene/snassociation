<?php

namespace App\DataFixtures;

use App\Entity\RegionSenegal as  Regions;
use App\DataFixtures\RegionSenegal;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Departement as EntityDepartement;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class Departement extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // foreach ($this->getDeptData() as [$nom]) {
        //     /**
        //      * @var Regions $reg
        //      */
        //     $reg = $this->getReference(RegionSenegal::REGION_REFERENCE);

        //     $dept = new EntityDepartement();
        //     $dept->setNom($nom);

        //     $reg->addDepartement($dept);
        //     $dept->setRegions($reg);

        //     $manager->persist($dept);
        // }

        // $manager->flush();
    }

    /* public function getDependencies()
    {
        return array(
            RegionSenegal::class,
        );
    } */
/* 
    private function getDeptData(): array
    {
        return [
            ['DAKAR'],
            ['RUFISQUE'],
            ['GUEDIAWAYE'],
        ];
    } */

  /*   public function getOrder()
    {
        return 2;
    } */
}
