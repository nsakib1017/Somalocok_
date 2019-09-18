<?php

declare(strict_types=1);

namespace App\Phpml;

interface IncrementalEstimator
{
    public function partialTrain(array $samples, array $targets, array $labels = []): void;
}
