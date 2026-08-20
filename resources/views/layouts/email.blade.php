<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $subject ?? 'Moose Loon AI' }}</title>
</head>

<body style="margin:0; padding:0; background:#f4f6f8; font-family:Arial, Helvetica, sans-serif;">

    <div style="max-width:600px; margin:40px auto; background:#ffffff;">

        {{-- Header --}}
        <div style="padding:25px; background:#111827; text-align:center;">
            <h1 style="margin:0; color:#ffffff; font-size:24px;">
                Moose Loon AI
            </h1>
        </div>

        {{-- Email Content --}}
        <div style="padding:30px; color:#333333; line-height:1.6;">

            @yield('content')

        </div>

        {{-- Footer --}}
        <div style="padding:20px 30px; background:#f9fafb; text-align:center; color:#777777; font-size:13px;">

            <p style="margin:0;">
                © {{ date('Y') }} Moose Loon AI
            </p>

            <p style="margin:5px 0 0;">
                This is an automated email from Moose Loon AI.
            </p>

        </div>

    </div>

</body>
</html>