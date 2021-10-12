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
        try {
            $this->cost = $cost;
            $this->rate = $rate;
        } catch (Throwable $e) {
            return $e;
        }
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
     * @throws Throwable
     * @return Throwable|StateIdentifier
     */
    public static function stateDetails($state)
    {
        try {
            return new StateIdentifier($state);
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * Calculation of GST on the basis of states
     * @param mixed $from source state
     * @param mixed $to destination state
     * @param float $cost cost for calculation
     * @param float $rate GST rate
     * @throws Throwable
     * @return Throwable|StateWiseCalculation
     */
    public static function stateData($from, $to, $cost, $rate)
    {
        try {
            return new StateWiseCalculation($from, $to, $cost, $rate);
        } catch (Throwable $e) {
            return $e;
        }
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
