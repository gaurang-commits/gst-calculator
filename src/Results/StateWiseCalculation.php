<?php

namespace Gaurang\GstCalculator\Results;

use Exception;
use Gaurang\GstCalculator\Builder\StateIdentifier;
use Gaurang\GstCalculator\Calculator;
use Throwable;

class StateWiseCalculation extends StateIdentifier
{
    public $sourceState;

    public $destinationState;

    public $cost;

    public $rate;

    public function __construct($from, $to, $cost, $rate)
    {
        $this->sourceState = $from;
        $this->destinationState = $to;
        $this->cost = $cost;
        $this->rate = $rate;
    }

    /**
     * Get all data
     * @throws Exception
     * @return array
     */
    public function getAllData()
    {
        try {
            $returnData = $this->prepareStateData();
            $returnData['gst_amount'] = Calculator::fromCost($this->cost, $this->rate)->getGst();
            $returnData['cost'] = $this->cost;
            $returnData['total'] = $this->cost + $returnData['gst_amount'];

            return $returnData;
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * Get state details
     * @throws Exception
     * @return array
     */
    public function getStateDetails()
    {
        try {
            return $this->findStateFromInput([$this->sourceState, $this->destinationState]);
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * Get GST type
     * @throws Exception
     * @return array
     */
    public function getGstType()
    {
        try {
            return $this->taxType($this->getStateDetails(), $this->rate);
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * Prepare state array
     * @throws Exception
     * @return array
     */
    public function prepareStateData()
    {
        try {
            $stateData = $this->findStateFromInput([$this->sourceState, $this->destinationState]);
            $data = array_merge($stateData, $this->taxType($stateData, $this->rate));

            return $data;
        } catch (Throwable $e) {
            return $e;
        }
    }
}
