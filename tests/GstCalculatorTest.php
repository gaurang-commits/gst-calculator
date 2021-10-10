<?php

use Gaurang\GstCalculator\GstCalculator;

it('can calculate gst', function () {
    $gst = GstCalculator::fromCost(100, 18)->getGst();
    $this->assertEquals($gst, 18);
});
