<?php

declare(strict_types=1);

namespace App\Phpml\NeuralNetwork\Node;

use App\Phpml\NeuralNetwork\Node;

class Bias implements Node
{
    public function getOutput(): float
    {
        return 1.0;
    }
}
