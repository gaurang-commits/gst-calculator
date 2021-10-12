<?php

namespace Gaurang\GstCalculator;

interface HasCalculator
{
    public static function fromCost(float $cost, float $rate);

    public function getGst();
}
