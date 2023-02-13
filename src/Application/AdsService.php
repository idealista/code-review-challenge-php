<?php

declare(strict_types=1);

namespace App\Application;

interface AdsService
{
    public function findPublicAds(): array;

    public function findQualityAds(): array;

    public function calculateScores(): void;
}
