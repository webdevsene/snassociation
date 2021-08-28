<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\Expr\Func;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use App\Repository\GestionAssociationRepository;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @ORM\Entity(repositoryClass=GestionAssociationRepository::class)
 * @Vich\Uploadable
 * @ORM\Table(name="gestion_association", indexes={@ORM\Index(columns={"denomination", "numero_recipice", "adresse_siege"}, flags={"fulltext"})})
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

    ///**
    // * @ORM\Column(type="string", length=255, nullable=true)
    // */
    //private $geolocalisation;

    /**
     * @var array
     * @ORM\Column(type="json")
     */
    private $geolocalisation = [];

    ///**
    // * ORM\Column(type="string", length=255, nullable=true)
    // * private $type;
    // */

    /**
     * @var array
     * @ORM\Column(type="json")
     */
    private $grande_rubrique = [];

    ///**
    // * @ORM\Column(type="string", length=255, nullable=true)
    // */
    //private $grande_rubrique;

    /**
     * @ORM\Column(type="date")
     */
    private $date_signature;

    /**
     * @ORM\ManyToOne(targetEntity=TypeAssociation::class, inversedBy="associations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $types;

    /**
     * @Gedmo\Slug(fields={"denomination"})
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
    * NOTE: This is not a mapped field of entity metadata, just a simple property.
    *
    * @Vich\UploadableField(mapping="uploads_files", fileNameProperty="filename")
    *
    * @var File|null
    */
    private $file;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTimeInterface|null
     */
    private $updatedAt;

    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $file
     */
    public function setFile(?File $file = null): void
    {
        $this->file = $file;

        if (null !== $file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

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

    public function getDateSignature(): ?\DateTimeInterface
    {
        return $this->date_signature;
    }

    public function setDateSignature(\DateTimeInterface $date_signature): self
    {
        $this->date_signature = $date_signature;

        return $this;
    }

    public function __tostring(): string
    {
        return $this->denomination;
    }

    public function getTypes(): ?TypeAssociation
    {
        return $this->types;
    }

    public function setTypes(?TypeAssociation $types): self
    {
        $this->types = $types;

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
     * Get the value of geolocalisation
     *
     * @return  array
     */
    public function getGeolocalisation(): array
    {
        //$geolocalisation = $this->geolocalisation ;

        //if (empty($geolocalisation)) {
        //    $geolocalisation[] = 'National';
        //}
        return $this->geolocalisation;
        //return array_unique($geolocalisation);
    }

    /**
     * Set the value of geolocalisation
     *
     * @param  array  $geolocalisation
     *
     * @return  self
     */
    public function setGeolocalisation(array $geolocalisation)
    {
        $this->geolocalisation = $geolocalisation;

        return $this;
    }

    /**
     * Get the value of grande_rubrique
     *
     * @return  array
     */
    public function getGrandeRubrique(): array
    {
        return $this->grande_rubrique;
    }

    /**
     * Set the value of grande_rubrique
     *
     * @param  array  $grande_rubrique
     *
     * @return  self
     */
    public function setGrandeRubrique(array $grande_rubrique)
    {
        $this->grande_rubrique = $grande_rubrique;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }
}
