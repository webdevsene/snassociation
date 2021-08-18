<?php

namespace App\Entity;

use App\Repository\AssociationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AssociationRepository::class)
 */
class Association
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="numero_recepisse")
     */
    private $numero_recepisse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $denomination;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_siege;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_de_signature;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $region ;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $departement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $geolocalisation ;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type ;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $grande_rubrique ;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $machine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    // private $slug;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateDeSignature(): ?\DateTimeInterface
    {
        return $this->date_de_signature;
    }

    public function setDateDeSignature(?\DateTimeInterface $date_de_signature): self
    {
        $this->date_de_signature = $date_de_signature;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(?string $departement): self
    {
        $this->departement = $departement;

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

    public function setGrandeRubrique(string $grande_rubrique): self
    {
        $this->grande_rubrique = $grande_rubrique;

        return $this;
    }

    public function getMachine(): ?string
    {
        return $this->machine;
    }

    public function setMachine(?string $machine): self
    {
        $this->machine = $machine;

        return $this;
    }
/* 
    public function getSlug(): ?string
    {
        return $this->slug;
    } */
/* 
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    } */

    public function __toString()
    {
        return $this->denomination;
    }

    /**
     * Get the value of numero_recepisse
     */ 
    public function getNumero_recepisse()
    {
        return $this->numero_recepisse;
    }

    /**
     * Set the value of numero_recepisse
     *
     * @return  self
     */
    public function setNumero_recepisse($numero_recepisse)
    {
        $this->numero_recepisse = $numero_recepisse;

        return $this;
    }
}
