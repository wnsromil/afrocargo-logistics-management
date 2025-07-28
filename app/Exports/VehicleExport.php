<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;


class VehicleExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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
            'Hub',
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
        static $index = 1;

        return [
            $report->tracking_number ?? '-',
            ($report->full_name ?? '-') . "\n" . ($report->mobile_number ?? '-'),
            ($report->ship_full_name ?? '-') . "\n" . ($report->ship_mobile_number ?? '-'),
            $report->warehouse->warehouse_name ?? '-',
            $report->hub_name ?? '-',
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
}
