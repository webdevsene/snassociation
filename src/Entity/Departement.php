<?php

namespace App\Entity;

use App\Entity\RegionSenegal;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DepartementRepository;

/**
 * @ORM\Entity(repositoryClass=DepartementRepository::class)
 */
class Departement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;
 
    /**
     * @var RegionSenegal $region
     *
     * @ORM\ManyToOne(targetEntity="RegionSenegal", inversedBy="departements", cascade={"persist", "merge"})
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_region", referencedColumnName="id")
     * })
     */
     private $regions;

     /**
      * @ORM\OneToMany(targetEntity=GestionAssociation::class, mappedBy="departements", orphanRemoval=true)
      */
     private $associations;

     public function __construct()
     {
         $this->associations = new ArrayCollection();
     }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
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
            $association->setDepartements($this);
        }

        return $this;
    }

    public function removeAssociation(GestionAssociation $association): self
    {
        if ($this->associations->removeElement($association)) {
            // set the owning side to null (unless already changed)
            if ($association->getDepartements() === $this) {
                $association->setDepartements(null);
            }
        }

        return $this;
    }
}
