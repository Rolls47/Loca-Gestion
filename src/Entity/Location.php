<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
class Location
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
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity=Property::class, mappedBy="location")
     */
    private $properties;

    /**
     * @ORM\OneToMany(targetEntity=LocationAccounting::class, mappedBy="location")
     */
    private $locationAccountings;

    public function __construct()
    {
        $this->properties = new ArrayCollection();
        $this->locationAccountings = new ArrayCollection();
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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

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

    /**
     * @return Collection|Property[]
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(Property $property): self
    {
        if (!$this->properties->contains($property)) {
            $this->properties[] = $property;
            $property->setLocation($this);
        }

        return $this;
    }

    public function removeProperty(Property $property): self
    {
        if ($this->properties->removeElement($property)) {
            // set the owning side to null (unless already changed)
            if ($property->getLocation() === $this) {
                $property->setLocation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LocationAccounting[]
     */
    public function getLocationAccountings(): Collection
    {
        return $this->locationAccountings;
    }

    public function addLocationAccounting(LocationAccounting $locationAccounting): self
    {
        if (!$this->locationAccountings->contains($locationAccounting)) {
            $this->locationAccountings[] = $locationAccounting;
            $locationAccounting->setLocation($this);
        }

        return $this;
    }

    public function removeLocationAccounting(LocationAccounting $locationAccounting): self
    {
        if ($this->locationAccountings->removeElement($locationAccounting)) {
            // set the owning side to null (unless already changed)
            if ($locationAccounting->getLocation() === $this) {
                $locationAccounting->setLocation(null);
            }
        }

        return $this;
    }
}
