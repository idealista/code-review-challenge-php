<?php

declare(strict_types=1);

namespace App\Domain;

interface AdRepository
{
    public function findAllAds(): array;

    public function save(Ad $ad): void;

    public function findRelevantAds(): array;

    public function findIrrelevantAds(): array;
}
