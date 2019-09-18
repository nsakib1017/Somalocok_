<?php

declare(strict_types=1);

namespace App\Phpml\Math;

interface Distance
{
    public function distance(array $a, array $b): float;
}
