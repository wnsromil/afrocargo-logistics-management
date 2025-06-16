@extends('emails.layout.mail_layout')
@section('content')
<table width="630" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td style="padding-top:20px;" valign="top" align="center">
            <p style="margin: 5px 0px; font-size:16px; font-weight:bold;">
                Your invoice is ready!
            </p>
            <p style="margin: 5px 0px;">
                Please find your invoice attached below. You can download it using the link provided.
            </p>
            <p style="margin: 5px 0px;">
                If you have any questions, feel free to contact us.
            </p>
        </td>
    </tr>

    <tr>
        <td colspan="2" bgcolor="#FFFFFF" align="center">
            <table border="0" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td valign="top" align="center">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td
                                            style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 18px; color: black; padding-right: 24px; padding-top:20px; padding-bottom: 20px; padding-left: 24px; max-width:320px; text-align:center;">
                                            <a href="{{ route('invoices.invoicesdownload', encrypt($invoice->id)) }}" style="color: #007bff; text-decoration: underline;">
                                                Download Invoice
                                            </a>
                                            <br>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</table>

@endsection