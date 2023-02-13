<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

class PictureVO
{
    public function __construct(
        private ?int $id = null,
        private ?string $url = null,
        private ?string $quality = null,
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

    public function getQuality(): string
    {
        return $this->quality;
    }

    public function setQuality(string $quality): void
    {
        $this->quality = $quality;
    }
}
