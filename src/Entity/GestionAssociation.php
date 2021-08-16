<?php

namespace App\Entity;

use App\Repository\GestionAssociationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GestionAssociationRepository::class)
 */
class GestionAssociation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=RegionSenegal::class, inversedBy="associations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $regions;

    /**
     * @ORM\ManyToOne(targetEntity=Departement::class, inversedBy="associations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $departements;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero_recipice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $denomination;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_siege;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $geolocalisation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $grande_rubrique;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegions(): ?RegionSenegal
    {
        return $this->regions;
    }

    public function setRegions(?RegionSenegal $regions): self
    {
        $this->regions = $regions;

        return $this;
    }

    public function getDepartements(): ?Departement
    {
        return $this->departements;
    }

    public function setDepartements(?Departement $departements): self
    {
        $this->departements = $departements;

        return $this;
    }

    public function getNumeroRecipice(): ?string
    {
        return $this->numero_recipice;
    }

    public function setNumeroRecipice(string $numero_recipice): self
    {
        $this->numero_recipice = $numero_recipice;

        return $this;
    }

    public function getDenomination(): ?string
    {
        return $this->denomination;
    }

    public function setDenomination(string $denomination): self
    {
        $this->denomination = $denomination;

        return $this;
    }

    public function getAdresseSiege(): ?string
    {
        return $this->adresse_siege;
    }

    public function setAdresseSiege(string $adresse_siege): self
    {
        $this->adresse_siege = $adresse_siege;

        return $this;
    }

    public function getGeolocalisation(): ?string
    {
        return $this->geolocalisation;
    }

    public function setGeolocalisation(?string $geolocalisation): self
    {
        $this->geolocalisation = $geolocalisation;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getGrandeRubrique(): ?string
    {
        return $this->grande_rubrique;
    }

    public function setGrandeRubrique(?string $grande_rubrique): self
    {
        $this->grande_rubrique = $grande_rubrique;

        return $this;
    }
}
