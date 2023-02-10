<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Ad;
use App\Domain\AdRepository;
use App\Domain\Constants;
use App\Domain\Picture;
use App\Domain\Quality;
use App\Domain\Typology;

class InFileSystemPersistence implements AdRepository
{
    private array $ads = [];
    private array $pictures = [];
    private String $storagePath;

    public function __construct()
    {
        $this->storagePath = sys_get_temp_dir()."/database";
        $this->hydrate();
    }

    public function findAllAds(): array
    {
        return array_map([$this, 'mapAdsToDomain'], $this->ads);
    }

    public function save(Ad $ad): void
    {
        $this->saveAd($ad);
        $this->saveToFilesystem();
    }

    public function findRelevantAds(): array
    {
        return array_map([$this, 'mapAdsToDomain'], array_filter($this->ads, function (AdVO $ad) {
            return $ad->getScore() >= Constants::FORTY;
        }));
    }

    public function findIrrelevantAds(): array
    {
        return array_map([$this, 'mapAdsToDomain'], array_filter($this->ads, function (AdVO $ad) {
            return $ad->getScore() < Constants::FORTY;
        }));
    }

    private function saveAd(Ad $ad): void
    {
        array_walk($this->ads, function (AdVO $adVO, $index) use ($ad) {
            if ($adVO->getId() === $ad->getId()) {
                unset ($this->ads[$index]);
            }
        });
        array_push($this->ads, $this->mapAdToPersistence($ad));

        foreach($ad->getPictures() as $picture) {
            $this->savePicture($picture);
        }
    }

    private function savePicture(Picture $picture): void
    {
        array_walk($this->pictures, function (PictureVO $pictureVO, $index) use ($picture) {
            if ($pictureVO->getId() === $picture->getId()) {
                unset ($this->pictures[$index]);
            }
        });
        array_push($this->pictures, $this->mapPictureToPersistence($picture));
    }

    private function mapAdsToDomain(AdVO $adVO): Ad
    {
        return new Ad(
            $adVO->getId(),
            Typology::from($adVO->getTypology()),
            $adVO->getDescription(),
            array_map([__CLASS__, 'mapPicturesToDomain'], $adVO->getPictures()),
            $adVO->getHouseSize(),
            $adVO->getGardenSize(),
            $adVO->getScore(),
            $adVO->getIrrelevantSince(),
        );
    }

    private function mapPicturesToDomain(int $pictureId): ?Picture
    {
        $pictureVO = current(array_filter($this->pictures, function (PictureVO $pictureVO) use ($pictureId) {
            return $pictureVO->getId() === $pictureId;
        }));

        return new Picture($pictureVO->getId(), $pictureVO->getUrl(), Quality::from($pictureVO->getQuality()));
    }

    private function mapAdToPersistence(Ad $ad): AdVO
    {
        return new AdVO(
            $ad->getId(),
            $ad->getTypology()->name,
            $ad->getDescription(),
            array_map(fn (Picture $picture) => $picture->getId(), $ad->getPictures()),
            $ad->getHouseSize(),
            $ad->getGardenSize(),
            $ad->getScore(),
            $ad->getIrrelevantSince(),
        );
    }

    private function mapPictureToPersistence(Picture $picture): PictureVO
    {
        return new PictureVO(
            $picture->getId(),
            $picture->getUrl(),
            $picture->getQuality()->name,
        );
    }

    private function hydrate(): void
    {
        if ($this->loadFromFilesystem()) {
            return;
        }

        array_push($this->ads, new AdVO(1, "CHALET", "Este piso es una ganga, compra, compra, COMPRA!!!!!", [], 300, null, null, null));
        array_push($this->ads, new AdVO(2, "FLAT", "Nuevo ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este ático de lujo", [4], 300, null, null, null));
        array_push($this->ads, new AdVO(3, "CHALET", "", [2], 300, null, null, null));
        array_push($this->ads, new AdVO(4, "FLAT", "Ático céntrico muy luminoso y recién reformado, parece nuevo", [5], 300, null, null, null));
        array_push($this->ads, new AdVO(5, "FLAT", "Pisazo,", [3, 8], 300, null, null, null));
        array_push($this->ads, new AdVO(6, "GARAGE", "", [6], 300, null, null, null));
        array_push($this->ads, new AdVO(7, "GARAGE", "Garaje en el centro de Albacete", [], 300, null, null, null));
        array_push($this->ads, new AdVO(8, "CHALET", "Maravilloso chalet situado en lAs afueras de un pequeño pueblo rural. El entorno es espectacular, las vistas magníficas. ¡Cómprelo ahora!", [1, 7], 300, null, null, null));

        array_push($this->pictures, new PictureVO(1, "https://www.idealista.com/pictures/1", "SD"));
        array_push($this->pictures, new PictureVO(2, "https://www.idealista.com/pictures/2", "HD"));
        array_push($this->pictures, new PictureVO(3, "https://www.idealista.com/pictures/3", "SD"));
        array_push($this->pictures, new PictureVO(4, "https://www.idealista.com/pictures/4", "HD"));
        array_push($this->pictures, new PictureVO(5, "https://www.idealista.com/pictures/5", "SD"));
        array_push($this->pictures, new PictureVO(6, "https://www.idealista.com/pictures/6", "SD"));
        array_push($this->pictures, new PictureVO(7, "https://www.idealista.com/pictures/7", "SD"));
        array_push($this->pictures, new PictureVO(8, "https://www.idealista.com/pictures/8", "HD"));
    }

    private function loadFromFilesystem(): bool
    {
        if (false === file_exists($this->storagePath)) {
            return false;
        }

        $loaded = false;
        $contents = unserialize(file_get_contents($this->storagePath));

        if ($contents instanceof self) {
            $this->ads = $contents->ads;
            $this->pictures = $contents->pictures;
            $loaded = true;
        }

        return $loaded;
    }

    private function saveToFilesystem(): void
    {
        $fh = fopen($this->storagePath, "w");
        fwrite($fh, serialize($this));
        fclose($fh);
    }
}
