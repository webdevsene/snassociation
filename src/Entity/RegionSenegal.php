<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RegionSenegalRepository;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=RegionSenegalRepository::class)
 */
class RegionSenegal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomreg;
 
    /**
    * @var ArrayCollection $departements
    *
    * @ORM\OneToMany(targetEntity="Departement", mappedBy="region", cascade={"persist", "remove", "merge"})
    */
    private $departements;

    /**
     * @ORM\OneToMany(targetEntity=GestionAssociation::class, mappedBy="regions", orphanRemoval=true)
     */
    private $associations;

    public function __construct()
    {
        $this->departements = new ArrayCollection();
        $this->associations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getNomreg(): ?string
    {
        return $this->nomreg;
    }

    public function setNomreg(string $nomreg): self
    {
        $this->nomreg = $nomreg;

        return $this;
    }

    /**
     * @param  Departement $departement
     */
    public function addDepartement(Departement $departement)
    {
       // $departement->setRegion($this);
 
        // Si l'objet fait déjà partie de la collection on ne l'ajoute pas
        if (!$this->departements->contains($departement)) {
            $this->departements[] = $departement ;
            $departement->setRegions($this);
        }

        return $this;
    }

    /**
     * @return ArrayCollection $departements
     */
    public function getDepartements(){
        return $this->departements ;
    }

    /**
     * @return Collection|GestionAssociation[]
     */
    public function getAssociations(): Collection
    {
        return $this->associations;
    }

    public function addAssociation(GestionAssociation $association): self
    {
        if (!$this->associations->contains($association)) {
            $this->associations[] = $association;
            $association->setRegions($this);
        }

        return $this;
    }

    public function removeAssociation(GestionAssociation $association): self
    {
        if ($this->associations->removeElement($association)) {
            // set the owning side to null (unless already changed)
            if ($association->getRegions() === $this) {
                $association->setRegions(null);
            }
        }

        return $this;
    }
}
