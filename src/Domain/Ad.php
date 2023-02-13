<?php

declare(strict_types=1);

namespace App\Domain;

class Ad
{
    public function __construct(
        private int $id,
        private Typology $typology,
        private string $description,
        private array $pictures,
        private int $houseSize,
        private ?int $gardenSize = null,
        private ?int $score = null,
        private ?\DateTime $irrelevantSince = null,
    ) {
    }

    public function isComplete(): bool
    {
        return (Typology::GARAGE === $this->typology && !empty($this->pictures))
            || (Typology::FLAT ===$this->typology  && !empty($this->pictures) && null != $this->description && !empty($this->description) && null != $this->houseSize)
            || (Typology::CHALET === $this->typology && !empty($this->pictures) && null != $this->description && !empty($this->description) && null != $this->houseSize && null != $this->gardenSize);
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
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

    public function getIrrelevantSince(): ?\DateTime
    {
        return $this->irrelevantSince;
    }

    public function setIrrelevantSince(?\DateTime $irrelevantSince): void
    {
        $this->irrelevantSince = $irrelevantSince;
    }

    public function equals(object $o): bool
    {
        if ($this === $o) return true;
        if (null === $o || self::class !== $o::class) return false;

        foreach (get_object_vars($this) as $property => $value) {
            if ($value && !isset($o->$property)) return false;
            if ($o->$property !== $value) return false;
        }

        return true;
    }

    public function hashCode(): int
    {
        return intval(hash('crc32b', $this->toString()));
    }

    public function toString(): string {
        return 'Ad{'.
            'id='.$this->id.
            ', typology='.$this->typology->value.
            ', description=\''.$this->description.'\''.
            ', pictures='.implode(',',$this->pictures).
            ', houseSize='.$this->houseSize.
            ', gardenSize='.$this->gardenSize.
            ', score='.$this->score.
            ', irrelevantSince='.$this->irrelevantSince->format('Y-m-d H:i:s').
            '}';
    }
}
