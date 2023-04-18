<?php

namespace App\Exports;

use App\Models\ExamAttempt;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExamAttemptExport implements FromCollection, ShouldAutoSize
{
    use Exportable;

    public function __construct(int $examdateId)
    {
        $this->examdateId = $examdateId;
    }

    public function collection()
    {
        return ExamAttempt::where('date_id', '=', $this->examdateId)->get();
    }
}
