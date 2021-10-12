<?php

namespace Gaurang\GstCalculator\Builder;

use Exception;
use Throwable;

class StateIdentifier extends states
{
    public $state;

    public $gstType;

    public $stateWiseGstCalculations;

    public function __construct($state)
    {
        $this->state = $state;
    }

    /**
     * Get state name
     * @throws Throwable
     * @return Throwable|string
     */
    public function getStateName()
    {
        try {
            return $this->identifyStateData($this->state)[0];
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * Get state code
     * @throws Throwable
     * @return Throwable|int
     */
    public function getStateCode()
    {
        try {
            return $this->identifyStateData($this->state)[2];
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * Get alpha code
     * @throws Throwable
     * @return Throwable|string
     */
    public function getAlphaCode()
    {
        try {
            return $this->identifyStateData($this->state)[1];
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * Get state code from parameters
     * @param mixed $stateParam State parameter
     * @throws Throwable
     * @return Throwable|mixed
     */
    public function getStateCodeFromInput($stateParam)
    {
        try {
            foreach (self::$statesList as $key => $value) {
                if (in_array($stateParam, $value)) {
                    return $key;
                }
            }

            throw new Exception('Invalid input');
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * Get tax type
     * @param mixed $stateParam State parameter
     * @param float $rate Rate of GST
     * @throws Throwable
     * @return Throwable|array
     */
    public function taxType($stateParam, $rate)
    {
        try {
            if ($stateParam['source_state']['state_code'] == $stateParam['destination_state']['state_code']) {
                $returnArr['cgst'] = $rate / 2;
                $returnArr['sgst'] = $rate / 2;
            } else {
                $returnArr['igst'] = $rate;
            }

            return $returnArr;
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * Find state data from state parameters
     * @param array $stateParam State parameter
     * @throws Throwable
     * @return Throwable|array|null
     */
    public function findStateFromInput(array $stateParam)
    {
        try {
            if ($this->identifyStateData($stateParam[0]) !== null &&
                $this->identifyStateData($stateParam[1]) !== null) {
                $returnArr = [
                    'source_state' => [
                        'name' => $this->identifyStateData($stateParam[0])[0],
                        'alpha_code' => $this->identifyStateData($stateParam[0])[1],
                        'state_code' => $this->identifyStateData($stateParam[0])[2],
                    ],
                    'destination_state' => [
                        'name' => $this->identifyStateData($stateParam[1])[0],
                        'alpha_code' => $this->identifyStateData($stateParam[1])[1],
                        'state_code' => $this->identifyStateData($stateParam[1])[2],
                    ],
                ];

                return $returnArr;
            }
        } catch (Throwable $e) {
            return $e;
        }
    }

    /**
     * Identify the type of state parameter
     * @param mixed $stateParam State parameter
     * @throws Throwable
     * @return Throwable|mixed
     */
    protected function identifyStateData($stateParam)
    {
        try {
            if (gettype($stateParam) == 'integer') {
                if (isset(self::$statesList[$stateParam])) {
                    self::$statesList[$stateParam][2] = $stateParam;

                    return self::$statesList[$stateParam];
                } else {
                    throw new Exception('Invalid state code');
                }
            } elseif (gettype($stateParam) == 'string') {
                $countChar = strlen($stateParam);
                if ($countChar == 2) {
                    $stateCode = $this->getStateCodeFromInput($stateParam);
                } else {
                    $stateCode = $this->getStateCodeFromInput($stateParam);
                }
                if (isset(self::$statesList[$stateCode])) {
                    self::$statesList[$stateCode][2] = $stateCode;

                    return self::$statesList[$stateCode];
                } else {
                    throw new Exception('Invalid alpha code');
                }
            } else {
                throw new Exception('Invalid state entry');
            }
        } catch (Throwable $e) {
            return $e;
        }
    }
}
