<?php

namespace App\Entity;

use App\Repository\TypeAssociationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeAssociationRepository::class)
 */
class TypeAssociation
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
    private $cote;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=GestionAssociation::class, mappedBy="types", orphanRemoval=true)
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

    public function getCote(): ?string
    {
        return $this->cote;
    }

    public function setCote(string $cote): self
    {
        $this->cote = $cote;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

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
            $association->setTypes($this);
        }

        return $this;
    }

    public function removeAssociation(GestionAssociation $association): self
    {
        if ($this->associations->removeElement($association)) {
            // set the owning side to null (unless already changed)
            if ($association->getTypes() === $this) {
                $association->setTypes(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->description . '#' ;
    }
}
