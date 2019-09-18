<?php

declare(strict_types=1);

namespace App\Phpml\NeuralNetwork\ActivationFunction;

use App\Phpml\NeuralNetwork\ActivationFunction;

class ThresholdedReLU implements ActivationFunction
{
    /**
     * @var float
     */
    private $theta;

    public function __construct(float $theta = 0.0)
    {
        $this->theta = $theta;
    }

    /**
     * @param float|int $value
     */
    public function compute($value): float
    {
        return $value > $this->theta ? $value : 0.0;
    }

    /**
     * @param float|int $value
     * @param float|int $calculatedvalue
     */
    public function differentiate($value, $calculatedvalue): float
    {
        return $calculatedvalue >= $this->theta ? 1.0 : 0.0;
    }
}
