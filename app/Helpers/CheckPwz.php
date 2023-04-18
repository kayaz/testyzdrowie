<?php

if (! function_exists('checkPwz')) {
    function checkPwz(int $number)
    {
        $numbers = str_split($number);
        $check = array();
        $check[] = $numbers[0] * 10;

        for($i = 1;$i < count($numbers);$i++){
            $check[] = $numbers[$i] * $i;
        }

        if((array_sum($check) % 11) == 0){
            return '<i class="fe-check-circle me-1 text-success"></i> '.$number;
        } else {
            return '<i class="fe-alert-circle me-1 text-danger"></i> '.$number;
        }
    }
}
