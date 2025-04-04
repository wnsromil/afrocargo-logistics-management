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
                                                                <td valign="middle" align="center"
                                                                    style="background:#ffffff;">
                                                                    <table border="0" cellspacing="30" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <a href="{{ url('/') }}"
                                                                                        target="_blank">
                                                                                      <img src='{{asset('assets/images/AfroCargoLogo.svg')}}'
                                                                                            alt="Afrocargo Logo"
                                                                                            style="display: block; width: 100px; height: 100px;"
                                                                                            width="200px" border="0">
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
                                                                <td width="630" valign="middle" bgcolor="white"
                                                                    align="center">
                                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 24px; padding:5px 0px; color: black;"
                                                                                    valign="middle" align="center">
                                                                                    <span style="font-size: 18px;">Dear Customer,</span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 24px; color: black; padding-bottom:30px;"
                                                                                    valign="middle" align="center">
                                                                                    <span
                                                                                        style="font-size: 18px;">Welcome to Afrocargo!
                                                                                        <p style="margin:0px">We’re excited to have you on board.</p>
                                                                                    </span>
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
                                                                    You can log in using the details below:
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 8px" valign="top"
                                                                    align="center">
                                                                    <p style="margin:3px"><b>Email/Mobile Number: </b>{{$email}} / {{$mobileNumber}}</p>
                                                                    <p style="margin:3px"><b>Password: </b>
                                                                        {{$password}}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:15px 0px;" valign="top" align="center">
                                                                   Wishing you a smooth journey 
                                                                   <p style="margin:0px;">with Afrocargo!</p>
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
                                                                    You can access our services by downloading the Afrocargo app:
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 8px" valign="top"
                                                                    align="center">
                                                                    <p style="margin:3px"><b> iOS:</b> [Insert iOS App Link] </p>
                                                                    <p style="margin:3px"><b> Android:</b>
                                                                        [Insert Android App Link]</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding:15px 0px;" valign="top" align="center">
                                                                    Start exploring and enjoy a seamless 
                                                                    <p style="margin:0px;">shipping experience with us!</p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 20px;" colspan="2" bgcolor="#FFFFFF"
                                                    align="center">
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" align="center">
                                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td
                                                                                    style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 16px; font-weight: bold; color: white; background-color: #203A5F; padding: 5px 10px; border-radius: 5px; text-align: center;">
                                                                                    <a target="_blank"
                                                                                        style="font-family: Arial, Helvetica, sans-serif; font-size: 11px!important; text-decoration: none; color: white;"
                                                                                        href="{{$loginUrl}}">Click
                                                                                        here to login</a>
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
                                                <td style="padding-top:20px;" valign="top" align="center">
                                                    <p style="margin: 5px 0px;">Best regards,</p>
                                                    <p style="margin: 5px 0px;">Afrocargo Team</p>
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
                                                                                    <span style="color: gray;">©2023
                                                                                        Afrocargo. All Rights
                                                                                        Reserved.</span>
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