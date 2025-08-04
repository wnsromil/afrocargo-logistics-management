<!DOCTYPE html>
<html>
<title>{{ config('app.name', 'Afro Cargo') }}</title>
<link rel="icon" href="{{ public_path('assets/images/logo_image.png') }}" type="image/svg+xml">

<head>
    <title>EOD REPORT LIST - INVOICE</title>
</head>

<body>
    <table width="100%" style="border-collapse: collapse;">
        <tr>
            <!-- Column 1: Logo -->
            <td style="width: 33.33%; text-align: left;">
                <img src="{{public_path('assets/images/logo_image.png')}}" alt="Logo" style="height: 50px;">
            </td>

            <!-- Column 2: Centered Heading -->
            <td style="width: 33.33%; text-align: center; font-family: 'Poppins', sans-serif;">
                <h2 style="margin: 0; color: #000;">EOD REPORT LIST - INVOICE</h2>
            </td>

            <!-- Column 3: Empty -->
            <td style="width: 33.33%; text-align: right;">
                &nbsp;
            </td>
        </tr>
    </table>

    <p style="margin-top: 20px; margin-bottom: 20px; border: 1px solid gray; padding: 10px; line-height: 1.8;">
        <strong style="color: green;">Total Invoiced: ${{ number_format($summary['totalInvoiced'], 2) }}</strong>
        &nbsp;&nbsp;
        <strong style="color: green;">Total Payments: ${{ number_format($summary['totalPayment'], 2) }}</strong>
        &nbsp;&nbsp;
        <strong style="color: red;">Total Balance: ${{ number_format($summary['totalBalance'], 2) }}</strong>
        &nbsp;&nbsp;
        <strong>Total Service: ${{ number_format($summary['totalService'], 2) }}</strong> &nbsp;&nbsp;
        <strong>Total Supplies: ${{ number_format($summary['totalSupplies'], 2) }}</strong> &nbsp;&nbsp;
        <strong>Cash: ${{ number_format($summary['totalCash'], 2) }}</strong> &nbsp;&nbsp;
        <strong>Credit: ${{ number_format($summary['totalCreditCard'], 2) }}</strong> &nbsp;&nbsp;
        <strong>Cheque: ${{ number_format($summary['totalCheque'], 2) }}</strong> &nbsp;&nbsp;
        <strong>Discounts: ${{ number_format($summary['totalDiscount'], 2) }}</strong> &nbsp;&nbsp;
        <strong>Deposits: ${{ number_format($summary['totalDeposits'], 2) }}</strong>
    </p>

    <p style="margin-top: 10px; border: 1px solid gray; padding: 10px; line-height: 1.8;">
        <strong>Total Cash: ${{ number_format($summary['totalCash'], 2) }}</strong> &nbsp;&nbsp;
        <strong>Total Expenses: ${{ number_format($summary['totalExpenses'], 2) }}</strong>&nbsp;&nbsp;
        <strong>Total Local Currency Cash: $0</strong> &nbsp;&nbsp;
        <strong>Total Local Currency Expenses: $0</strong>
    </p>


    <h4 style="text-align: center; font-weight: bold; margin-bottom: 10px;">INVOICE LIST</h4>
    <table border="1" cellspacing="0" cellpadding="5" width="100%"
        style="border-collapse: collapse; text-align: center; font-size: 13px;">
        <tr style="background-color: #203A5F; color:white; ">
            <th style="border: 1px solid #000;">User</th>
            <th style="border: 1px solid #000;">Driver</th>
            <th style="border: 1px solid #000;">TT</th>
            <th style="border: 1px solid #000;">Inv. No</th>
            <th style="border: 1px solid #000;">Inv. Date</th>
            <th style="border: 1px solid #000;">Inv. Amt</th>
            <th style="border: 1px solid #000;">Payment</th>
            <th style="border: 1px solid #000;">Balance</th>
        </tr>

        @forelse ($invoices as $key => $invoice)
            <tr>
                <td style="border: 1px solid #000">{{ $invoice->customer->name ?? '' }}
                    {{ $invoice->customer->last_name ?? '' }}
                </td>
                <td style="border: 1px solid #000">{{ $invoice->driver->name ?? '' }}
                    {{ $invoice->driver->last_name ?? '' }}
                </td>
                <td style="border: 1px solid #000">
                    @if ($invoice->invoce_type === 'services')
                        Service
                    @elseif ($invoice->invoce_type === 'supplies')
                        Supply
                    @else
                        --
                    @endif
                </td>
                <td style="border: 1px solid #000">{{ $invoice->invoice_no ?? '--' }}</td>
                <td style="border: 1px solid #000">{{ \Carbon\Carbon::parse($invoice->created_at)->format('m-d-Y') }}</td>
                <td style="border: 1px solid #000">${{ number_format($invoice->grand_total, 2) }}</td>
                <td style="border: 1px solid #000">${{ number_format($invoice->payment, 2) }}</td>
                <td style="border: 1px solid #000">${{ number_format($invoice->balance, 2) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="11" class="px-4 py-4 text-center text-gray-500">No Data found.
                </td>
            </tr>
        @endforelse
    </table>

    <h4 style="text-align: center; font-weight: bold; margin-bottom: 10px;">SUPPLY INVOICE LIST</h4>
    <table border="1" cellspacing="0" cellpadding="5" width="100%"
        style="border-collapse: collapse; text-align: center; font-size: 13px;">
        <tr style="background-color: #203A5F; color:white; ">
            <th style="border: 1px solid #000;">User</th>
            <th style="border: 1px solid #000;">Driver</th>
            <th style="border: 1px solid #000;">TT</th>
            <th style="border: 1px solid #000;">Inv. No</th>
            <th style="border: 1px solid #000;">Inv. Date</th>
            <th style="border: 1px solid #000;">Inv. Amt</th>
            <th style="border: 1px solid #000;">Payment</th>
            <th style="border: 1px solid #000;">Balance</th>
        </tr>

        @forelse ($supplies as $key => $supplie)
            <tr>
                <td style="border: 1px solid #000">{{ $supplie->customer->name ?? '' }}
                    {{ $supplie->customer->last_name ?? '' }}
                </td>
                <td style="border: 1px solid #000">{{ $supplie->driver->name ?? '' }}
                    {{ $supplie->driver->last_name ?? '' }}
                </td>
                <td style="border: 1px solid #000">
                    @if ($supplie->invoce_type === 'services')
                        Service
                    @elseif ($supplie->invoce_type === 'supplies')
                        Supply
                    @else
                        --
                    @endif
                </td>
                <td style="border: 1px solid #000">{{ $supplie->invoice_no ?? '--' }}</td>
                <td style="border: 1px solid #000">{{ \Carbon\Carbon::parse($supplie->created_at)->format('m-d-Y') }}</td>
                <td style="border: 1px solid #000">${{ number_format($supplie->grand_total, 2) }}</td>
                <td style="border: 1px solid #000">${{ number_format($supplie->payment, 2) }}</td>
                <td style="border: 1px solid #000">${{ number_format($supplie->balance, 2) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="11" class="px-4 py-4 text-center text-gray-500">No Data found.
                </td>
            </tr>
        @endforelse
    </table>


    <h4 style="text-align: center; font-weight: bold; margin-bottom: 10px;">CASH PAYMENT LIST</h4>
    <table border="1" cellspacing="0" cellpadding="5" width="100%"
        style="border-collapse: collapse; text-align: center; font-size: 13px;">
        <tr style="background-color: #203A5F; color:white;">
            <th style="border: 1px solid #000;">Customer</th>
            <th style="border: 1px solid #000;">Driver</th>
            <th style="border: 1px solid #000;">Warehouse</th>
            <th style="border: 1px solid #000;">Rec.No</th>
            <th style="border: 1px solid #000;">P.Date</th>
            <th style="border: 1px solid #000;">Inv.No</th>
            <th style="border: 1px solid #000;">Inv.Amout</th>
            <th style="border: 1px solid #000;">Inv.Date</th>
            <th style="border: 1px solid #000;">Amt.In Doller</th>
            <th style="border: 1px solid #000;">Local Currency</th>
            <th style="border: 1px solid #000;">Currency</th>
            <th style="border: 1px solid #000;">P.Type</th>
            <th style="border: 1px solid #000;">Balance</th>
        </tr>

        @forelse ($cashpayments as $key => $cashpayment)
            <tr>
                <td style="border: 1px solid #000">{{ $cashpayment->invoice->customer->name ?? '' }}
                    {{ $cashpayment->invoice->customer->last_name ?? '' }}
                </td>
                <td style="border: 1px solid #000">{{ $cashpayment->invoice->driver->name ?? '' }}
                    {{ $cashpayment->invoice->driver->last_name ?? '' }}
                </td>
                <td style="border: 1px solid #000">{{ $cashpayment->warehouse->warehouse_name ?? '--' }}</td>
                <td style="border: 1px solid #000">{{ $cashpayment->unique_id ?? '--' }}</td>
                <td style="border: 1px solid #000">
                    {{ \Carbon\Carbon::parse(time: $cashpayment->payment_date)->format('m-d-Y') }}
                </td>
                <td style="border: 1px solid #000">{{ $cashpayment->invoice->invoice_no ?? '--' }}</td>
                <td style="border: 1px solid #000">
                    ${{ isset($cashpayment->invoice->grand_total) ? number_format($cashpayment->invoice->grand_total, 2) : '--' }}
                </td>
                <td style="border: 1px solid #000">
                    {{ \Carbon\Carbon::parse($cashpayment->invoice->issue_date)->format('m-d-Y') }}
                </td>
                <td style="border: 1px solid #000">
                    ${{ isset($cashpayment->payment_amount) ? number_format($cashpayment->payment_amount, 2) : '--' }}</td>
                <td style="border: 1px solid #000">{{$cashpayment->local_currency ?? "--" }}</td>
                <td style="border: 1px solid #000">{{ $cashpayment->currency ?? '--' }}</td>
                <td style="border: 1px solid #000">{{ $cashpayment->payment_type ?? '--' }}</td>
                <td style="border: 1px solid #000">
                    ${{ isset($cashpayment->total_balance) ? number_format($cashpayment->total_balance, 2) : '--' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="11" class="px-4 py-4 text-center text-gray-500">No Data found.
                </td>
            </tr>
        @endforelse
    </table>

    <h4 style="text-align: center; font-weight: bold; margin-bottom: 10px;">CHEQUE PAYMENT LIST</h4>
    <table border="1" cellspacing="0" cellpadding="5" width="100%"
        style="border-collapse: collapse; text-align: center; font-size: 13px;">
        <tr style="background-color: #203A5F; color:white;">
            <th style="border: 1px solid #000;">Customer</th>
            <th style="border: 1px solid #000;">Driver</th>
            <th style="border: 1px solid #000;">Warehouse</th>
            <th style="border: 1px solid #000;">Rec.No</th>
            <th style="border: 1px solid #000;">P.Date</th>
            <th style="border: 1px solid #000;">Inv.No</th>
            <th style="border: 1px solid #000;">Inv.Amout</th>
            <th style="border: 1px solid #000;">Inv.Date</th>
            <th style="border: 1px solid #000;">Amt.In Doller</th>
            <th style="border: 1px solid #000;">Local Currency</th>
            <th style="border: 1px solid #000;">Currency</th>
            <th style="border: 1px solid #000;">P.Type</th>
            <th style="border: 1px solid #000;">Balance</th>
        </tr>

        @forelse ($chequepayments as $key => $chequepayment)
            <tr>
                <td style="border: 1px solid #000">{{ $chequepayment->invoice->customer->name ?? '' }}
                    {{ $chequepayment->invoice->customer->last_name ?? '' }}
                </td>
                <td style="border: 1px solid #000">{{ $chequepayment->invoice->driver->name ?? '' }}
                    {{ $chequepayment->invoice->driver->last_name ?? '' }}
                </td>
                <td style="border: 1px solid #000">{{ $chequepayment->warehouse->warehouse_name ?? '--' }}</td>
                <td style="border: 1px solid #000">{{ $chequepayment->unique_id ?? '--' }}</td>
                <td style="border: 1px solid #000">
                    {{ \Carbon\Carbon::parse(time: $chequepayment->payment_date)->format('m-d-Y') }}
                </td>
                <td style="border: 1px solid #000">{{ $chequepayment->invoice->invoice_no ?? '--' }}</td>
                <td style="border: 1px solid #000">
                    ${{ isset($chequepayment->invoice->grand_total) ? number_format($chequepayment->invoice->grand_total, 2) : '--' }}
                </td>
                <td style="border: 1px solid #000">
                    {{ \Carbon\Carbon::parse($chequepayment->invoice->issue_date)->format('m-d-Y') }}
                </td>
                <td style="border: 1px solid #000">
                    ${{ isset($chequepayment->payment_amount) ? number_format($chequepayment->payment_amount, 2) : '--' }}
                </td>
                <td style="border: 1px solid #000">{{$chequepayment->local_currency ?? "--" }}</td>
                <td style="border: 1px solid #000">{{ $chequepayment->currency ?? '--' }}</td>
                <td style="border: 1px solid #000">{{ $chequepayment->payment_type ?? '--' }}</td>
                <td style="border: 1px solid #000">
                    ${{ isset($chequepayment->total_balance) ? number_format($chequepayment->total_balance, 2) : '--' }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="11" class="px-4 py-4 text-center text-gray-500">No Data found.
                </td>
            </tr>
        @endforelse
    </table>

    <h4 style="text-align: center; font-weight: bold; margin-bottom: 10px;">CREDIT CARD PAYMENT LIST</h4>
    <table border="1" cellspacing="0" cellpadding="5" width="100%"
        style="border-collapse: collapse; text-align: center; font-size: 13px;">
        <tr style="background-color: #203A5F; color:white;">
            <th style="border: 1px solid #000;">Customer</th>
            <th style="border: 1px solid #000;">Driver</th>
            <th style="border: 1px solid #000;">Warehouse</th>
            <th style="border: 1px solid #000;">Rec.No</th>
            <th style="border: 1px solid #000;">P.Date</th>
            <th style="border: 1px solid #000;">Inv.No</th>
            <th style="border: 1px solid #000;">Inv.Amout</th>
            <th style="border: 1px solid #000;">Inv.Date</th>
            <th style="border: 1px solid #000;">Amt.In Doller</th>
            <th style="border: 1px solid #000;">Local Currency</th>
            <th style="border: 1px solid #000;">Currency</th>
            <th style="border: 1px solid #000;">P.Type</th>
            <th style="border: 1px solid #000;">Balance</th>
        </tr>

        @forelse ($CreditCardpayments as $key => $CreditCardpayment)
            <tr>
                <td style="border: 1px solid #000">{{ $CreditCardpayment->invoice->customer->name ?? '' }}
                    {{ $CreditCardpayment->invoice->customer->last_name ?? '' }}
                </td>
                <td style="border: 1px solid #000">{{ $CreditCardpayment->invoice->driver->name ?? '' }}
                    {{ $CreditCardpayment->invoice->driver->last_name ?? '' }}
                </td>
                <td style="border: 1px solid #000">{{ $CreditCardpayment->warehouse->warehouse_name ?? '--' }}</td>
                <td style="border: 1px solid #000">{{ $CreditCardpayment->unique_id ?? '--' }}</td>
                <td style="border: 1px solid #000">
                    {{ \Carbon\Carbon::parse(time: $CreditCardpayment->payment_date)->format('m-d-Y') }}
                </td>
                <td style="border: 1px solid #000">{{ $CreditCardpayment->invoice->invoice_no ?? '--' }}</td>
                <td style="border: 1px solid #000">
                    ${{ isset($CreditCardpayment->invoice->grand_total) ? number_format($CreditCardpayment->invoice->grand_total, 2) : '--' }}
                </td>
                <td style="border: 1px solid #000">
                    {{ \Carbon\Carbon::parse($CreditCardpayment->invoice->issue_date)->format('m-d-Y') }}
                </td>
                <td style="border: 1px solid #000">
                    ${{ isset($CreditCardpayment->payment_amount) ? number_format($CreditCardpayment->payment_amount, 2) : '--' }}
                </td>
                <td style="border: 1px solid #000">{{$CreditCardpayment->local_currency ?? "--" }}</td>
                <td style="border: 1px solid #000">{{ $CreditCardpayment->currency ?? '--' }}</td>
                <td style="border: 1px solid #000">{{ $CreditCardpayment->payment_type ?? '--' }}</td>
                <td style="border: 1px solid #000">
                    ${{ isset($CreditCardpayment->total_balance) ? number_format($CreditCardpayment->total_balance, 2) : '--' }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="11" class="px-4 py-4 text-center text-gray-500">No Data found.
                </td>
            </tr>
        @endforelse
    </table>

    <h4 style="text-align: center; font-weight: bold; margin-bottom: 10px;">EXPENSE LIST</h4>
    <table border="1" cellspacing="0" cellpadding="5" width="100%"
        style="border-collapse: collapse; text-align: center; font-size: 13px;">
        <tr style="background-color: #203A5F; color:white;">
            <th style="border: 1px solid #000;">Expense ID</th>
            <th style="border: 1px solid #000;">User</th>
            <th style="border: 1px solid #000;">Warehouse Name</th>
            <th style="border: 1px solid #000;">Date</th>
            <th style="border: 1px solid #000;">Category</th>
            <th style="border: 1px solid #000;">Amount</th>
            <th style="border: 1px solid #000;">Image</th>
        </tr>
        @forelse ($expenses as $key => $expense)
            <tr>
                <td style="border: 1px solid #000">{{ $expense->unique_id ?? '--' }}</td>
                <td style="border: 1px solid #000">{{ $expense->creatorUser->name ?? '--' }}</td>
                <td style="border: 1px solid #000">{{ $expense->warehouse->warehouse_name ?? '--' }}</td>
                <td style="border: 1px solid #000">{{ \Carbon\Carbon::parse($expense->date)->format('m-d-Y') }}</td>
                <td style="border: 1px solid #000">{{ $expense->category ?? '--' }}</td>
                <td style="border: 1px solid #000">${{ number_format($expense->amount, 2) ?? '--' }}</td>
                <td style="border: 1px solid #000">
                    @if ($expense->img)
                        <img src="{{ public_path($expense->img) }}" alt="E Img" style="max-width: 30px;">
                    @else
                        <img src="{{ public_path('assets/img.png') }}" alt="D Img" style="max-width: 30px;">
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="11" class="px-4 py-4 text-center text-gray-500">No Data found.
                </td>
            </tr>
        @endforelse
    </table>

    <h4 style="text-align: center; font-weight: bold; margin-bottom: 10px;">UNUSED DEPOSIT LIST</h4>
    <table border="1" cellspacing="0" cellpadding="5" width="100%"
        style="border-collapse: collapse; text-align: center; font-size: 13px;">
        <tr style="background-color: #203A5F; color:white;">
            <th style="border: 1px solid #000;">Expense ID</th>
            <th style="border: 1px solid #000;">User</th>
            <th style="border: 1px solid #000;">Warehouse Name</th>
            <th style="border: 1px solid #000;">Date</th>
            <th style="border: 1px solid #000;">Category</th>
            <th style="border: 1px solid #000;">Amount</th>
            <th style="border: 1px solid #000;">Image</th>
        </tr>
        @forelse ($deposits as $key => $deposit)
            <tr>
                <td style="border: 1px solid #000">{{ $deposit->unique_id ?? '--' }}</td>
                <td style="border: 1px solid #000">{{ $deposit->creatorUser->name ?? '--' }}</td>
                <td style="border: 1px solid #000">{{ $deposit->warehouse->warehouse_name ?? '--' }}</td>
                <td style="border: 1px solid #000">{{ \Carbon\Carbon::parse($deposit->date)->format('m-d-Y') }}</td>
                <td style="border: 1px solid #000">{{ $deposit->category ?? '--' }}</td>
                <td style="border: 1px solid #000">${{ number_format($deposit->amount, 2) ?? '--' }}</td>
                <td style="border: 1px solid #000">
                    @if ($deposit->img)
                        <img src="{{ public_path($deposit->img) }}" alt="E Img" style="max-width: 30px;">
                    @else
                        <img src="{{ public_path('assets/img.png') }}" alt="D Img" style="max-width: 30px;">
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="11" class="px-4 py-4 text-center text-gray-500">No Data found.
                </td>
            </tr>
        @endforelse
    </table>

    <table style="width: 100%; margin-top: 30px;">
        <tr>
            <td style="width: 33%;"><strong>Date:</strong> <span
                    style="display: inline-block; border-bottom: 1px solid #000; width: 60%;"></span></td>
            <td style="width: 33%; text-align: center;"><strong>Office:</strong> <span
                    style="display: inline-block; border-bottom: 1px solid #000; width: 60%;"></span></td>
            <td style="width: 33%; text-align: right;"><strong>Driver:</strong> <span
                    style="display: inline-block; border-bottom: 1px solid #000; width: 60%;"></span></td>
        </tr>
    </table>

</body>

</html>