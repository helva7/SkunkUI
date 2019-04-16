<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationRepository")
 */
class Location
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dog_name;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=10, nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=10, nullable=true)
     */
    private $longitude;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=3, nullable=true)
     */
    private $speed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDogName(): ?string
    {
        return $this->dog_name;
    }

    public function setDogName(string $dog_name): self
    {
        $this->dog_name = $dog_name;

        return $this;
    }

    public function getLatitude(): ?int
    {
        return $this->latitude;
    }

    public function setLatitude(?int $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?int
    {
        return $this->longitude;
    }

    public function setLongitude(?int $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(?int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }
}
