<?php

declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\Application\AdsService;
use Symfony\Component\HttpFoundation\JsonResponse;

class AdsController
{
    public function __construct(
        private AdsService $adsService,
    ) {
    }

    public function qualityListing(): JsonResponse
    {
        return new JsonResponse(array_map([$this, 'toArray'], $this->adsService->findQualityAds()));
    }

    public function publicListing(): JsonResponse
    {
        return new JsonResponse(array_map([$this, 'toArray'], $this->adsService->findPublicAds()));
    }

    public function calculateScore(): JsonResponse
    {
        $this->adsService->calculateScores();

        return new JsonResponse();
    }

    private function toArray(mixed $ad): array
    {
        $array = [];
        foreach ((array) $ad  as $property => $value) {
            $array[trim(str_replace(get_class($ad), '', $property))] = $value;
        }

        return $array;
    }
}
