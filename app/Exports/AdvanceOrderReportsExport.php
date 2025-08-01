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
            'Shipping Type',
            'Pickup Date',
            'Delivery Date',
            'Container ID',
            'From Warehouse',
            'To Warehouse',
            'Items',
            'Estimate Cost',
            'Driver Name',
            'Vehicle Type',
            'Payment Status',
            'Partial Amount',
            'Due Amount',
            'Total Amount',
            'Payment Mode',
            'Status',
            'Pickup Type',
            'Delivery Type',
            'Parcel Weight',
        ];
    }


    public function map($report): array
    {
        $break = "\r\n"; // For Excel cell line breaks

        return [
            $report->tracking_number ?? '-',
            ($report->pickupaddress->full_name ?? '-') . $break . ($report->pickupaddress->mobile_number ?? '-') . $break . ($report->pickupaddress->address ?? '-'),
            ($report->deliveryaddress->full_name ?? '-') . $break . ($report->deliveryaddress->mobile_number ?? '-') . $break . ($report->deliveryaddress->address ?? '-'),
            $report->parcel_type === 'Supply' ? $report->parcel_type : ($report->transport_type ?? '-'),
            $report->pickup_date ?? '-',
            $report->delivery_date ?? '-',
            $report->container->unique_id ?? '-',
            $report->warehouse->warehouse_name ?? '-',
            $report->arrivedWarehouse->warehouse_name ?? '-',
            $report->descriptions ?? '-',
            number_format((float) $report->customer_estimate_cost ?? 0, 2),
            $report->driver->name ?? '-',
            $report->driver_vehicle->vehicle_type ?? '-',
            $report->payment_status ?? '-',
            number_format((float) $report->partial_payment ?? 0, 2),
            number_format((float) $report->remaining_payment ?? 0, 2),
            number_format((float) $report->total_amount ?? 0, 2),
            $report->payment_type === 'COD' ? 'Cash' : ($report->payment_type ?? '-'),
            $report->parcelStatus->status ?? '-',
            $report->pickup_type === 'self' ? 'In Person' : $report->pickup_type,
            $report->delivery_type === 'self' ? 'In Person' : $report->delivery_type,
            $report->weight ?? '-',
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
