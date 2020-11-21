<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 */
class Property
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comment;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=PropertyType::class, inversedBy="properties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $propertyType;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="properties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $location;

    /**
     * @ORM\OneToMany(targetEntity=PropertyAccounting::class, mappedBy="property")
     */
    private $propertyAccountings;

    public function __construct()
    {
        $this->propertyAccountings = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getPropertyType(): ?PropertyType
    {
        return $this->propertyType;
    }

    public function setPropertyType(?PropertyType $propertyType): self
    {
        $this->propertyType = $propertyType;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection|PropertyAccounting[]
     */
    public function getPropertyAccountings(): Collection
    {
        return $this->propertyAccountings;
    }

    public function addPropertyAccounting(PropertyAccounting $propertyAccounting): self
    {
        if (!$this->propertyAccountings->contains($propertyAccounting)) {
            $this->propertyAccountings[] = $propertyAccounting;
            $propertyAccounting->setProperty($this);
        }

        return $this;
    }

    public function removePropertyAccounting(PropertyAccounting $propertyAccounting): self
    {
        if ($this->propertyAccountings->removeElement($propertyAccounting)) {
            // set the owning side to null (unless already changed)
            if ($propertyAccounting->getProperty() === $this) {
                $propertyAccounting->setProperty(null);
            }
        }

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
}
