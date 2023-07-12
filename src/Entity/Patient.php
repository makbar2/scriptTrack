<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
class Patient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $firstName = null;

    #[ORM\Column(length: 100)]
    private ?string $surname = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dob = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $collectionDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $orderDate = null;

    #[ORM\Column]
    private ?int $orderFrequency = null;

    #[ORM\Column(length: 125)]
    private ?string $gpEmail = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(\DateTimeInterface $dob): static
    {
        $this->dob = $dob;

        return $this;
    }

    public function getCollectionDate(): ?\DateTimeInterface
    {
        return $this->collectionDate;
    }

    public function setCollectionDate(\DateTimeInterface $collectionDate): static
    {
        $this->collectionDate = $collectionDate;

        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): static
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getOrderFrequency(): ?int
    {
        return $this->orderFrequency;
    }

    public function setOrderFrequency(int $orderFrequency): static
    {
        $this->orderFrequency = $orderFrequency;

        return $this;
    }

    public function getGpEmail(): ?string
    {
        return $this->gpEmail;
    }

    public function setGpEmail(string $gpEmail): static
    {
        $this->gpEmail = $gpEmail;

        return $this;
    }


}
