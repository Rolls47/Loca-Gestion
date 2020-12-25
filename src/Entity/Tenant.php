<?php

namespace App\Entity;

use App\Repository\TenantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TenantRepository::class)
 */
class Tenant
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
    private $firstName;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lastName;

    /**
     * @ORM\Column(type="date")
     */
    private $entry;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $leaveAccommodation;

    /**
     * @ORM\ManyToOne(targetEntity=Property::class, inversedBy="tenants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $property;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEntry(): ?\DateTimeInterface
    {
        return $this->entry;
    }

    public function setEntry(\DateTimeInterface $entry): self
    {
        $this->entry = $entry;

        return $this;
    }

    public function getLeaveAccommodation(): ?\DateTimeInterface
    {
        return $this->leaveAccommodation;
    }

    public function setLeaveAccommodation(?\DateTimeInterface $leaveAccommodation): self
    {
        $this->leaveAccommodation = $leaveAccommodation;

        return $this;
    }

    public function getProperty(): ?Property
    {
        return $this->property;
    }

    public function setProperty(?Property $property): self
    {
        $this->property = $property;

        return $this;
    }
}
