<?php

use Gaurang\GstCalculator\Calculator;

it('can calculate gst', function () {
    $gst = Calculator::fromCost(1000, 9)->getGst();
    $this->assertEquals($gst, 90);
});

it('can get total amount including gst', function () {
    $gst = Calculator::fromCost(1000, 9)->getTotalWithGst();
    $this->assertEquals($gst, 1090);
});

it('can get gst by state', function () {
    $gstType = Calculator::stateData("HR", 7, 1020, 5)->getGstType();
    $expectedResponse = [
        'igst' => 5,
    ];
    $this->assertEquals($gstType, $expectedResponse);
});

it('can get gst by state failure', function () {
    $gstType = Calculator::stateData("HR", 7722, 1020, 5)->getGstType();
    expect($gstType)->toBeInstanceOf(Error::class);
    ;
});

it('can get get state details', function () {
    $gstStateDetails = Calculator::stateData("HR", 7, 1020, 5)->getStateDetails();
    $expectedResponse = [
        'source_state' => [
            'name' => 'Haryana',
            'alpha_code' => 'HR',
            'state_code' => 6,
        ],
        'destination_state' => [
            'name' => 'Delhi',
            'alpha_code' => 'DL',
            'state_code' => 7,
        ],
    ];
    $this->assertEquals($gstStateDetails, $expectedResponse);
});

it('can get get state details failure', function () {
    $gstStateDetails = Calculator::stateData("HR", 788, 1020, 5)->getStateDetails();
    expect($gstStateDetails)->toBeInstanceOf(Error::class);
    ;
});

it('can get gst all data', function () {
    $allData = Calculator::stateData("HR", 6, 1020, 5)->getAllData();
    $expectedResponse = [
        'source_state' => [
            'name' => 'Haryana',
            'alpha_code' => 'HR',
            'state_code' => 6,
        ],
        'destination_state' => [
            'name' => 'Haryana',
            'alpha_code' => 'HR',
            'state_code' => 6,
        ],
        'cgst' => 2.5,
        'sgst' => 2.5,
        'gst_amount' => 51.0,
        'cost' => 1020,
        'total' => 1071.0,
    ];
    $this->assertEquals($allData, $expectedResponse);
});


it('can get state code from input failure', function () {
    $stateData = Calculator::stateDetails("HR")->getStateCodeFromInput(2233);
    expect($stateData)->toBeInstanceOf(Exception::class);
});

it('can find state code from input failure', function () {
    $stateData = Calculator::stateDetails("HR")->findStateFromInput([0 => null,1 => null]);
    expect($stateData)->toBeInstanceOf(Error::class);
});


it('can get gst all data failure', function () {
    $allData = Calculator::stateData("HRR", 6, 1020, 5)->getAllData();
    expect($allData)->toBeInstanceOf(Error::class);
});


it('can get state name from alpha code', function () {
    $stateName = Calculator::stateDetails(7)->getStateName();
    $this->assertEquals($stateName, 'Delhi');
});

it('can get state name from alpha code failure', function () {
    $stateName = Calculator::stateDetails(777)->getStateName();
    expect($stateName)->toBeInstanceOf(Error::class);
});


it('can get state alpha code from state code', function () {
    $alphaCode = Calculator::stateDetails(6)->getAlphaCode();
    $this->assertEquals($alphaCode, 'HR');
});

it('can get state alpha code from state code failure', function () {
    $alphaCode = Calculator::stateDetails(778)->getAlphaCode();
    expect($alphaCode)->toBeInstanceOf(Error::class);
});


it('can get state code from alpha code', function () {
    $stateCode = Calculator::stateDetails('DL')->getStateCode();
    $this->assertEquals($stateCode, 7);
});

it('can get state code from alpha code failure', function () {
    $stateCode = Calculator::stateDetails('DLL')->getStateCode();
    expect($stateCode)->toBeInstanceOf(Error::class);
});
