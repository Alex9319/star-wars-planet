<?php

namespace App\Entity;

use App\Repository\PlanetsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanetsRepository::class)]
class Planets
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $rotation_period = null;

    #[ORM\Column(nullable: true)]
    private ?int $orbital_period = null;

    #[ORM\Column(nullable: true)]
    private ?int $diameter = null;

    #[ORM\Column(nullable: true)]
    private ?int $films_count = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $edited = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getRotationPeriod(): ?int
    {
        return $this->rotation_period;
    }

    public function setRotationPeriod(?int $rotation_period): self
    {
        $this->rotation_period = $rotation_period;

        return $this;
    }

    public function getOrbitalPeriod(): ?int
    {
        return $this->orbital_period;
    }

    public function setOrbitalPeriod(?int $orbital_period): self
    {
        $this->orbital_period = $orbital_period;

        return $this;
    }

    public function getDiameter(): ?int
    {
        return $this->diameter;
    }

    public function setDiameter(?int $diameter): self
    {
        $this->diameter = $diameter;

        return $this;
    }

    public function getFilmsCount(): ?int
    {
        return $this->films_count;
    }

    public function setFilmsCount(?int $films_count): self
    {
        $this->films_count = $films_count;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getEdited(): ?\DateTimeInterface
    {
        return $this->edited;
    }

    public function setEdited(?\DateTimeInterface $edited): self
    {
        $this->edited = $edited;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
