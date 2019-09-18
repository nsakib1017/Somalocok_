<?php

declare(strict_types=1);

namespace App\Phpml\Preprocessing\Imputer\Strategy;

use App\Phpml\Math\Statistic\Mean;
use App\Phpml\Preprocessing\Imputer\Strategy;

class MostFrequentStrategy implements Strategy
{
    /**
     * @return float|mixed
     */
    public function replaceValue(array $currentAxis)
    {
        return Mean::mode($currentAxis);
    }
}
