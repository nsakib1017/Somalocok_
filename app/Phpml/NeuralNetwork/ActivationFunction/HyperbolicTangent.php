<?php

declare(strict_types=1);

namespace App\Phpml\NeuralNetwork\ActivationFunction;

use App\Phpml\NeuralNetwork\ActivationFunction;

class HyperbolicTangent implements ActivationFunction
{
    /**
     * @var float
     */
    private $beta;

    public function __construct(float $beta = 1.0)
    {
        $this->beta = $beta;
    }

    /**
     * @param float|int $value
     */
    public function compute($value): float
    {
        return tanh($this->beta * $value);
    }

    /**
     * @param float|int $value
     * @param float|int $computedvalue
     */
    public function differentiate($value, $computedvalue): float
    {
        return 1 - pow($computedvalue, 2);
    }
}
