<?php

declare(strict_types=1);

namespace App\Domain;

class Picture
{
    public function __construct(
        private int $id,
        private String $url,
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

    public function getUrl(): String
    {
        return $this->url;
    }

    public function setUrl(String $url): void
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

    public function toString(): String
    {
        return "Picture{" .
            "id=" . $this->id .
            ", url='" . $this->url . '\'' .
            ", quality=" . $this->quality .
            '}';
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

    public function hashCode(): int
    {
        return intval(hash('crc32b', $this->id . $this->url . $this->quality->name));
    }
}