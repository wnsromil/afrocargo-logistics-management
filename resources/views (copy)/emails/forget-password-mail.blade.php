<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" class="gr__">

<head>
    <link href="http://fonts.cdnfonts.com/css/gotham-rounded" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Email notification</title>
    <style>
        td,
        span,
        a {
            font-family: 'Gotham Rounded', sans-serif;
        }
    </style>
</head>

<body style="background: white; padding: 0px; margin: 0px;" data-gr-c-s-loaded="true" bgcolor="white">
    <!-- START main table -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="text-align: center; padding: 0px 10px; margin: 0px;width: 150px;/*! float: left; */width: 600px;"
                    bgcolor="white" align="center">
                    <div align="center">
                        <!-- START main centred table -->
                        <table width="630" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td>
                                        <!-- START main content table -->
                                        <table width="630" border="0" cellspacing="0" cellpadding="0">
                                            <!-- START module / top head info navi -->
                                            <tbody>
                                                <!-- END module -->
                                                <!-- START module / header with logo -->
                                                <tr>
                                                    <td colspan="2"
                                                        style="border-top: none; border-right: none; border-left: none;"
                                                        align="left">
                                                        <table width="630" border="0" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <!-- table column with logo -->
                                                                    <td valign="middle" align="center"
                                                                        >
                                                                        <table border="0" cellspacing="30"
                                                                            cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <!--table row with logo image-->
                                                                                    <td>
                                                                                        <a href="{{ url('/') }}"
                                                                                            target="_blank"> <img
                                                                                                src='{{asset('assets/images/AfroCargoLogo.svg')}}'
                                                                                                alt="Afrocargo Logo"
                                                                                                style="display: block; width: 100px; height: 100px;"
                                                                                                width="200px"
                                                                                                border="0">
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <!-- table column with slogan-->
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <!-- START module / colored section header-->
                                                <tr>
                                                    <td colspan="2"
                                                        style="border-top: none; border-right: none; border-bottom: none; border-left: none;background-color: white;"
                                                        bgcolor="#FF6600" align="center">
                                                        <table width="630" border="0" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <!-- table row with text -->
                                                                    <td width="630" valign="middle" bgcolor="white"
                                                                        align="center">
                                                                        <table border="0" cellspacing="0"
                                                                            cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="font-family: Arial,Helvetica,sans-serif; font-size: 16px; line-height: 24px; color: black; padding-top: 30px; padding-right: 0px;"
                                                                                        valign="middle" align="center">
                                                                                        <!--here goes section header text -->
                                                                                        <span
                                                                                            style="font-size: 18px;">Dear
                                                                                            {{ $userName }}</span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="font-family: Arial,Helvetica,sans-serif; font-size: 16px; line-height: 24px; color: black; padding-top: 30px; padding-right: 0px;"
                                                                                        valign="middle" align="center">
                                                                                        <!--here goes section header text --><span
                                                                                            style="font-size: 18px;"></span>
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
                                                <!-- END module -->
                                                <!-- START module / three combi content columns image title and text-->
                                                <tr>
                                                    <td colspan="2" style=bgcolor="#FFFFFF" align="center">
                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td valign="top" align="center">
                                                                        Please use below OTP to forget your password -
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td style="padding-top: 8px;" valign="top"
                                                                        align="center">
                                                                        OTP : {{ $otp }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style=bgcolor="#FFFFFF" align="center">
                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td valign="top" align="center">
                                                                        <!--content table-->
                                                                        <table border="0" cellspacing="0"
                                                                            cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-family: Arial,Helvetica,sans-serif; font-size: 13px; line-height: 18px; color: black; padding-right: 24px; padding-bottom: 20px; padding-left: 24px; max-width:320px; text-align:center;">
                                                                                        <!--text goes here-->
                                                                                        <span
                                                                                            style="color: #222222; font-weight:bold;"></br>
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
                                                    <td colspan="2" style=bgcolor="#FFFFFF" align="center">
                                                        <table
                                                            style="width: 100%; padding-top: 15px;  border: 2px solid #c5c5c5; border-bottom: none; border-left: none; border-right: none;"
                                                            cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td valign="top" align="center">
                                                                        <!--content table-->
                                                                        <table border="0" cellspacing="0"
                                                                            cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td
                                                                                        style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; line-height: 18px; color: black; padding-right: 24px; padding-bottom: 20px; padding-left: 24px; max-width:320px; text-align:center;">
                                                                                        <!--text goes here-->
                                                                                        <span
                                                                                            style="color: gray;">©2023.
                                                                                            All Right Reserved.</span>
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
                                                <!-- END module -->
                                                <!-- START module / three combi content columns image title and text-->
                                                <!-- END module -->
                                            </tbody>
                                        </table>
                                        <!-- END main content table -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- END main centred table -->
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- END main table -->
    <span class="gr__tooltip">
        <span class="gr__tooltip-content"></span>
        <i class="gr__tooltip-logo"></i>
        <span class="gr__triangle"></span>
    </span>
</body>

</html>