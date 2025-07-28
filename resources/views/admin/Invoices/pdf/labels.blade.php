<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label</title>
    <style>
        @page {
        margin: 15px 10px;
        padding: 0px;
    }
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
            color: #000;
        }

        .label-container {
            max-width: 370px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid #ffffff;
        }

        .address-table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .header-divider {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 10px 0;
        }

        .barcode-section {
            border-bottom: 1px solid #000;
            text-align: center;
            padding: 20px 0;
        }

        .tracking-number {
            font-weight: bold;
            font-size: 30px;
            text-align: center;
            padding: 5px 0;
        }
    </style>
</head>

<body>

        <table width="100%" cellpadding="0" cellspacing="0"
            style="border-collapse: collapse; max-width:370px; margin: 0 auto; background: #fff; border: 1px solid #ffffff; font-family: 'Poppins', sans-serif; margin: 0; padding: 0; font-size: 12px; color: #000;">
            @if(!empty($invoice->barcodes) && count($invoice->barcodes)>0)
            @foreach ($invoice->barcodes as $barcode)
            <tr>
                <td>
                    <table aria-describedby="table-description" style="width: 100%; table-layout: fixed;" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- <td style="vertical-align: top;">
                                    <table>
                                        <tr>
                                            <td style="vertical-align: top;">
                                                {{-- <img style="width: 75px; margin-right: 5px;" src="{{public_path('assets/images/logo_image.png')}}"> --}}
                                            </td>
                                            <td style="vertical-align: top;">
                                                <b style="font-size: 14px;">{{$invoice->warehouse->warehouse_name ?? ''}}</b><br>
                                                {{$invoice->warehouse->address ?? ''}}<br>
                                                The {{$invoice->warehouse->warehouse_code ?? ''}}<br>
                                                {{$invoice->warehouse->country ?? ''}}<br>
                                                Tel-{{$invoice->warehouse->phone ?? ''}}<br>
                                            </td>
                                        </tr>
                                    </table>
                                </td> -->
                                <td style="vertical-align: top; width: 50%;">
                                    <b style="font-size: 14px;">{{$invoice->warehouse->warehouse_name ?? ''}}</b><br>
                                    {{$invoice->warehouse->address ?? ''}}<br>
                                    The {{$invoice->warehouse->warehouse_code ?? ''}}<br>
                                    {{$invoice->warehouse->country ?? ''}}
                                    Tel-{{$invoice->warehouse->phone ?? ''}}<br>
                                </td>
                                <td style="text-align: right; vertical-align: top; width: 50%;">
                                    @if($invoice->invoiceParcelData && $invoice->invoiceParcelData->arrivedWarehouse)
                                    <b style="font-size: 14px;">{{$invoice->invoiceParcelData->arrivedWarehouse->warehouse_name
                                        ?? ''}}</b><br>
                                    {{$invoice->invoiceParcelData->arrivedWarehouse->address
                                    ?? ''}},<br>
                                    The {{$invoice->invoiceParcelData->arrivedWarehouse->warehouse_code ?? ''}}<br>
                                    Tel-{{$invoice->invoiceParcelData->arrivedWarehouse->phone ?? ''}}<br>
                                    {{-- Tel 718-954-9093<br> --}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="height: 1px;"></td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="font-weight: bold; font-size: 30px; color: #000; text-align: center;">
                                    {{ $invoice->invoice_no ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="height: 5px;"></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- {{$invoice->warehouse->address ?? ''}}<br>
                    The {{$invoice->warehouse->warehouse_code ?? ''}}<br>
                    {{$invoice->warehouse->country ?? ''}}
                    Tel-{{$invoice->warehouse->phone ?? ''}}<br> -->
                    <table aria-describedby="table-description"
                        style="width: 100%; table-layout: fixed; border-top: 1px solid #000000; border-bottom: 1px solid #000000;">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding-top: 8px; padding-bottom: 8px; font-weight: 700; font-size: 13px;">
                                    {{ $invoice->created_at ? $invoice->created_at->format('m/d/Y') : '' }}</td>
                                <td
                                    style="padding-top: 8px; padding-bottom: 8px; font-weight: 700; font-size: 13px; text-align: right; width: 80%;">
                                    {{$invoice->warehouse->name ?? ''}}
                                    {{$invoice->warehouse->address ?? ''}} </td>
                            </tr>
                        </tbody>
                    </table>
                     <!-- {{$invoice->warehouse->address ?? ''}}<br>
                    The {{$invoice->warehouse->warehouse_code ?? ''}}<br>
                    {{$invoice->warehouse->country ?? ''}}
                    Tel-{{$invoice->warehouse->phone ?? ''}}<br> -->
                    <table aria-describedby="table-description"
                        style="width: 100%; table-layout: fixed;">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr></tr>
                            <tr>
                                @if ($invoice->deliveryAddress)
                                <td>
                                    <b style="font-size: 13px;">Ship To:</b><br>
                                    {{ $invoice->deliveryAddress->full_name ?? '' }} <br>
                                    {{ $invoice->deliveryAddress->address ?? '' }}<br>
                                    {{ $invoice->deliveryAddress->state_id ?? '' }} {{
                                    $invoice->deliveryAddress->country_id ?? '' }} <br>
                                </td>
                                @endif
                                <td style="width: 60%; text-align: right; font-size: 14px; font-weight: 700;">
                                    <!-- Tracking Items: {{count($invoice->barcodes??[])}} -->
                                    Tracking Items: {{$loop->iteration}} out of {{count($invoice->barcodes)}}


                                </td>
                            </tr>
                            <tr>
                                <td style="height:0px;"></td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td>
                                    {{ $invoice->pickupAddress->full_name ?? '' }} <br>
                                    {{ $invoice->pickupAddress->address ?? '' }}<br>
                                    {{ $invoice->pickupAddress->state_id ?? '' }} {{ $invoice->pickupAddress->country_id
                                    ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="height: 0px;"></td>
                            </tr>
                            {{-- <tr>
                                <td style="text-align: left; font-weight: 500; font-size: 14px;">
                                    {{ $invoice->invoce_item[0]['supply_name'] ?? '' }}
                                </td>
                            </tr> --}}
                            <tr>
                                <td style="height:0px;"></td>
                            </tr>
                        </tbody>
                    </table>

                    <table cellpadding="0" cellspacing="0"
                        style="width: 100%; border-radius: 4px; border-bottom: 1px solid #000000;">
                        <thead>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;">
                                    <table style="width: 100%; border: 1px solid #000000;" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <!-- <td style="text-align: center; vertical-align: middle;">
                                                <div style="display: inline-block; text-align: center;">
                                                    <span>{!! $barcode->barcode ?? '' !!}</span>
                                                </div>
                                            </td> -->
                                            <td style="vertical-align: middle; padding: 5px;">
                                                <table style="width: 100%;" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td>
                                                            <span style="font-size: 12px;">@if ($barcode->ParcelInventory)
                                                                {{ $barcode->ParcelInventory->supply_name ?? '' }}
                                                                @else
                                                                {{ $barcode->description ?? '' }}
                                                                @endif</span>
                                                        </td>
                                                    </tr>
                                                    <tr><td style=" padding: 5px 0px"><span>{!! $barcode->barcode ?? '' !!}</span></td></tr>
                                                    <tr>
                                                        <td><span style="font-weight: bold; font-size: 15px;">{!! $barcode->barcode_code ?? '' !!}</span></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td style="border: 1px solid #000; text-align: center; vertical-align: middle; width: 100px; height: 60px; font-weight: 700; font-size: 52px;">D</td>
                                        </tr>
                                        <!-- <tr>
                                            <td>
                                                <div>

                                                </div>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <div style="display: inline-block; text-align: center;">
                                                    <span style="font-weight: bold; font-size: 16px;">{!! $barcode->barcode_code ?? '' !!}</span>
                                                </div>
                                            </td>
                                        </tr> -->
                                    </table>
                                    <br>
                                    <strong>
                                        {{ $invoice->pickupAddress->address ?? '' }}
                                    </strong>
                                    <br>
                                    <strong>
                                        {{ $invoice->pickupAddress->state_id ?? '' }} {{
                                        $invoice->pickupAddress->country_id ?? '' }}
                                    </strong>
                                    <br>
                                    {{url('/')}}
                                </td>
                            </tr>
                            <tr>
                                <td style="height: 20px;"></td>
                            </tr>
                        </tbody>
                    </table>

                </td>
            </tr>
            @endforeach
            @endif
        </table>

</body>

</html>
