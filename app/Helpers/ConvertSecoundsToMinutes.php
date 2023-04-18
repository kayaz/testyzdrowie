<?php
use Carbon\Carbon;
if (! function_exists('convertSec2Min')) {
    function convertSec2Min(int $seconds): string
    {
        $minutes = floor($seconds / 60);
        $remainingSeconds = $seconds % 60;
        $time = Carbon::createFromTime(0, $minutes, $remainingSeconds);
        return $time->format('i:s');
    }
}
