<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>

<body style="font-family: 'Poppins', sans-serif; color: rgba(0, 0, 0, 0.8); margin: 0; padding: 0;">
    <div style="width: 100%; margin: 0 auto; background: #FFFFFF;">
        <!-- Header Section -->
        <table style="width: 100%; background: #FAFAFA; border-collapse: collapse; margin-bottom: 16px; padding: 16px;">
            <tr>
                <td style="width: 60px; padding: 8px; vertical-align: top;">
                    <img src="{{ public_path('assets/images/logo_image.png') }}" alt="Company Logo"
                        style="max-width: 50px; height: auto;">
                </td>
                <td
                    style="padding: 8px; color: #3A3A3A; font-weight: 400; font-size: 11.2px; line-height: 16.8px; vertical-align: top;">
                    Noviiren Cargo NY<br>
                    366 Concord Ave NY<br>
                    ID: 0004054<br>
                    Tel: 646-468-4155<br>
                    Tel: 718-954-9093
                </td>
            </tr>
        </table>
        <!-- Invoice Info -->
        <table
            style="width: 100%; border-collapse: collapse; font-size: 11.2px; line-height: 16.8px; background: #F9F9F9; border: 1px solid #DFDFDFCC; margin: 16px 0; padding: 12px;">
            <tr>
                <td style="padding: 8px; color: #3A3A3A; border-right: 1px solid #DFDFDF;">Issue Date:
                    <strong>{{ Carbon\Carbon::parse($getInvoice->issue_date)->format('d-m-Y') }}</strong></td>
                <td style="padding: 8px; color: #3A3A3A; border-right: 1px solid #DFDFDF;">Driver Name:
                    <strong>{{ $getInvoice->parcel->driver->name }}</strong></td>
                <td style="padding: 8px; color: #3A3A3A; border-right: 1px solid #DFDFDF;">Cont: <strong>0425</strong>
                </td>
                <td style="padding: 8px; color: #3A3A3A;">Invoice No: <strong>{{ $getInvoice->invoice_no }}</strong>
                </td>
            </tr>
        </table>


        <!-- Customer & Shipping Details -->
        <div style="margin: 20px 0;">
            <table style="width: 100%; border-collapse: collapse; margin: 20px 0; background: #FFFFFF;">
                <tr>
                    <td style="width: 70%;">
                        <h5
                            style="color: #000000; font-weight: 600; font-size: 13.6px; line-height: 20.4px; margin-bottom: 8px;">
                            Customer</h5>
                        <span style="font-size: 11.2px;">{{ $getInvoice->parcel->customer->name }}</span><br>
                        <span style="font-size: 11.2px;">{{ $getInvoice->parcel->customer->address }}</span><br>
                        <span style="font-size: 11.2px;">{{ $getInvoice->parcel->customer->phone }}</span>
                    </td>
                    <td style="width: 30%;">
                        <h5
                            style="color: #000000; font-weight: 600; font-size: 13.6px; line-height: 20.4px; margin-bottom: 8px;">
                            Ship To</h5>
                        <span style="font-size: 11.2px;">{{ $getInvoice->parcel->destination_user_name }}</span><br>
                        <span style="font-size: 11.2px;">{{ $getInvoice->parcel->destination_address }}</span><br>
                        <span style="font-size: 11.2px;">{{ $getInvoice->parcel->destination_user_phone }}</span>
                    </td>
                </tr>
            </table>
        </div>
        <!-- Items Table -->
        <table style="width: 100%; border-collapse: collapse; margin: 20px 0; background: #FFFFFF;">
            <thead>
                <tr>
                    <th
                        style=" text-align: left; padding: 9.6px; border: 1px solid #DFDFDFCC; background: #FAFAFA; color: #252F49; font-weight: 600; font-size: 11.2px;">
                        Product / Service</th>
                    <th
                        style=" text-align: left; padding: 9.6px; border: 1px solid #DFDFDFCC; background: #FAFAFA; color: #252F49; font-weight: 600; font-size: 11.2px;">
                        Quantity</th>
                    <th
                        style=" text-align: left; padding: 9.6px; border: 1px solid #DFDFDFCC; background: #FAFAFA; color: #252F49; font-weight: 600; font-size: 11.2px;">
                        Weight</th>
                    <th
                        style=" text-align: left; padding: 9.6px; border: 1px solid #DFDFDFCC; background: #FAFAFA; color: #252F49; font-weight: 600; font-size: 11.2px;">
                        Paid</th>
                    <th
                        style="  text-align: left; padding: 9.6px; border: 1px solid #DFDFDFCC; background: #FAFAFA; color: #252F49; font-weight: 600; font-size: 11.2px;">
                        Due</th>
                    <th
                        style=" text-align: left; padding: 9.6px; border: 1px solid #DFDFDFCC; background: #FAFAFA; color: #252F49; font-weight: 600; font-size: 11.2px;">
                        Payment Type</th>
                    <th
                        style=" text-align: left; padding: 9.6px; border: 1px solid #DFDFDFCC; background: #FAFAFA; color: #252F49; font-weight: 600; font-size: 11.2px;">
                        Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 9.6px; border: 1px solid #DFDFDFCC; color: #3A3A3A; font-size: 11.2px;">
                        {{ implode(', ', array_map('ucfirst', $getInvoice->parcel->getCategoryNamesAttribute())) }}
                    </td>
                    <td style="padding: 9.6px; border: 1px solid #DFDFDFCC; color: #3A3A3A; font-size: 11.2px;">1</td>
                    <td style="padding: 9.6px; border: 1px solid #DFDFDFCC; color: #3A3A3A; font-size: 11.2px;">
                        {{ $getInvoice->parcel->weight }}
                    </td>
                    <td style="padding: 9.6px; border: 1px solid #DFDFDFCC; color: #3A3A3A; font-size: 11.2px;">
                        ${{ $getInvoice->parcel->partial_payment }}</td>
                    <td style="padding: 9.6px; border: 1px solid #DFDFDFCC; color: #3A3A3A; font-size: 11.2px;">
                        ${{ $getInvoice->parcel->remaining_payment }}</td>
                    <td style="padding: 9.6px; border: 1px solid #DFDFDFCC; color: #3A3A3A; font-size: 11.2px;">
                        {{ $getInvoice->parcel->payment_type }}
                    </td>
                    <td style="padding: 9.6px; border: 1px solid #DFDFDFCC; color: #3A3A3A; font-size: 11.2px;">
                        ${{ $getInvoice->parcel->total_amount }}</td>
                </tr>
            </tbody>
        </table>
        <table width="100%" style="background-color: #E7E9F6; padding: 10px; font-size: 11.2px;">
            <tr>
                <td style="vertical-align: top; width: 50%;">
                    <p style="margin: 0;">I have Received the Contract and Accept the Terms and Condition.</p>
                    <p style="margin-top: 8px;">Authorised Sign</p>
                    <img style="max-width: 120px; height: auto;"
                        src="{{ public_path('assets/images/white_signature.png') }}" alt="Signature">
                </td>
                <td style="vertical-align: top; text-align: right; width: 50%;">
                    <p style="color: black; font-weight: bold; margin: 0;">Paid:
                        ${{ $getInvoice->parcel->partial_payment }}</p>
                    <p style="color: black; font-weight: bold; margin: 0;">Due:
                        ${{ $getInvoice->parcel->remaining_payment }}</p>
                    <h5 style="color: black; font-weight: bold; margin: 0; font-size: 13.6px;">Total Amount:
                        ${{ $getInvoice->parcel->total_amount }}</h5>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>