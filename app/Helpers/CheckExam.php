<?php

use Carbon\Carbon;

if (! function_exists('checkExam')) {
    function checkExam($startDate, $endDate): bool
    {
        $startCarbonDate = Carbon::createFromFormat('Y-m-d', $startDate);
        $endCarbonDate = Carbon::createFromFormat('Y-m-d', $endDate);
        $currentDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));

        return $currentDate->between($startCarbonDate, $endCarbonDate);
    }
}
