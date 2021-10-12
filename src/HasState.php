<?php
namespace Gaurang\GstCalculator;

interface HasState
{
    public function getStateCodeFromInput($stateParam);
    public function taxType($stateParam, $rate);
    public function findStateFromInput(array $stateParam);
}