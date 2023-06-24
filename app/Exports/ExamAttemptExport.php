<?php

namespace App\Exports;

use App\Models\ExamAttempt;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;

class ExamAttemptExport implements FromCollection, ShouldAutoSize, WithHeadings, WithColumnWidths, WithEvents
{
    use Exportable;
    protected $totalRows = 0;

    public function __construct(int $examdateId, int $examPass)
    {
        $this->examdateId = $examdateId;
        $this->examPass = $examPass;
    }

    public function collection()
    {
        $attempts = ExamAttempt::select(
            'user_id',
            'date_start',
            'date_end',
            'time',
            'score',
            'answers_count',
            'answers_correct',
            'answers_wrong',
            'answers_empty',
            'ip',
            'host',
        )->where('date_id', '=', $this->examdateId)
            ->where('score', '>=', $this->examPass)
            ->with('user')
            ->get();

        return $attempts->map(function ($attempt) {
            return [
                'name' => $attempt->user->name.' '.$attempt->user->surname,
                'pesel' => $attempt->user->pesel,
                'practice' => $attempt->user->practice,
                'address' => $attempt->user->postcode.' '.$attempt->user->city.', '.$attempt->user->address,
                'telefon' => $attempt->user->phone,
                'email' => $attempt->user->email,
                'date_start' => $attempt->date_start,
                'date_end' => $attempt->date_end,
                'time' => convertSec2Min($attempt->time),
                'score' => $attempt->score,
                'answers_count' => $attempt->answers_count,
                'answers_correct' => $attempt->answers_correct,
                'answers_wrong' => $attempt->answers_wrong,
                'answers_empty' => $attempt->answers_empty,
                'ip' => $attempt->ip,
                'host' => $attempt->host,
            ];
        });
    }

    public function headings(): array
    {
        return [
            "Imię i nazwisko",
            "PESEL",
            "PWZ",
            "Adres",
            "Telefon",
            "E-mail",
            "Data rozpoczęcia egzaminu",
            "Data zakończenia egzaminu",
            "Czas trwania egzaminu",
            "Wynik egzaminu",
            "Ilość odpowiedzi",
            "Prawidłowe",
            "Złe",
            "Puste",
            "Adres IP",
            "Host"
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 22, // Name & Surname
            'B' => 18, // PESEL
            'C' => 18, // PWZ
            'D' => 40, // Address
            'E' => 25, // Phone number
            'F' => 25, // E-mail
            'G' => 30, // Date Start
            'H' => 30, // Date End
            'I' => 25, // Time
            'J' => 18, // Score
            'K' => 18, // Answers Count
            'L' => 15, // Answers Correct
            'M' => 10, // Answers Wrong
            'N' => 10, // Answers Empty
            'O' => 20, // IP
            'P' => 25, // Host
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getRowDimension(1)->setRowHeight(40);

                $highestRow = $event->sheet->getHighestRow();

                for ($i = 2; $i <= $highestRow; $i++) {
                    $event->sheet->getRowDimension($i)->setRowHeight(30);
                    $event->sheet->getDelegate()
                        ->getStyle('B'.$i.':P'.$i)
                        ->getAlignment()
                        ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                        ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                    $event->sheet->getDelegate()
                        ->getStyle('A'.$i)
                        ->getAlignment()
                        ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                }

                $event->sheet->getDelegate()
                    ->getStyle('A1')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $event->sheet->getDelegate()
                    ->getStyle('B1:P1')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            },
        ];
    }
}
