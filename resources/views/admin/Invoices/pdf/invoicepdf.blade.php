<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invoice->transport_type ?? 'Supply'}} Invoice</title>
</head>

<body style="font-family: Arial, sans-serif;">
    <!-- Header Section -->
    <table width="100%" cellpadding="0" cellspacing="0"
        style="border-collapse: collapse; max-width: 900px; margin: 0 auto; background: #fff; border: 1px solid #ffffff; font-family: 'Poppins', sans-serif; padding: 0; font-size: 14px; color: #000;">

        <!-- Header -->
        <tr>
            <td colspan="2" style="padding: 20px 0 0;">
                <table width="100%">
                    <tr>

                        <td style="width: 100%;">
                            <table width="100%">
                                <tr>
                                    <td>
                                        <img style="width: 75px; margin-right: 5px;" src="{{public_path('assets/images/logo_image.png')}}">
                                    </td>
                                    <td style="width: 25%; text-align: center;">
                                        <span
                                            style="background-color: white; padding: 10px 20px; border-radius: 8px; font-size: 18px; font-weight: 600;
                                            border: 1px solid @if($invoice->balance <= 0) #203A5F; color: black; @else red; color: red;@endif">
                                            {{ $invoice->balance <= 0 ? 'Paid':'Due Balance'}}
                                        </span>
                                    </td>
                                    <td style="text-align: center; font-size: 18px; font-weight: 600;">
                                        {{ $invoice->transport_type ?? 'Supply'}} Invoice
                                    </td>
                                </tr>
                            </table>
                        </td>

                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding: 0 20px 0px 20px;">
                <table width="100%">
                    <tr>
                        <td style="width: 60%;">
                            @if($invoice->warehouse)
                                <b style="font-size: 18px;">{{$invoice->warehouse->warehouse_name ?? ''}}</b><br>
                                {{$invoice->warehouse->address ?? ''}}<br>
                                {{-- The {{$invoice->warehouse->warehouse_code ?? ''}}<br> --}}
                                {{$invoice->warehouse->country ?? ''}}<br>
                                Tel-{{$invoice->warehouse->phone ?? ''}}<br>
                                {{-- Tel 718-954-9093<br> --}}
                            @endif
                        </td>

                        <td style="width: 40%; text-align: end; font-size: 16px; vertical-align: top;">
                            @if($invoice->invoiceParcelData && $invoice->invoiceParcelData->arrivedWarehouse)
                            <b style="font-size: 18px;">{{$invoice->invoiceParcelData->arrivedWarehouse->warehouse_name
                                ?? ''}}</b><br>
                                {{$invoice->invoiceParcelData->arrivedWarehouse->address
                                ?? ''}},<br>
                            {{-- The {{$invoice->invoiceParcelData->arrivedWarehouse->warehouse_code ?? ''}}<br> --}}
                            Tel-{{$invoice->invoiceParcelData->arrivedWarehouse->phone ?? ''}}<br>
                            {{-- Tel 718-954-9093<br> --}}
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding: 0 20px 20px 20px;">
                <table width="100%">
                    <tr>
                        <td style="width: 35%;">
                            <table width="100%">
                                <tr>
                                    <td>
                                        <b style="font-size: 18px;">Customer</b><br>
                                        @if(isset($invoice->pickupAddress))
                                            {{$invoice->pickupAddress->full_name ?? ''}}<br>
                                            {{$invoice->pickupAddress->address ?? ''}}<br>
                                            {{-- {{$invoice->pickupAddress->state_id ?? ''}}, {{$invoice->pickupAddress->country_id ?? ''}}<br> --}}
                                            {{$invoice->pickupAddress->mobile_number ?? ''}}<br>
                                            {{$invoice->pickupAddress->alternative_mobile_number ?? ''}}
                                        @elseif(isset($invoice->deliveryAddress))
                                        {{$invoice->deliveryAddress->full_name ?? ''}}<br>
                                        {{$invoice->deliveryAddress->address ?? ''}}<br>
                                        {{-- {{$invoice->deliveryAddress->state_id ?? ''}}, {{$invoice->deliveryAddress->country_id ?? ''}}<br> --}}
                                        @if($invoice->deliveryAddress->mobile_number)
                                        {{$invoice->deliveryAddress->mobile_number ?? ''}}<br>
                                        @endif
                                        {{$invoice->deliveryAddress->alternative_mobile_number ?? ''}}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 30%; text-align: center;">
                        </td>
                        <td style="width: 35%;">

                            @if(isset($invoice->deliveryAddress))
                                <b style="font-size: 18px;">Ship To:</b><br>
                                {{$invoice->deliveryAddress->full_name ?? ''}}<br>
                                {{$invoice->deliveryAddress->address ?? ''}}<br>
                                @if($invoice->deliveryAddress->neighborhood)
                                    {{$invoice->deliveryAddress->neighborhood ?? ''}}<br>
                                @endif

                                {{-- {{$invoice->deliveryAddress->state_id ?? ''}}, {{$invoice->deliveryAddress->country_id ?? ''}}<br> --}}
                                {{$invoice->deliveryAddress->mobile_number ?? ''}}<br>
                                {{$invoice->deliveryAddress->alternative_mobile_number ?? ''}}
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        {{-- <tr>
            <td colspan="2" style="padding: 10px 20px; border-top: 3px solid #EFEFEF;">
                <table width="100%">
                    <tr>
                        <td style="width: 40%; color: #3a3a3a;">Date & Time Printed:
                            <b style="color: #000000;">
                                {{ $invoice->created_at ? $invoice->created_at->format('M.d.Y') . ' ---' : '' }}
                                <br>
                                {{ $invoice->created_at ? $invoice->created_at->format('H:i:s') : '' }}
                            </b>
                        </td>
                        <td style="width: 40%; color: #3a3a3a; font-size: 20px; text-align: center;">Inv
                            No.: <b style="color: #000000;">{{$invoice->invoice_no ?? ''}}</b></td>
                        <td style="width: 20%; color: #3a3a3a; font-size: 20px;">Cont: <b
                                style="color: #000000;">{{$invoice->container && $invoice->container->unique_id ? $invoice->container->unique_id:'' }}</b></td>
                    </tr>
                </table>
            </td>
        </tr> --}}
        <tr>
            <td colspan="2">
                <table
                    style="width: 100%; border-collapse: collapse; border: 1px solid black; border-bottom: none;">
                    <tr style="background-color: #f2f2f2; border: 1px solid black; ">
                        <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                            Tracking# : <b>{{$invoice->invoiceParcelData && !empty($invoice->invoiceParcelData->tracking_number) ? $invoice->invoiceParcelData->tracking_number:''}}</b>
                        </td>
                        <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                            ivnoce# : <b>{{$invoice->invoice_no ?? ''}}</b>
                        </td>
                        <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                            container# : <b>{{$invoice->container && $invoice->container->unique_id ? $invoice->container->unique_id:'' }}</b>
                        </td>
                        <td style="border: 1px solid black; padding: 10px 20px;text-align: start;">
                            country#: <b>{{ $invoice->deliveryAddress && $invoice->deliveryAddress->country_id ? $invoice->deliveryAddress->country_id : '' }}</b>
                        </td>
                    </tr>
                    {{-- <tr>
                        <td style="width: 50%; padding: 10px 20px;">
                            <span style="font-size: 17px;">
                                Invoice Date: <b>{{$invoice->created_at->format('d/m/Y') ?? ''}}</b><br>
                                Pay Terms: <b>United States</b><br>
                                Ship Via: <b>{{$invoice->created_at ?? ''}}</b>
                            </span>
                        </td>
                        <td style="width: 50%; padding: 10px 20px;" colspan="2">
                            <span style="font-size: 17px;">
                                Driver: <b>{{ $invoice->driver->name ?? '' }} {{ $invoice->driver->last_name ?? '' }}</b><br>
                                Branch: <b>{{ $invoice->createdByUser && $invoice->createdByUser->warehouse ? $invoice->createdByUser->warehouse->name : '' }}</b><br>
                                User: <b>{{ $invoice->createdByUser->name ?? '' }} {{ $invoice->createdByUser->last_name ?? '' }}</b>
                            </span>
                        </td>
                    </tr> --}}
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">

                    <tr style="background-color: #203A5F; color:white; border: 1px solid black;">
                        <th style="border: 1px solid black; font-weight: 500; padding: 5px;">#
                        </th>
                        <th style="border: 1px solid black; font-weight: 500; padding: 5px;">Item</th>
                        <th style="border: 1px solid black; font-weight: 500; padding: 5px;">Qty.</th>
                        {{-- <th style="border: 1px solid black; font-weight: 500; padding: 5px;">Unit</th> --}}
                        <th style="border: 1px solid black; font-weight: 500; padding: 5px; width: 100px;">
                            Description
                        </th>
                        <th style="border: 1px solid black; font-weight: 500; padding: 5px;">Value</th>
                        <th style="border: 1px solid black; font-weight: 500; padding: 5px;">Price</th>
                        {{-- <th style="border: 1px solid black; font-weight: 500; padding: 5px;">Disc.</th> --}}
                        <th style="border: 1px solid black; font-weight: 500; padding: 5px;">Insurance</th>
                        <th style="border: 1px solid black; font-weight: 500; padding: 5px;">Tax%</th>
                        <th style="border: 1px solid black; font-weight: 500; padding: 10px;">Total</th>
                    </tr>
                    @forelse (($invoice->invoiceParcelData->parcelInventory??[]) as $key=>$item)
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black; padding: 5px; text-align: center;">{{$key+1}}</td>
                        <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['supply_name'] ?? '-' }}</td>
                        <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['qty'] ?? 0 }}</td>
                        {{-- <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['label_qty'] ?? 0 }}</td> --}}
                        <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['label_qty'] ?? '' }}</td>
                        <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['value'] ?? 0 }}</td>
                        <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['price'] ?? 0 }}</td>
                        {{-- <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['discount'] ?? 0 }}</td> --}}
                        <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['ins'] ?? 0 }}</td>
                        <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['tax'] ?? 0 }}</td>
                        <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $item['total'] ?? 0 }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">No Items Found</td>
                    </tr>
                    @endforelse
                    <tr>
                        <td colspan="9" style="padding: 10px 20px;">
                            <strong>Notes:</strong><br>
                            @if ($invoice->comments && count($invoice->comments) > 0)
                                @foreach ($invoice->comments->where('type','notes')->values() as $comment)
                                    <p style="margin: 0;">{{ $comment->notes ?? '' }} - {{ $comment->created_at ? $comment->created_at->format('m/d/Y, h:i a') : '' }}</p>
                                @endforeach

                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <!-- Subtotal and Balance Section -->
                <table
                    style="width: 100%; border-collapse: collapse; border: 1px solid black;border-top:unset;">
                    <tr style="background-color: #f2f2f2; border: 1px solid black; border-top:unset;;">
                        <td style="text-align: start; padding: 5px 20px; width: 20%;">Subtotal</td>
                        <td style="text-align: center; padding: 5px; width: 20%;">Discount</td>
                        <td style="text-align: center; padding: 5px; width: 20%;">Insurance</td>
                        <td style="text-align: center; padding: 5px; width: 20%;">Tax</td>
                        <td style="text-align: center; padding: 5px; width: 20%;">Items</td>
                        <td style="text-align: center; padding: 5px; width: 20%;">Amount</td>
                        <td style="text-align: center; padding: 5px; width: 20%;">Payments</td>
                        <td style="text-align: center; padding: 5px 20px; width: 20%;">
                            <strong>Balance</strong></td>
                    </tr>
                    <tr style="border: 1px solid black;">
                        <td style=" text-align: start; padding: 5px 20px;">${{$invoice->grand_total ?? 0}}</td>
                        <td style=" text-align: center; padding: 5px;">${{$invoice->discount ?? 0}}</td>
                        <td style=" text-align: center; padding: 5px;">${{$invoice->ins ?? 0}}</td>
                        <td style=" text-align: center; padding: 5px;">${{$invoice->tax ?? 0}}0</td>
                        <td style=" text-align: center; padding: 5px;">{{ isset($invoice->total_qty) ? (int)$invoice->total_qty : 0 }}</td>
                        <td style=" text-align: center; padding: 5px;">${{$invoice->grand_total ?? 0}}</td>
                        <td style=" text-align: center; padding: 5px;">${{$invoice->payment ?? 0}}</td>
                        <td style=" text-align: center; padding: 5px 20px;"><strong>${{$invoice->balance ?? 0}}</strong></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table
                    style="width: 100%; border-collapse: collapse; margin-bottom: 20px;  border: 1px solid black; border-top:unset;">
                    <tr>
                        <td style="padding: 5px 20px;">
                            <div style="font-family: Arial, sans-serif; font-size: 12px; color: #000;">

                            <h4 style="margin-bottom: 4px;">Shipper's Declaration and Agreement</h4>
                            <ul style="margin-top: 0; padding-left: 20px;">
                                <li>I, the shipper, declare that the package contents are lawful and comply with all applicable regulations.</li>
                                <li>I confirm that the package does not contain:
                                    <ul style="list-style: none">
                                        <li>- Money</li>
                                        <li>- Firearms</li>
                                        <li>- Explosives</li>
                                        <li>- Chemicals</li>
                                        <li>- Any items prohibited by law</li>
                                    </ul>
                                </li>
                                <li>I understand that I am responsible for any legal charges or lawsuits resulting from shipping prohibited or illegal items.</li>
                                <li>I declare the contents and value of the package accurately.</li>
                            </ul>

                            <h4 style="margin-top: 16px; margin-bottom: 4px;">Liability and Responsibility</h4>
                            <ul style="margin-top: 0; padding-left: 20px;">
                                <li>Loss or damage: 20% of declared value without insurance, full coverage with insurance.</li>
                                <li>Shipper responsible for legal issues arising from prohibited items.</li>
                            </ul>

                            <h4 style="margin-top: 16px; margin-bottom: 4px;">Delivery and Storage</h4>
                            <ul style="margin-top: 0; padding-left: 20px;">
                                <li>Packages are not returnable from the final destination.</li>
                                <li>Recipient must collect package within 3 days of arrival; storage fees apply thereafter based on package dimensions.</li>
                                <li>Packages not picked up within 30 days of arrival: considered abandoned.</li>
                            </ul>

                            <h4 style="margin-top: 16px; margin-bottom: 4px;">Payment Terms</h4>
                            <ul style="margin-top: 0; padding-left: 20px;">
                                <li>Online payment must be made immediately upon package pickup.</li>
                                <li>For credit card payments, packages will be held for 15 days pending payment clearance.</li>
                                <li>Additional storage fees will apply for packages not picked up within 15 days of payment clearance.</li>
                            </ul>

                            <h4 style="margin-top: 16px; margin-bottom: 4px;">Additional Terms</h4>
                            <ul style="margin-top: 0; padding-left: 20px;">
                                <li>Customs clearance and duties/fees are recipient's responsibility.</li>
                                <li>Shipping rates may vary based on package dimensions, weight, and destination.</li>
                            </ul>

                        </div>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 40%; padding: 0px 20px;">
                            <span>I have Received the Contract and Accept the Terms and
                                Condition.</span><br>
                            <span style="font-size: 18px; font-weight: 600; line-height: 40px;">Authorized
                                Sign</span><br>
                            <img src="{{$invoice->warehouse && $invoice->warehouse->signature ? public_path(removePart($invoice->warehouse->signature->signature_file, url('/'), true, 1)):'public/uploads/signature/download%20(2).png'}}" alt="Signature"
                                style="max-width: 100px;">
                        </td>
                        <td style="width: 20%; "> </td>
                        <td
                            style="width: 40%; text-align: end; font-size: 16px; vertical-align: top; padding: 0px 20px;">
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
            <td colspan="2" style="padding: 10px 20px 0px 20px;">
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
</body>

</html>
