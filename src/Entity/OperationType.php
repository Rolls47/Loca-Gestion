<?php

namespace App\Entity;

use App\Repository\OperationTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OperationTypeRepository::class)
 */
class OperationType
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
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=LocationAccounting::class, mappedBy="operationType")
     */
    private $locationAccountings;

    /**
     * @ORM\OneToMany(targetEntity=PropertyAccounting::class, mappedBy="operationType")
     */
    private $propertyAccountings;

    public function __construct()
    {
        $this->locationAccountings = new ArrayCollection();
        $this->propertyAccountings = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->type;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
            $locationAccounting->setOperationType($this);
        }

        return $this;
    }

    public function removeLocationAccounting(LocationAccounting $locationAccounting): self
    {
        if ($this->locationAccountings->removeElement($locationAccounting)) {
            // set the owning side to null (unless already changed)
            if ($locationAccounting->getOperationType() === $this) {
                $locationAccounting->setOperationType(null);
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
            $propertyAccounting->setOperationType($this);
        }

        return $this;
    }

    public function removePropertyAccounting(PropertyAccounting $propertyAccounting): self
    {
        if ($this->propertyAccountings->removeElement($propertyAccounting)) {
            // set the owning side to null (unless already changed)
            if ($propertyAccounting->getOperationType() === $this) {
                $propertyAccounting->setOperationType(null);
            }
        }

        return $this;
    }
}
