<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

class PictureVO
{
    public function __construct(
        private ?int $id = null,
        private ?String $url = null,
        private ?String $quality = null,
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

    public function getQuality(): String
    {
        return $this->quality;
    }

    public function setQuality(String $quality): void
    {
        $this->quality = $quality;
    }
}