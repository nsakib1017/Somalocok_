<?php

declare(strict_types=1);

namespace App\Phpml\Preprocessing\Imputer\Strategy;

use App\Phpml\Math\Statistic\Mean;
use App\Phpml\Preprocessing\Imputer\Strategy;

class MedianStrategy implements Strategy
{
    public function replaceValue(array $currentAxis): float
    {
        return Mean::median($currentAxis);
    }
}
