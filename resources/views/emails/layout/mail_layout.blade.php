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
    @yield('style')
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
                                        @include('emails.layout.header')
                                        @yield('header')
                                        @yield('content')
                                        @yield('footer')
                                        @include('emails.layout.footer')
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
@yield('script')
</html>