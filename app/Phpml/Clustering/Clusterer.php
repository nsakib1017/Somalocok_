<?php

declare(strict_types=1);

namespace App\Phpml\Clustering;

interface Clusterer
{
    public function cluster(array $samples): array;
}
