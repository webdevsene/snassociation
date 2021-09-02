<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\RegionSenegal as EntityRegionSenegal;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class RegionSenegal extends Fixture implements OrderedFixtureInterface
{
    public const REGION_REFERENCE = 'regions';

    public function load(ObjectManager $manager)
    {
        foreach ($this->getRegionData() as [$code, $nomreg]) {
            $region = new EntityRegionSenegal();
            $region->setCode($code);
            $region->setNomreg($nomreg);

            // On associe les departements pour cette/chaque region
            // $depts = new Departement();
            // $region->addDepartement($depts, $manager);

            $manager->persist($region);


            // ajouter la reference pour la relation ManyToOne avec departement
            // $this->addReference(self::REGION_REFERENCE, $region);

            // $this->setReference(self::REGION_REFERENCE, $region);
        }

        $manager->flush();

    }

    private function getRegionData(): array
    {
        return [
            ['DK', 'DAKAR'],
            ['DL', 'DIOURBEL'],
            ['FT', 'FATICK'],
            ['KF', 'KAFFRINE'],
            ['KL', 'KAOLACK'],
            ['KG', 'KEDOUGOU'],
            ['KD', 'KOLDA'],
            ['LG', 'LOUGA'],
            ['MT', 'MATAM'],
            ['SL', 'SAINT-LOUIS'],
            ['SDH', 'SEDHIOU'],
            ['TMB', 'TAMBACOUNDA'],
            ['TH', 'THIES'],
            ['ZG', 'ZIGUINCHOR'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
