<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LogsExport implements FromCollection, WithHeadings
{
    protected $logs;

    public function __construct(Collection $logs)
    {
        $this->logs = $logs;
    }

    /**
     * Return the collection of data to be exported.
     */
    public function collection()
    {
        return $this->logs;
    }

    /**
     * Add headings to the exported Excel file.
     */
    public function headings(): array
    {
        return ['Timestamp', 'Level', 'Message'];
    }
}
