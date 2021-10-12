<?php

namespace Gaurang\GstCalculator\Results;

use Gaurang\GstCalculator\Builder\StateIdentifier;
use Gaurang\GstCalculator\Calculator;
use Throwable;
use Exception;


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
     * @throws Throwable
     * @return Throwable|array|string
     */
    public function getAllData()
    {
        try {
            $gst = Calculator::fromCost($this->cost, $this->rate)->getGst();
            $returnData = $this->prepareStateData();
            if(is_array($returnData)) {
                $returnData['gst_amount'] = $gst;
                $returnData['cost'] = $this->cost;
                $returnData['total'] = $this->cost + $returnData['gst_amount'];
            } else {
                throw new Exception('Invalid parameters');
            }
            return $returnData;
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * Get state details
     * @throws Throwable
     * @return Throwable|array|null
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
     * @throws Throwable
     * @return Throwable|array
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
     * @throws Throwable
     * @return Throwable|array
     */
    public function prepareStateData()
    {
        try {
            $stateData = $this->findStateFromInput([$this->sourceState, $this->destinationState]);
            $data = array_merge($stateData, $this->taxType($stateData, $this->rate));
            if (!empty($data)) {
                return $data;
            } else {
                throw new Exception('Unexpected error');
            }
            
        } catch (Throwable $e) {
            return $e;
        }
    }
}
