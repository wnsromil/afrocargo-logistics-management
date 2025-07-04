<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
            color: #000;
        }

        .label-container {
            width: 460px;
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
    <div class="label-container p-2">
        <table width="100%" cellpadding="0" cellspacing="0"
            style="border-collapse: collapse; max-width:100%; margin: 0 auto; background: #fff; border: 1px solid #ffffff; font-family: 'Poppins', sans-serif; margin: 0; padding: 0; font-size: 12px; color: #000;">
            @if(!empty($invoice->barcodes) && count($invoice->barcodes)>0)
            @foreach ($invoice->barcodes as $barcode)
            <tr>
                <td>
                    <table aria-describedby="table-description" style="width: 100%; table-layout: fixed;">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="vertical-align: baseline;">
                                    <table>
                                        <tr>
                                            <td style=" vertical-align: middle;">
                                                <img style="width: 60px; margin-right: 5px;"
                                                    src="https://afrocargo.senomicsecurity.in/public/assets/images/AfroCargoLogo.svg">
                                            </td>
                                            <td>
                                                <strong>{{$invoice->warehouse->warehouse_name ?? ''}}</strong><br>
                                                {{$invoice->warehouse->address ?? ''}}<br>
                                                The {{$invoice->warehouse->warehouse_code ?? ''}}<br>
                                                {{$invoice->warehouse->country ?? ''}}<br>
                                                Tel-{{$invoice->warehouse->phone ?? ''}}<br>
                                            </td>
                                        </tr>
                                    </table>
                                <td style="text-align: right;">
                                    @if($invoice->invoiceParcelData)
                                    <b style="font-size: 18px;">{{$invoice->invoiceParcelData->arrivedWarehouse->warehouse_name
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
                                <td style="height: 5px;"></td>
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
                    {{$invoice->warehouse->address ?? ''}}<br>
                    The {{$invoice->warehouse->warehouse_code ?? ''}}<br>
                    {{$invoice->warehouse->country ?? ''}}<br>
                    Tel-{{$invoice->warehouse->phone ?? ''}}<br>
                    <table aria-describedby="table-description"
                        style="width: 100%; table-layout: fixed; border-top: 1px solid #000000; border-bottom: 1px solid #000000;">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding-top: 10px; padding-bottom: 10px; font-weight: 700; font-size: 14px;">
                                    {{ $invoice->created_at ? $invoice->created_at->format('m/d/Y') : '' }}</td>
                                <td
                                    style="padding-top: 10px; padding-bottom: 10px; font-weight: 700; font-size: 14px; text-align: right;">
                                    {{$invoice->warehouse->name ?? ''}}
                                    {{$invoice->warehouse->address ?? ''}} </td>
                            </tr>
                        </tbody>
                    </table> {{$invoice->warehouse->address ?? ''}}<br>
                    The {{$invoice->warehouse->warehouse_code ?? ''}}<br>
                    {{$invoice->warehouse->country ?? ''}}<br>
                    Tel-{{$invoice->warehouse->phone ?? ''}}<br>
                    <table aria-describedby="table-description"
                        style="width: 100%; table-layout: fixed; border-bottom: 1px solid #000;">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr></tr>
                            <tr>
                                <td>
                                    <b style="font-size: 13px;">Ship To:</b><br>
                                    {{ $invoice->deliveryAddress->full_name ?? '' }} <br>
                                    {{ $invoice->deliveryAddress->address ?? '' }}<br>
                                    {{ $invoice->deliveryAddress->state_id ?? '' }} {{
                                    $invoice->deliveryAddress->country_id ?? '' }} <br>
                                </td>
                                <td style="text-align: right; font-size: 15px; font-weight: 700;">
                                    Tracking Items: {{count($invoice->barcodes??[])}}
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
                                <td colspan="2" style="height: 5px;"></td>
                            </tr>
                            {{-- <tr>
                                <td style="text-align: left; font-weight: 500; font-size: 14px;">
                                    {{ $invoice->invoce_item[0]['supply_name'] ?? '' }}
                                </td>
                            </tr> --}}
                            <tr>
                                <td style="height:5px;"></td>
                            </tr>
                        </tbody>
                    </table>

                    <table aria-describedby="table-description"
                        style="width: 100%; border-radius: 4px; border-bottom: 1px solid #000000;">
                        <thead>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="">
                                </td>
                            </tr>
                            <tr>
                                <td style="">
                                    @if ($barcode->ParcelInventory)
                                    {{ $barcode->ParcelInventory->supply_name ?? '' }}
                                    @else
                                    {{ $barcode->description ?? '' }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <div>
                                        <div style="display: flex; justify-content: center; align-items: center;">
                                            {!! $barcode->barcode ?? '' !!}
                                        </div>
                                        <span
                                            style="display: block; font-weight: bold; font-size: 16px; text-align: center;">
                                            {!! $barcode->barcode_code ?? '' !!}
                                        </span>
                                    </div>
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
    </div>

</body>

</html>