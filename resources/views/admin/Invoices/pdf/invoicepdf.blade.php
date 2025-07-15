<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invoice->transport_type ?? 'Supply'}} Invoice</title>
</head>

<body style="font-family: Arial, sans-serif;">
    <!-- Header Section -->
    
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td>
                <img style="width: 75px; margin-right: 5px;"
                    src="{{public_path('assets/images/logo_image.png')}}">
            </td>
            <td style="text-align: center; padding: 10px;">
                <h2 style="margin: 0;">{{ $invoice->transport_type ?? 'Supply'}} Invoice</h2>
            </td>
        </tr>
    </table>

    <!-- Company Details -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td style="width: 40%; padding: 5px;">
                <strong >{{$invoice->warehouse->warehouse_name ?? ''}}</strong><br>
                {{$invoice->warehouse->address ?? ''}}<br>
                The {{$invoice->warehouse->warehouse_code ?? ''}}<br>
                {{$invoice->warehouse->country ?? ''}}<br>
                Tel-{{$invoice->warehouse->phone ?? ''}}<br>
            </td>
            <td style="width: 20%; text-align: center; padding: 5px;">
                <span style="background-color: red; color: white; padding: 5px;">DUE BALANCE</span>
            </td>
            <td style="width: 40%; text-align: right; padding: 5px;">
                @if($invoice->invoiceParcelData && $invoice->invoiceParcelData->arrivedWarehouse)
                    <strong>{{$invoice->invoiceParcelData->arrivedWarehouse->warehouse_name
                        ?? ''}}</strong><br>
                        {{$invoice->invoiceParcelData->arrivedWarehouse->address
                        ?? ''}},<br>
                    The {{$invoice->invoiceParcelData->arrivedWarehouse->warehouse_code ?? ''}}<br>
                    Tel-{{$invoice->invoiceParcelData->arrivedWarehouse->phone ?? ''}}<br>
                    {{-- Tel 718-954-9093<br> --}}
                @endif
            </td>
        </tr>
    </table>

    <!-- Customer and Ship To Details -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td style="width: 50%; padding: 5px;">
                <strong>Customer:</strong><br>
                {{ $invoice->pickupAddress->user->name ?? 'N/A' }}<br>
                {{ $invoice->pickupAddress->address ?? 'N/A' }}<br>
                {{ $invoice->pickupAddress->city_id ?? 'N/A' }}, {{ $invoice->pickupAddress->pincode ?? 'N/A' }}<br>
                Cel.: {{ $invoice->pickupAddress->mobile_number ?? 'N/A' }}<br>
                Tel.: {{ $invoice->pickupAddress->alternative_mobile_number ?? 'N/A' }}
            </td>
            <td style="width: 50%; padding: 5px; text-align: right;">
                @if($invoice->deliveryAddress)
                <p style="text-align: -webkit-left;">
                    <strong>Ship To:</strong><br>
                    {{ $invoice->deliveryAddress->full_name ?? 'N/A' }}<br>
                    {{ $invoice->deliveryAddress->address ?? 'N/A' }}<br>
                    Cel.: {{ $invoice->deliveryAddress->mobile_number ?? 'N/A' }}<br>
                    Tel.: {{ $invoice->deliveryAddress->alternative_mobile_number ?? 'N/A' }}
                </p>
                @endif
            </td>
        </tr>
    </table>

    <!-- Date & Time Printed and Invoice Number -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td style="width: 50%; padding: 5px;">
                <strong>Date & Time Printed:</strong> {{ date('M.d.Y -- H:i:s') }}
            </td>
            <td style="width: 50%; text-align: right; padding: 5px;">
                <strong>Inv No.:</strong> {{ $invoice->invoice_no ?? 'N/A' }}<br>
                <strong>Cont :</strong> {{ substr($invoice->container_id ?? 'N/A', -4) }}
            </td>
        </tr>
    </table>

    <!-- Table Section -->
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 0px;">
        <thead>
            <tr style="background-color: #f2f2f2; border: 1px solid black;">
                <th style="border: 1px solid black; padding: 5px;">
                    Tracking# : <b>{{$invoice->invoiceParcelData && !empty($invoice->invoiceParcelData->tracking_number) ? $invoice->invoiceParcelData->tracking_number:''}}</b>
                </th>
                <th style="border: 1px solid black; padding: 5px;">
                    Invoice# : <b>{{$invoice->invoice_no ?? ''}}</b>
                </th>
                <th style="border: 1px solid black; padding: 5px;">
                    container# : <b>{{$invoice->container && $invoice->container->unique_id ? $invoice->container->unique_id:'' }}</b>
                </th>
                <th style="border: 1px solid black; padding: 5px;">
                    country#: <b>{{ $invoice->deliveryAddress && $invoice->deliveryAddress->country_id ? $invoice->deliveryAddress->country_id : '' }}</b>
                </th>
            </tr>
        </thead>
    </table>
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">
        <tbody>
            <tr style="background-color: #f2f2f2; border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Invoice Date: {{ date('m/d/Y',
                    strtotime($invoice->issue_date)) }}</td>
                <td style="border: 1px solid black; padding: 5px;">Pay Terms: {{ $invoice->pickupAddress->country_id ??
                    'N/A' }}</td>
                <td style="border: 1px solid black; padding: 5px;">Driver: {{ $invoice->driver_id ?? 'N/A' }}</td>
            </tr>
            <tr style="background-color: #f2f2f2; border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Ship Via: CARGO</td>
                <td style="border: 1px solid black; padding: 5px;">Branch: {{ $invoice->warehouse_id ?? 'N/A' }}</td>
                <td style="border: 1px solid black; padding: 5px;">User: {{ $invoice->generated_by ?? 'N/A' }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Item Details Table -->
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">
        <thead>
            <tr style="background-color: #203A5F; color:white; border: 1px solid black;">
                <th style="border: 1px solid black; padding: 5px;">#</th>
                <th style="border: 1px solid black; padding: 5px;">Qty.</th>
                <th style="border: 1px solid black; padding: 5px;">Item</th>
                <th style="border: 1px solid black; padding: 5px;">Description</th>
                <th style="border: 1px solid black; padding: 5px;">Price</th>
                <th style="border: 1px solid black; padding: 5px;">Disc.</th>
                <th style="border: 1px solid black; padding: 5px;">Ins.</th>
                <th style="border: 1px solid black; padding: 5px;">Tax%</th>
                <th style="border: 1px solid black; padding: 5px;">Total</th>
            </tr>
        </thead>
        <tbody>
            @if ($invoice->invoce_item && is_array($invoice->invoce_item) && count($invoice->invoce_item) > 0)
                @foreach($invoice->invoce_item as $index => $item)
                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black; padding: 5px;">{{ $index + 1 }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item['qty'] ?? '-' }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item['supply_id'] }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item['supply_name'] }}</td>
                    <td style="border: 1px solid black; padding: 5px;">${{ number_format($item['price'], 2) }}</td>
                    <td style="border: 1px solid black; padding: 5px;">${{ number_format($item['discount'] ?? 0, 2) }}</td>
                    <td style="border: 1px solid black; padding: 5px;">${{ number_format($item['ins'], 2) }}</td>
                    <td style="border: 1px solid black; padding: 5px;">${{ !empty($item['total']) ? number_format($item['tax'], 2):0 }}</td>
                    <td style="border: 1px solid black; padding: 5px;">${{ !empty($item['total']) ? number_format($item['total'], 2) :'0' }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <!-- Notes Section -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td style="padding: 5px;">
                <strong>Notes:</strong><br>
                @if ($invoice->comments && count($invoice->comments) > 0)
                    @foreach ($invoice->comments->where('type','notes')->values() as $comment)
                        <p style="margin: 0;">{{ $comment->notes ?? '' }} - {{ $comment->created_at ? $comment->created_at->format('m/d/Y, h:i a') : '' }}</p>
                    @endforeach
                    
                @endif
            </td>
        </tr>
    </table>

    @if(!empty($invoice->individualPayment) && count($invoice->individualPayment) > 0)
     <table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">
        <thead>
            <tr style="background-color: #203A5F; color:white; border: 1px solid black;">
                <th style="border: 1px solid black; padding: 5px;">Invoice ID</th>
                <th style="border: 1px solid black; padding: 5px;">User</th>
                <th style="border: 1px solid black; padding: 5px;">Payment Type</th>
                <th style="border: 1px solid black; padding: 5px;">Payment Date</th>
                <th style="border: 1px solid black; padding: 5px;">Amt. In Dollar</th>
                <th style="border: 1px solid black; padding: 5px;">Local Currency</th>
                <th style="border: 1px solid black; padding: 5px;">Currency</th>
            </tr>
        </thead>

        <tbody>
            @forelse($invoice->individualPayment as $payment)
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">{{ $invoice->invoice_no ?? '' }}</td>
                <td style="border: 1px solid black; padding: 5px;">
                    <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="{{ $payment->createdByUser->name ?? '' }} {{ $payment->createdByUser->last_name ?? '' }}">
                        {{ $payment->createdByUser->name ?? '' }} {{ $payment->createdByUser->last_name ?? '' }}
                    </p>
                </td>
                <td style="border: 1px solid black; padding: 5px;">{{ ucfirst($payment->payment_type ?? '-') }}</td>
                <td style="border: 1px solid black; padding: 5px;">{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('m/d/Y, h:i a') :
                    '-' }}</td>
                <td style="border: 1px solid black; padding: 5px;">{{ number_format($payment->payment_amount ?? 0, 2) }}</td>
                <td style="border: 1px solid black; padding: 5px;">{{ $payment->local_currency ?? '-' }}</td>
                <td style="border: 1px solid black; padding: 5px;">{{ $payment->currency ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No Payments Found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @endif

    <!-- Subtotal and Balance Section -->
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">
        <tbody>
            <tr style="background-color: #f2f2f2; border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px; width: 20%;">Subtotal</td>
                <td style="border: 1px solid black; padding: 5px; width: 20%;">Discount</td>
                <td style="border: 1px solid black; padding: 5px; width: 20%;">Insurance</td>
                <td style="border: 1px solid black; padding: 5px; width: 20%;">Tax</td>
                <td style="border: 1px solid black; padding: 5px; width: 20%;">Items</td>
                <td style="border: 1px solid black; padding: 5px; width: 20%;">Amount</td>
                <td style="border: 1px solid black; padding: 5px; width: 20%;">Payments</td>
                <td style="border: 1px solid black; padding: 5px; width: 20%;">Balance</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">${{ number_format($invoice->total_price, 2) }}</td>
                <td style="border: 1px solid black; padding: 5px;">${{ number_format($invoice->discount, 2) }}</td>
                <td style="border: 1px solid black; padding: 5px;">${{ number_format($invoice->ins, 2) }}</td>
                <td style="border: 1px solid black; padding: 5px;">${{ number_format($invoice->tax, 2) }}</td>
                <td style="border: 1px solid black; padding: 5px;">{{ $invoice->total_qty }}</td>
                <td style="border: 1px solid black; padding: 5px;">${{ number_format($invoice->grand_total, 2) }}</td>
                <td style="border: 1px solid black; padding: 5px;">${{ number_format($invoice->payment, 2) }}</td>
                <td style="border: 1px solid black; padding: 5px;">${{ number_format($invoice->balance, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Declaration Section -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td style="padding: 5px;">
                <p style="font-size: smaller; line-height: 1.2;">
                    <strong>DECLARO que no estoy enviando:</strong> DROGA, DINERO, ARMAS DE FUEGO Y EXPLOSIVOS, QUÍMICOS
                    Y NINGÚN ARTÍCULOS PROHIBIDO POR LEY. Entiendo que he pagado por lo que he declarado y si llegase a
                    omitir cualquier artículo me comprometo a pagar los Impuestos y Multa por mala declaración. Tengo 30
                    días para realizar el pago, caso contrario autorizo a la Empresa A SUBASTAR MIS CAJAS. También
                    entiendo que mi carga ha sido asegurada en un 100% del valor declarado y que en la eventualidad de
                    que ocurra pérdida parcial total, la empresa se compromete a reembolsarme al 100% del valor
                    declarado y si hay pérdida parcial el reembolso será proporcional al faltante de las libras. También
                    conozco que la empresa no es responsable durante el transporte por ROTURAS o DAÑOS.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 40%;">
                            <span>I have Received the Contract and Accept the Terms and
                                Condition.</span><br>
                            <span style="font-size: 18px; font-weight: 600; line-height: 40px;">Authorized
                                Sign</span><br>
                            <img src="{{$invoice->warehouse && $invoice->warehouse->signature ? public_path(removePart($invoice->warehouse->signature->signature_file, url('/'), true, 1)):'public/uploads/signature/download%20(2).png'}}" alt="Signature"
                                style="max-width: 100px;">
                        </td>
                        <td style="width: 40%; "> </td>
                        <td
                            style="width: 20%; text-align: end; font-size: 16px; vertical-align: top; padding: 0px 20px;">
                            <span style="color: #737B8B;">Sub-Total: <b
                                    style="color: #000;">${{$invoice->grand_total ?? 0}}</b></span><br>
                            <span style="color: #737B8B; line-height: 50px;">Paid: <b
                                    style="color: #000;">${{$invoice->payment ?? 0}}</b></span><br>
                            <span style="color: #000;"><b>Total Amount:</b> ${{$invoice->balance ?? 0}} </span><br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr style="padding: 10px 20px; border-top: 3px solid #EFEFEF;">
            <td>
                <table width="100%">
                    <tr>
                        <td style="width: 35%;">
                            <table width="100%">
                                <tr>
                                    <td>
                                        <b style="font-size: 18px;">{{$invoice->warehouse->warehouse_name ?? ''}}</b><br>
                                                    The {{$invoice->warehouse->warehouse_code ?? ''}}<br>
                                                    Tel-{{$invoice->warehouse->phone ?? ''}}<br>
                                                    {{-- Tel 718-954-9093<br> --}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 30%; text-align: center;"> </td>
                        <td style="width: 35%;">
                            @if($invoice->invoiceParcelData && $invoice->invoiceParcelData->arrivedWarehouse)
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
                </table>
            </td>
        </tr>
    </table>

    <!-- Footer Section -->
    {{-- <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="padding: 5px;">
                <strong>Agente - Fecha</strong>
            </td>
            <td style="text-align: center; padding: 5px;">
                <strong>Enviado por - Fecha</strong>
            </td>
            <td style="text-align: right; padding: 5px;">
                <strong>Recibido por - Fecha - ID</strong>
            </td>
        </tr>
    </table> --}}
</body>

</html>