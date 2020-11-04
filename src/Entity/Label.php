<?php

namespace App\Entity;

use App\Repository\LabelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LabelRepository::class)
 */
class Label
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=LocationAccounting::class, mappedBy="label")
     */
    private $locationAccountings;

    /**
     * @ORM\OneToMany(targetEntity=PropertyAccounting::class, mappedBy="label")
     */
    private $propertyAccountings;

    public function __construct()
    {
        $this->locationAccountings = new ArrayCollection();
        $this->propertyAccountings = new ArrayCollection();
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
            $locationAccounting->setLabel($this);
        }

        return $this;
    }

    public function removeLocationAccounting(LocationAccounting $locationAccounting): self
    {
        if ($this->locationAccountings->removeElement($locationAccounting)) {
            // set the owning side to null (unless already changed)
            if ($locationAccounting->getLabel() === $this) {
                $locationAccounting->setLabel(null);
            }
        }

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
            $propertyAccounting->setLabel($this);
        }

        return $this;
    }

    public function removePropertyAccounting(PropertyAccounting $propertyAccounting): self
    {
        if ($this->propertyAccountings->removeElement($propertyAccounting)) {
            // set the owning side to null (unless already changed)
            if ($propertyAccounting->getLabel() === $this) {
                $propertyAccounting->setLabel(null);
            }
        }

        return $this;
    }
}
