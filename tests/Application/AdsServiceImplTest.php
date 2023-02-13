<?php

declare(strict_types=1);

namespace App\Tests\Application;

use App\Application\AdsServiceImpl;
use App\Domain\Ad;
use App\Domain\AdRepository;
use App\Domain\Picture;
use App\Domain\Quality;
use App\Domain\Typology;
use PHPUnit\Framework\TestCase;

final class AdsServiceImplTest extends TestCase
{
    public function testCalculateScores(): void
    {
        $adRepository = $this->createMock(AdRepository::class);
        $adRepository->method('findAllAds')->willReturn([$this->relevantAd(), $this->irrelevantAd()]);
        $scoreService = new AdsServiceImpl($adRepository);

        $adRepository->expects($this->once())->method('findAllAds');
        $adRepository->expects($this->exactly(2))->method('save');
        $scoreService->calculateScores();
    }

    private function relevantAd(): Ad
    {
        return new Ad(
            1,
            Typology::FLAT,
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum felis elit, vitae cursus erat blandit vitae. Maecenas eget efficitur massa. Maecenas ut dolor eget enim consequat iaculis vitae nec elit. Maecenas eu urna nec massa feugiat pharetra. Sed eu quam imperdiet orci lobortis fermentum. Sed odio justo, congue eget iaculis.',
            [new Picture(1, 'http://urldeprueba.com/1', Quality::HD), new Picture(2, 'http://urldeprueba.com/2', Quality::HD)],
            50,
            0
        );
    }

    private function irrelevantAd(): Ad
    {
        return new Ad(
            1,
            Typology::FLAT,
            '',
            [],
            100,
            0,
        );
    }
}
