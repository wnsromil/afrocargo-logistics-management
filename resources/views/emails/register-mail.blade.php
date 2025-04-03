<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
    <link href="http://fonts.cdnfonts.com/css/gotham-rounded" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Email Notification - Afrocargo</title>
    <style>
        td,
        span,
        a {
            font-family: 'Gotham Rounded', sans-serif;
        }
    </style>
</head>

<body style="background: white; padding: 0; margin: 0;" bgcolor="white">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="text-align: center; padding: 0; margin: 0; width: 600px;" bgcolor="white" align="center">
                    <div align="center">
                        <table width="630" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td>
                                        <table width="630" border="0" cellspacing="0" cellpadding="0">
                                            <tr style="background-color:#e79b10;">
                                                <td colspan="2" align="left">
                                                    <table width="630" border="0" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="middle" align="center" style="background:#780001;">
                                                                    <table border="0" cellspacing="30" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <a href="{{ url('/') }}" target="_blank">
                                                                                        <img src="{{ asset('media/logo.png') }}" alt="Afrocargo Logo" style="display: block; width: 200px;" width="200px" border="0">
                                                                                    </a>
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
                                            <tr>
                                                <td colspan="2" bgcolor="white" align="center">
                                                    <table width="630" border="0" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td width="630" valign="middle" bgcolor="white" align="center">
                                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 24px; color: black; padding-top: 30px;" valign="middle" align="center">
                                                                                    <span style="font-size: 18px;">Dear {{ $userName }}</span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 24px; color: black; padding-top: 30px;" valign="middle" align="center">
                                                                                    <span style="font-size: 18px;">Welcome to Afrocargo!</span>
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
                                            <tr>
                                                <td colspan="2" bgcolor="#FFFFFF" align="center">
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" align="center">
                                                                    Welcome to Afrocargo, Please login with the credentials below -
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 8px" valign="top" align="center">
                                                                    <b>Email/Mobile Number:</b> {{ $email }} / {{ $mobileNumber }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 8px" valign="top" align="center">
                                                                    <b>Password:</b> {{ $password }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 20px;" colspan="2" bgcolor="#FFFFFF" align="center">
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" align="center">
                                                                    <table border="0" cellspacing="0" cellpadding ="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 16px; font-weight: bold; color: white; background-color: #780001; padding: 5px 10px; border-radius: 5px; text-align: center;">
                                                                                    <a target="_blank" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px!important; text-decoration: none; color: white;" href="{{ $loginUrl }}">Click here to login</a>
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
                                            <tr>
                                                <td colspan="2" bgcolor="#FFFFFF" align="center">
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" align="center">
                                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 18px; color: black; padding-right: 24px; padding-bottom: 20px; padding-left: 24px; max-width:320px; text-align:center;">
                                                                                    <span style="color: gray;">©2023 Afrocargo. All Rights Reserved.</span>
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
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>