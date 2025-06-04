<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargo Invoice</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <!-- Header Section -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td style="text-align: center; padding: 10px;">
                <h2 style="margin: 0;">CARGO INVOICE</h2>
            </td>
        </tr>
    </table>

    <!-- Company Details -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td style="padding: 5px;">
                <strong>Afro Cargo Express Llc NY</strong><br>
                366 Concord Ave<br>
                NY, The Bronx 10454<br>
                Tel.: 718-954-9033
            </td>
            <td style="text-align: center; padding: 5px;">
                <span style="background-color: red; color: white; padding: 5px;">DUE BALANCE</span>
            </td>
            <td style="text-align: right; padding: 5px;">
                <strong>Afro Cargo Express Llc Abidjan</strong><br>
                Avenue 21 Rue 15 Treichville<br>
                Abidjan Autonomous District, Abidjan.<br>
                Tel.: 07 89 49 2486
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
                <p style="text-align: -webkit-left;">
                <strong>Ship To:</strong><br>
                {{ $invoice->deliveryAddress->full_name ?? 'N/A' }}<br>
                {{ $invoice->deliveryAddress->address ?? 'N/A' }}<br>
                Cel.: {{ $invoice->deliveryAddress->mobile_number ?? 'N/A' }}<br>
                Tel.: {{ $invoice->deliveryAddress->alternative_mobile_number ?? 'N/A' }}
                </p>
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
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">
        <thead>
            <tr style="background-color: #f2f2f2; border: 1px solid black;">
                <th style="border: 1px solid black; padding: 5px;">P.: {{ $invoice->pickupAddress->city_id ?? 'N/A' }}</th>
                <th style="border: 1px solid black; padding: 5px;">M.: {{ $invoice->deliveryAddress->city_id ?? 'N/A' }}</th>
                <th style="border: 1px solid black; padding: 5px;">S.: {{ $invoice->deliveryAddress->city_id ?? 'N/A' }}</th>
            </tr>
        </thead>
        <tbody>
            <tr style="background-color: #f2f2f2; border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Invoice Date: {{ date('m/d/Y', strtotime($invoice->issue_date)) }}</td>
                <td style="border: 1px solid black; padding: 5px;">Pay Terms: {{ $invoice->pickupAddress->country_id ?? 'N/A' }}</td>
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
            <tr style="background-color: #007bff; color: white; border: 1px solid black;">
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
            @foreach($invoice->invoce_item as $index => $item)
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">{{ $index + 1 }}</td>
                <td style="border: 1px solid black; padding: 5px;">{{ $item['qty'] ?? '-' }}</td>
                <td style="border: 1px solid black; padding: 5px;">{{ $item['supply_id'] }}</td>
                <td style="border: 1px solid black; padding: 5px;">{{ $item['supply_name'] }}</td>
                <td style="border: 1px solid black; padding: 5px;">${{ number_format($item['price'], 2) }}</td>
                <td style="border: 1px solid black; padding: 5px;">${{ number_format($item['discount'] ?? 0, 2) }}</td>
                <td style="border: 1px solid black; padding: 5px;">${{ number_format($item['ins'], 2) }}</td>
                <td style="border: 1px solid black; padding: 5px;">${{ number_format($item['tax'], 2) }}</td>
                <td style="border: 1px solid black; padding: 5px;">${{ number_format($item['total'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Notes Section -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td style="padding: 5px;">
                <strong>Notes:</strong><br>
                {{ $invoice->notes ?? '*****' }}
            </td>
        </tr>
    </table>

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
                    <strong>DECLARO que no estoy enviando:</strong> DROGA, DINERO, ARMAS DE FUEGO Y EXPLOSIVOS, QUÍMICOS Y NINGÚN ARTÍCULOS PROHIBIDO POR LEY. Entiendo que he pagado por lo que he declarado y si llegase a omitir cualquier artículo me comprometo a pagar los Impuestos y Multa por mala declaración. Tengo 30 días para realizar el pago, caso contrario autorizo a la Empresa A SUBASTAR MIS CAJAS. También entiendo que mi carga ha sido asegurada en un 100% del valor declarado y que en la eventualidad de que ocurra pérdida parcial total, la empresa se compromete a reembolsarme al 100% del valor declarado y si hay pérdida parcial el reembolso será proporcional al faltante de las libras. También conozco que la empresa no es responsable durante el transporte por ROTURAS o DAÑOS.
                </p>
            </td>
        </tr>
    </table>

    <!-- Footer Section -->
    <table style="width: 100%; border-collapse: collapse;">
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
    </table>
</body>
</html>