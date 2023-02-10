<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Ad;
use App\Domain\AdRepository;
use App\Domain\Constants;
use App\Domain\Picture;
use App\Domain\Quality;
use App\Domain\Typology;
use App\Infrastructure\Api\PublicAd;
use App\Infrastructure\Api\QualityAd;
use DateTime;

class AdsServiceImpl implements AdsService
{
    public function __construct(
        private AdRepository $adRepository,
    ) {
    }

    public function findPublicAds(): array
    {
        $ads = $this->adRepository->findRelevantAds();
        usort($ads, function (Ad $first, Ad $last) {
            return $first->getScore() >= $last->getScore();
        });

        $result = [];
        foreach ($ads as $ad) {
            $publicAd = new PublicAd();
            $publicAd->setDescription($ad->getDescription());
            $publicAd->setGardenSize($ad->getGardenSize());
            $publicAd->setHouseSize($ad->getHouseSize());
            $publicAd->setId($ad->getId());
            $publicAd->setPictureUrls(array_map(fn (Picture $picture) => $picture->getUrl(), $ad->getPictures()));
            $publicAd->setTypology($ad->getTypology()->name);

            array_push($result, $publicAd);
        }
        return $result;
    }

    public function findQualityAds(): array
    {
        $ads = $this->adRepository->findIrrelevantAds();

        $result = [];
        foreach ($ads as $ad) {
            $qualityAd = new QualityAd();
            $qualityAd->setDescription($ad->getDescription());
            $qualityAd->setGardenSize($ad->getGardenSize());
            $qualityAd->setHouseSize($ad->getHouseSize());
            $qualityAd->setId($ad->getId());
            $qualityAd->setPictureUrls(array_map(fn (Picture $picture) => $picture->getUrl(), $ad->getPictures()));
            $qualityAd->setTypology($ad->getTypology()->name);
            $qualityAd->setScore($ad->getScore());
            $qualityAd->setIrrelevantSince($ad->getIrrelevantSince());

            array_push($result, $qualityAd);
        }
        return $result;
    }

    public function calculateScores(): void
    {
        foreach ($this->adRepository->findAllAds() as $ad) {
            $this->calculateScore($ad);
        }
    }

    private function calculateScore(Ad $ad): void
    {
        $score = Constants::ZERO;

        //Calcular puntuación por fotos
        if (empty($ad->getPictures())) {
            $score -= Constants::TEN; //Si no hay fotos restamos 10 puntos
        } else {
            foreach ($ad->getPictures() as $picture) {
                if (Quality::HD->equals($picture->getQuality())) {
                    $score += Constants::TWENTY; //Cada foto en alta definición aporta 20 puntos
                } else {
                    $score += Constants::TEN; //Cada foto normal aporta 10 puntos
                }
            }
        }

        //Calcular puntuación por descripción
        $optDesc = $ad->getDescription() ?? null;

       if (false === is_null($optDesc)) {
            $description = $optDesc;

            if (!empty($description)) {
                $score += Constants::FIVE;
            }

            $wds = explode(" ", mb_strtolower($description)); //número de palabras

            if (Typology::FLAT->equals($ad->getTypology())) {
                if (count($wds) >= Constants::TWENTY && count($wds) <= Constants::FORTY_NINE) {
                    $score += Constants::TEN;
                }

                if (count($wds) >= Constants::FIFTY) {
                    $score += Constants::THIRTY;
                }

                if (Typology::CHALET->equals($ad->getTypology())) {
                    if (count($wds) >= Constants::FIFTY) {
                        $score += Constants::TWENTY;
                    }
                }

                if (in_array("luminoso", $wds)) $score += Constants::FIVE;
                if (in_array("nuevo", $wds)) $score += Constants::FIVE;
                if (in_array("céntrico", $wds)) $score += Constants::FIVE;
                if (in_array("reformado", $wds)) $score += Constants::FIVE;
                if (in_array("ático", $wds)) $score += Constants::FIVE;
            }
        }

        //Calcular puntuación por completitud
        if ($ad->isComplete()) {
            $score = Constants::FORTY;
        }

        $ad->setScore($score);

        if ($ad->getScore() < Constants::ZERO) {
            $ad->setScore(Constants::ZERO);
        }

        if ($ad->getScore() > Constants::ONE_HUNDRED) {
            $ad->setScore(Constants::ONE_HUNDRED);
        }

        if ($ad->getScore() < Constants::FORTY) {
            $ad->setIrrelevantSince(new DateTime());
        } else {
            $ad->setIrrelevantSince(null);
        }

        $this->adRepository->save($ad);
    }
}