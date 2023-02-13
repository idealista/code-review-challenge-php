<?php

declare(strict_types=1);

namespace App\Domain;

enum Typology: String
{
    case FLAT = 'FLAT';
    case CHALET = 'CHALET';
    case GARAGE = 'GARAGE';
}
