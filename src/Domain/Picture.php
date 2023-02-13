<?php

declare(strict_types=1);

namespace App\Domain;

class Picture
{
    public function __construct(
        private int $id,
        private string $url,
        private Quality $quality,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getQuality(): Quality
    {
        return $this->quality;
    }

    public function setQuality(Quality $quality): void
    {
        $this->quality = $quality;
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

    public function toString(): string
    {
        return 'Picture{'.
            'id='.$this->id.
            ", url='".$this->url.'\''.
            ', quality='.$this->quality->value.
            '}';
    }
}
