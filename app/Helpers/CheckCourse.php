<?php

use Carbon\Carbon;

if (! function_exists('checkCourse')) {
    function checkCourse($startDate): bool
    {
        $startCarbonDate = Carbon::parse($startDate)->startOfDay();
        $todayCarbonDate = Carbon::today()->startOfDay();
        return $startCarbonDate->isSameDay($todayCarbonDate);
    }
}