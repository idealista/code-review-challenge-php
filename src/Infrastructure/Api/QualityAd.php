<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use DateTime;

class QualityAd
{
    private int $id;
    private String $typology;
    private String $description;
    private array $pictureUrls;
    private int $houseSize;
    private ?int $gardenSize;
    private ?int $score;
    private ?DateTime $irrelevantSince;

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

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): void
    {
        $this->score = $score;
    }

    public function getIrrelevantSince(): ?DateTime
    {
        return $this->irrelevantSince;
    }

    public function setIrrelevantSince(?DateTime $irrelevantSince): void
    {
         $this->irrelevantSince = $irrelevantSince;
    }
}