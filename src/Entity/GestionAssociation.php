<?php

namespace App\Entity;

use App\Repository\GestionAssociationRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\Expr\Func;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=GestionAssociationRepository::class)
 * @ORM\Table(name="gestion_association", indexes={@ORM\Index(columns={"denomination", "numero_recipice", "adresse_siege"}, flags={"fulltext"})})
 * @Vich\Uploadable()
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
     * @ORM\Column(type="string", length=200, nullable=true)
     * @var string
     */
    private $recipisses;

    /**
     * @Vich\UploadableField(mapping="recipisses_load", fileNameProperty="recipisses")
     * @var File
     */
    private $recipissesFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    
    /**
     * @param mixed $recipissesFile
     * @throws \Exception
     */
    public function setRecipissesFile(File $recipissesFile = null): void
    {
        $this->$recipissesFile = $recipissesFile;
        if ($recipissesFile instanceof File) {
            $this->updatedAt = new \DateTime('now');
        }
    }

     /**
     * @return mixed
     */
    public function getRecipissesFile( )
    {
        return $this->recipissesFile;
    }

    public function setRecipisses(?string $recipisses): self
    {
        $this->recipisses = $recipisses;
        return $this;
    }

    public function getRecipisses(): ?string
    {
        return $this->recipisses;
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

    /**
     * Get the value of updatedAt
     *
     * @return  \DateTime
     */ 
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @param  \DateTime  $updatedAt
     *
     * @return  self
     */ 
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
