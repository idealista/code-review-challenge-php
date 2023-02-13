<?php

declare(strict_types=1);

namespace App\Domain;

enum Quality: String
{
    case HD = 'HD';
    case SD = 'SD';
}
