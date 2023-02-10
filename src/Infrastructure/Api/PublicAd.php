<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

class PublicAd
{
    private int $id;
    private String $typology;
    private String $description;
    private array $pictureUrls;
    private int $houseSize;
    private ?int $gardenSize;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTypology(): String
    {
        return $this->typology;
    }

    public function setTypology(String $typology): void
    {
        $this->typology = $typology;
    }

    public function getDescription(): String
    {
        return $this->description;
    }

    public function setDescription(String $description): void
    {
        $this->description = $description;
    }

    public function getPictureUrls(): array
    {
        return $this->pictureUrls;
    }

    public function setPictureUrls(array $pictureUrls): void
    {
        $this->pictureUrls = $pictureUrls;
    }

    public function getHouseSize(): int
    {
        return $this->houseSize;
    }

    public function setHouseSize(int $houseSize): void
    {
        $this->houseSize = $houseSize;
    }

    public function getGardenSize(): ?int
    {
        return $this->gardenSize;
    }

    public function setGardenSize(?int $gardenSize): void
    {
        $this->gardenSize = $gardenSize;
    }
}