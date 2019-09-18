<?php

declare(strict_types=1);

namespace App\Phpml\Math\Distance;

use App\Phpml\Exception\InvalidArgumentException;
use App\Phpml\Math\Distance;

class Chebyshev implements Distance
{
    /**
     * @throws InvalidArgumentException
     */
    public function distance(array $a, array $b): float
    {
        if (count($a) !== count($b)) {
            throw new InvalidArgumentException('Size of given arrays does not match');
        }

        $differences = [];
        $count = count($a);

        for ($i = 0; $i < $count; ++$i) {
            $differences[] = abs($a[$i] - $b[$i]);
        }

        return max($differences);
    }
}
