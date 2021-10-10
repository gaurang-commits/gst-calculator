<?php

namespace Gaurang\GstCalculator;

class GstCalculator
{
    private float $cost;

    private float $rate;

    public static function fromCost(float $cost, float $rate): self
    {
        return new static($cost,$rate);
    }

    public function __construct(float $cost, float $rate)
    {
        $this->cost = $cost;
        $this->rate = $rate;
    }

    public function getGst(): float
    {
        return ($this->cost * $this->rate) / 100;
    }
}
