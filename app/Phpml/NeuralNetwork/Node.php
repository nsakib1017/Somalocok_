<?php

declare(strict_types=1);

namespace App\Phpml\NeuralNetwork;

interface Node
{
    public function getOutput(): float;
}
