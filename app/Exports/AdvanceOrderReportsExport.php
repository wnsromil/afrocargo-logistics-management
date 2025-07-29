<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class AdvanceOrderReportsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    protected $reports;

    public function __construct($reports)
    {
        $this->reports = $reports;
    }

    public function collection()
    {
        return $this->reports;
    }

    public function headings(): array
    {
        return [
            'Tracking Id',
            'From',
            'To',
            'Warehouse',
            'Driver',
            'Order Date',
            'Order Status',
            'Amount',
            'Payment Mode',
            'Payment Status',
        ];
    }

    public function map($report): array
    {
        $break = "\r\n"; // Important for Excel line breaks

        return [
            $report->tracking_number ?? '-',
            ($report->full_name ?? '-') . $break . ($report->mobile_number ?? '-') . $break . ($report->address ?? '-'),
            ($report->ship_full_name ?? '-') . $break . ($report->ship_mobile_number ?? '-') . $break . ($report->ship_address ?? '-'),
            $report->warehouse->warehouse_name ?? '-',
            $report->driver_name ?? '-',
            $report->created_at
                ? Carbon::parse($report->created_at)->format('Y-m-d H:i:s')
                : '-',
            $report->order_status ?? '-',
            $report->invoice_total_amount ?? '-',
            $report->payment_mode ?? '-',
            ($report->is_paid ? 'Paid' : 'Unpaid'),
        ];
    }

    // 👇 This part enables wrap text for "From" and "To" columns
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Wrap text for columns B and C (From & To)
                $event->sheet->getDelegate()->getStyle('B:C')
                    ->getAlignment()->setWrapText(true);
                
                // Optional: auto-adjust row height for better visibility
                $event->sheet->getDelegate()->getDefaultRowDimension()->setRowHeight(-1);
            },
        ];
    }
}
