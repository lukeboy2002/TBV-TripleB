<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }

        * {
            box-sizing: border-box;
            position: relative;
        }

        body{
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
            background-color: #ffffff;
            color: rgb(55 65 81);
            height: 100%;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            width: 100% !important;
        }

        table, td {
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
        }

        .wrapper {
            background-color: #edf2f7;
        }

        .wrapper
        .content {
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .inner-body {
            background-color: #ffffff;
            border-color: #e8e5ef;
            border-radius: 2px;
            border-width: 1px;
            box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015);
            margin: 0 auto;
            padding: 0;
            width: 570px;
        }
        .action {
            margin: 30px auto;
            padding: 0;
            text-align: center;
            width: 100%;
        }

        .header a {
            color: rgb(249 115 22);
            font-size: 32px;
            font-weight: 900;
            text-decoration: none;
            display: inline-block;
        }

        h1 {
            color: #3d4852;
            font-size: 18px;
            font-weight: bold;
            margin-top: 0;
            text-align: left;
        }

        p {
            font-size: 16px;
            line-height: 1.5em;
            margin-top: 0;
            text-align: left;
        }

        .user {
            font-size: 16px;
            line-height: 1.5em;
            margin-top: 0;
            text-align: left;
            color: rgb(249 115 22);
            font-weight: 700;
        }

        .button {
            border-radius: 4px; color: #fff;
            display: inline-block;
            overflow: hidden;
            text-decoration: none;
            background-color: rgb(249 115 22);
            border-bottom: 8px solid rgb(249 115 22);
            border-left: 18px solid rgb(249 115 22);
            border-right: 18px solid rgb(249 115 22);
            border-top: 8px solid rgb(249 115 22);
        }
    </style>
</head>

<body style="-webkit-text-size-adjust: none; ">
<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="-premailer-width: 100%; padding-bottom: 50px;">
    <tr>
        <td align="center">
            <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="-premailer-width: 100%;">
                <tr>
                    <td class="header" style="padding: 25px 0; text-align: center;">
                        <a href="http://tripleB.test" >TripleB</a>
                    </td>
                </tr>

                <!-- Email Body -->
                <tr>
                    <td class="body" width="100%" cellpadding="0" cellspacing="0" style="-premailer-width: 100%;">
                        <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="-premailer-width: 570px;">
                            <!-- Body content -->
                            <tr>
                                <td class="content-cell" style="max-width: 100vw; padding: 32px;">
                                    <h1>Hello! {{ $mailData['title'] }}</h1>
                                    <p>You are invited by <span class="user">{{ ucfirst( $mailData['invited_by'] ) }}</span> to Join our website</p>
                                    <p>Please click the button below to verify your email address.</p>
                                    <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="-premailer-width: 100%;">
                                        <tr>
                                            <td align="center">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                    <tr>
                                                        <td align="center" style="box-sizing: border-box;  position: relative;">
                                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                                <tr>
                                                                    <td>
                                                                        <a href="{{ $mailData['link'] }}" class="button" target="_blank" rel="noopener" style="-webkit-text-size-adjust: none;">Activate Account</a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <p>Regards,<br><span class="user">TripleB, {{ ucfirst( $mailData['invited_by'] ) }}</span></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>

</html>
