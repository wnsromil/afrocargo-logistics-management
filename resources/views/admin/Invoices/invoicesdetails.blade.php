<x-app-layout>
    <x-slot name="header">
        {{ __('Invoices') }}
    </x-slot>
    <x-slot name="cardTitle">
        Invoices Details
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap');

        .invoice-container {
            /* max-width: 800px; */
            margin: 10px auto;
            background: #FFFFFF;
            font-family: 'Poppins', sans-serif;
            color: rgba(0, 0, 0, 0.8);
        }

        .header-section {
            display: flex;
            /* justify-content: space-between; */
            margin-bottom: 20px;
            padding: 20px;
            background: #FAFAFA;
        }

        .company-address {
            color: #3A3A3A;
            font-family: Poppins;
            font-weight: 400;
            font-size: 14px;
            line-height: 21px;
            letter-spacing: 0%;
            margin-left: 20px;

        }

        .invoice-info {
            margin: 20px 0;
            padding: 15px;
            background: #F9F9F9;
            border: 1px solid #DFDFDFCC;
            justify-content: space-between;
            display: flex;
            font-family: Poppins;
            font-weight: 500;
            font-size: 14px;
            line-height: 21px;
            letter-spacing: 0%;
            color: #000000;
        }

        .highlight {
            color: #3A3A3A;
            font-family: Poppins;
            font-weight: 400 !important;
            font-size: 14px;
            line-height: 21px;
            letter-spacing: 0%;
        }

        .details-section {
            display: flex;
            gap: 20px;
            margin: 25px 0;
        }

        .details-section h5 {
            color: #000000;
            font-family: Poppins;
            font-weight: 600;
            font-size: 17px;
            line-height: 25.5px;
            letter-spacing: 0%;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            background: #FFFFFF;
        }

        th {
            background: #FAFAFA;
            color: #252F49;
            font-weight: 600;
            padding: 12px;
            border: 1px solid #DFDFDFCC;
        }

        td {
            padding: 12px;
            border: 1px solid #DFDFDFCC;
            color: #3A3A3A;
        }

        .total-section {
            text-align: right;
            margin-top: 0px;
            padding: 20px;
        }

        .footer-section {
            margin-top: 40px;
            padding: 25px;
            background: #252F49;
            color: #FFFFFF;
        }

        .download-buttons {
            margin-top: 0px;
            text-align: end;
        }

        .btn-download {
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: 600;
            margin: 0 10px;
            cursor: pointer;
        }

        .btn-primary {
            background: #252F49;
            color: white;
            border: none;
        }

        .btn-secondary {
            background: #737B8B;
            color: white;
            border: none;
        }

        h2 {
            font-size: 22px;
            line-height: 33px;
            color: #252F49;
        }

        .total-section h5 {
            font-size: 19px;
            line-height: 33px;
            color: #000000;
            font-weight: bold;
        }

        .total-section p {
            font-size: 17px;
        }

        .total-section-span {
            color: black;
            font-weight: bold;
        }

        .row-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            background: #E7E9F6;
            gap: 20px;
        }

        .signature-section,
        .total-section {
            width: 48%;
            padding: 20px;
            /* Adjust width as per need */
        }

        .signature-image {
            display: block;
            max-width: 150px;
            height: auto;
            background-color: transparent;
            mix-blend-mode: multiply;
        }

        @media print {
            .download-buttons {
                display: none;
            }
        }
    </style>

    <div class="invoice-container">
        <!-- Download Buttons -->
        <div class="download-buttons" id="downloadButtons">
            <a href="{{ route('admin.invoices.invoicesdownload', $getInvoice['id']) }}" class="btn btn-primary me-2">
                <i class="fa-solid fa-download me-2"></i>Download PDF
            </a>

            <a href="javascript:void(0)" class="btn btn-primary me-2" onclick="printInvoice()">
                <i class="fa fa-print me-2"></i>Print Invoice
            </a>

        </div>

        <!-- Header Section -->
        <div class="header-section">
            <img src="{{asset('assets/images/AfroCargoLogo.svg')}}" alt="">
            <div class="company-address">
                Noviiren Cargo NY<br>
                366 Concord Ave NY<br>
                ID: 0004054<br>
                Tel: 646-468-4155<br>
                Tel: 718-954-9093
            </div>
        </div>

        <!-- Invoice Info -->
        <div class="invoice-info">
            <p><span class="highlight">Issue
                    Date:</span>{{Carbon\Carbon::parse($getInvoice->issue_date)->format('d-m-Y')}}</p>
            <p><span class="highlight">Driver Name:</span>{{$getInvoice->parcel->driver->name}}</p>
            <p><span class="highlight">Cont:</span> 0425</p>
            <p><span class="highlight">Invoice No:</span> {{$getInvoice->invoice_no}}</p>
        </div>

        <!-- Customer & Shipping Details -->
        <div class="details-section">
            <div style="flex:4">
                <h5>Customer</h5>
                {{$getInvoice->parcel->customer->name}}<br>
                {{$getInvoice->parcel->customer->address}}<br>
                {{$getInvoice->parcel->customer->phone}}
            </div>

            <div style="flex:1">
                <h5>Ship To</h5>
                {{$getInvoice->parcel->destination_user_name}}<br>
                {{$getInvoice->parcel->destination_address}}<br>
                {{$getInvoice->parcel->destination_user_phone}}
            </div>
        </div>

        <!-- Items Table -->
        <table>
            <thead>
                <tr>
                    <th>Product / Service</th>
                    <th>Quantity</th>
                    <th>Weight</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>Payment Type</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ implode(', ', array_map('ucfirst', $getInvoice->parcel->getCategoryNamesAttribute())) }}</td>
                    <td>1</td>
                    <td>{{$getInvoice->parcel->weight}}</td>
                    <td>${{$getInvoice->parcel->partial_payment}}</td>
                    <td>${{$getInvoice->parcel->remaining_payment}}</td>
                    <td>{{$getInvoice->parcel->payment_type}}</td>
                    <td>${{$getInvoice->parcel->total_amount}}</td>
                </tr>
                <!-- Repeat for other items -->
            </tbody>
        </table>

        <!-- Total Section -->
        <div class="row-container" style="background-color: #E7E9F6;">
            <div class="signature-section">
                <p>I have Received the Contract and Accept the Terms and Condition.</p>
                <p style="margin-top:20px;">Authorised Sign</p>
                <img class="signature-image" src="{{asset('assets/images/white_signature.png')}}" alt="">
            </div>

            <div class="total-section">
                <p>Paid : <span class="total-section-span">${{$getInvoice->parcel->partial_payment}}</span></p>
                <p>Due : <span class="total-section-span">${{$getInvoice->parcel->remaining_payment}}</span></p>
                <h5>Total Amount: ${{$getInvoice->parcel->total_amount}}</h5>
            </div>
        </div>
    </div>
    <script>
        function printInvoice() {
            window.print();
        }
    </script>
</x-app-layout>