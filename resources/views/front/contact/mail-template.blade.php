<html>
<head>
    <title>{{ config('app.name') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>a{text-decoration: none}table img{display: block;border: 0;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;}table tr{border-collapse: collapse;}table p{margin: 0;-webkit-text-size-adjust: none;-ms-text-size-adjust: none;mso-line-height-rule: exactly;line-height: 190%}</style></head>
<body style="background-color:#ffffff;padding:0;margin:0">
<table align="center" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;width:100%;padding:0;border-collapse:collapse;background-color:#ffffff">
    <tr>
        <td style="padding:30px">
            <table align="center" cellpadding="0" cellspacing="0" border="0" width="600" style="margin:0 auto;width:600px;padding:0;border-collapse:collapse">
                <tr>
                    <td align="center">
                        <img src="{{ env('APP_URL') }}/images/logo.png" alt="Logotyp Podkarpacki Oddział PTMSiZP" width="135" height="141">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:0 30px">
            <table align="center" cellpadding="0" cellspacing="0" border="0" width="600" style="margin:0 auto;width:600px;padding:0;border-collapse:collapse;background:white">
                <tr>
                    <td style="font-family:Arial;font-size:14px;padding:25px 30px;line-height:24px">
                        <p>Klient <b>{{ $request->form_name }}</b> napisał wiadomość:</p>
                        <table align="center" cellpadding="0" cellspacing="0" border="0" width="400" style="margin:30px auto;width:400px;padding:0;border:1px solid #b7b7b7;background:white">
                            <tr>
                                <td style="font-family:Arial;font-size:14px;padding:15px;line-height:18px"><b>Mail</b>:</td>
                                <td style="font-family:Arial;font-size:14px;padding:15px;line-height:18px">{{ $request->form_email }}</td>
                            </tr>
                            @if($request->form_phone)
                                <tr>
                                    <td style="font-family:Arial;font-size:14px;padding:0 15px 15px;line-height:18px"><b>Telefon</b>:</td>
                                    <td style="font-family:Arial;font-size:14px;padding:0 15px 15px;line-height:18px">{{ $request->form_phone }}</td>
                                </tr>
                            @endif
                            @if($request->form_message)
                                <tr>
                                    <td style="font-family:Arial;font-size:14px;padding:0 15px 15px;line-height:18px"><b>Treść wiadomości</b>:</td>
                                </tr>
                                <tr>
                                    <td style="font-family:Arial;font-size:14px;padding:0 15px 15px;line-height:18px">{{ $request->form_message }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td style="font-family:Arial;font-size:12px;padding:15px;line-height:14px;border-top:1px solid #dedede"><b>Data</b>:</td>
                                <td style="font-family:Arial;font-size:12px;padding:15px;line-height:14px;border-top:1px solid #dedede">{{ date('Y-m-d H:i:s') }}</td>
                            </tr>
                            <tr>
                                <td style="font-family:Arial;font-size:12px;padding:0 15px 15px;line-height:14px"><b>Adres IP</b>:</td>
                                <td style="font-family:Arial;font-size:12px;padding:0 15px 15px;line-height:14px">{{ $request->ip() }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="height: 100px" height="100">&nbsp;</td>
    </tr>
</table>
</body>
</html>
