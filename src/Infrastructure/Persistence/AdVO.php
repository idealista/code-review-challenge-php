<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use DateTime;

class AdVO
{
    public function __construct(
        private ?int $id = null,
        private ?String $typology = null,
        private ?String $description = null,
        private ?array $pictures = null,
        private ?int $houseSize = null,
        private ?int $gardenSize = null,
        private ?int $score = null,
        private ?DateTime $irrelevantSince = null,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTypology(): ?String
    {
        return $this->typology;
    }

    public function setTypology(String $typology): void
    {
        $this->typology = $typology;
    }

    public function getDescription(): ?String
    {
        return $this->description;
    }

    public function setDescription(String $description): void
    {
        $this->description = $description;
    }

    public function getPictures(): ?array
    {
        return $this->pictures;
    }

    public function setPictures(array $pictures): void
    {
        $this->pictures = $pictures;
    }

    public function getHouseSize(): ?int
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

    public function setGardenSize(int $gardenSize): void
    {
        $this->gardenSize = $gardenSize;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    public function getIrrelevantSince(): ?DateTime
    {
        return $this->irrelevantSince;
    }

    public function setIrrelevantSince(DateTime $irrelevantSince): void
    {
        $this->irrelevantSince = $irrelevantSince;
    }
}

