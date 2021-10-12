<?php

namespace Gaurang\GstCalculator;

use Gaurang\GstCalculator\Builder\StateIdentifier;
use Gaurang\GstCalculator\Results\StateWiseCalculation;
use Throwable;

class Calculator
{
    private float $cost;

    private float $rate;

    public function __construct(float $cost, float $rate)
    {
        $this->cost = $cost;
        $this->rate = $rate;
    }

    /**
     * Get GST from cost
     * @param float $cost cost for calculation
     * @param float $rate GST rate
     * @throws Throwable
     * @return Throwable|self
     */
    public static function fromCost(float $cost, float $rate)
    {
        try {
            return new static($cost, $rate);
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * Get state details
     * @param mixed $state state parameters
     * @return StateIdentifier
     */
    public static function stateDetails($state): StateIdentifier
    {
        return new StateIdentifier($state);
    }

    /**
     * Calculation of GST on the basis of states
     * @param mixed $from source state
     * @param mixed $to destination state
     * @param float $cost cost for calculation
     * @param float $rate GST rate
     * @return StateWiseCalculation
     */
    public static function stateData($from, $to, $cost, $rate): StateWiseCalculation
    {
        return new StateWiseCalculation($from, $to, $cost, $rate);
    }

    /**
     * Get GST amount
     * @throws Throwable
     * @return Throwable|float
     */
    public function getGst()
    {
        try {
            return ($this->cost * $this->rate) / 100;
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * Get total amount including GST
     * @throws Throwable
     * @return Throwable|float
     */
    public function getTotalWithGst()
    {
        try {
            return $this->getGst() + $this->cost;
        } catch (Throwable $e) {
            return $e;
        }
    }
}
