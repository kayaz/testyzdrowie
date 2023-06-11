<?php

if (! function_exists('checkPesel')) {
    function checkPesel($number)
    {
        $weights = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3, 1];
        $digits = str_split($number);

        $checksum = array_reduce(array_keys($digits), function ($carry, $index) use ($weights, $digits) {
            return $carry + $weights[$index] * $digits[$index];
        });

        if ($checksum % 10 !== 0) {
            return '<i class="fe-alert-circle me-1 text-danger"></i> '.$number;
        } else {
            return '<i class="fe-check-circle me-1 text-success"></i> '.$number;
        }
    }
}
