<?php

declare(strict_types=1);

namespace App\Domain;

use DateTime;

class Ad
{
    public function __construct(
        private int $id,
        private Typology $typology,
        private String $description,
        private array $pictures,
        private int $houseSize,
        private ?int $gardenSize = null,
        private ?int $score = null,
        private ?DateTime $irrelevantSince = null,
    ) {
    }

    public function isComplete(): bool {
        return (Typology::GARAGE->equals($this->typology) && !empty($this->pictures))
            || (Typology::FLAT->equals($this->typology) && !empty($this->pictures) && $this->description != null && !empty($this->description) && $this->houseSize != null)
            || (Typology::CHALET->equals($this->typology) && !empty($this->pictures) && $this->description != null && !empty($this->description) && $this->houseSize != null && $this->gardenSize != null);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTypology(): Typology
    {
        return $this->typology;
    }

    public function setTypology(Typology $typology): void
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

    public function getPictures(): array
    {
        return $this->pictures;
    }

    public function setPictures(array $pictures): void
    {
        $this->pictures = $pictures;
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

    public function setGardenSize(int $gardenSize): void
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

    public function equals(object $o): bool
    {
        if ($this === $o) return true;
        if ($o === null || self::class !== $o::class) return false;

        foreach (get_object_vars($this) as $property => $value) {
            if ($value && !isset($o->$property)) return false;
            if ($value !== $o->$property) return false;
        }

        return true;
    }
}

