<?php
namespace App\Exports;

use App\Models\Inquiry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InquiryReportExport implements FromCollection, WithHeadings
{
    protected $filter;

    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    public function collection()
    {
        return Inquiry::selectRaw('COUNT(*) as total, DATE_FORMAT(InquiryDate, ?) as period', [$this->filter == 'yearly' ? '%Y' : '%Y-%m'])
            ->groupBy('period')
            ->orderBy('period')
            ->get();
    }

    public function headings(): array
    {
        return ['Period', 'Total Inquiries'];
    }
}
