<?php

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Facades\Log;

if (! function_exists('checkExam')) {
    function checkExam($startDate, $endDate): bool
    {
        try {
            $startCarbonDate = Carbon::createFromFormat('Y-m-d', $startDate);
            $endCarbonDate = Carbon::createFromFormat('Y-m-d', $endDate);
            $currentDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));

            return $currentDate->between($startCarbonDate, $endCarbonDate);
        } catch (InvalidFormatException $e) {
            // Log the error for debugging purposes
            Log::error('Invalid date format', ['startDate' => $startDate, 'endDate' => $endDate, 'error' => $e->getMessage()]);
            // Optionally, you can return false or handle the error differently
            return false;
        }
    }
}