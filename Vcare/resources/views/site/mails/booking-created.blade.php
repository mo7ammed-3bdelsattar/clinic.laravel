<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تأكيد الحجز - vCare</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 30px; margin: 0; direction: rtl;">

    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <tr>
            <td style="background-color: #4CAF50; padding: 20px; color: white; text-align: center;">
                <h1 style="margin: 0;">vCare Clinic</h1>
            </td>
        </tr>

        <tr>
            <td style="padding: 30px;">
                <h2 style="text-align: center; color: #4CAF50;">رقم الحجز: {{ '#'.$booking['bookingNumber'] }}</h2>

                <p style="font-size: 18px;">مرحباً <strong>{{ $booking['patientName'] }}</strong>،</p>

                <p style="font-size: 16px;">تم تأكيد حجزك مع الدكتور <strong>{{ $booking['doctorName'] }}</strong></p>

                <p style="font-size: 16px;">
                    <strong>اليوم:</strong> {{ \Carbon\Carbon::parse($booking['day'])->translatedFormat('l d/m/y') }}<br>
                    <strong>الساعة:</strong> {{ $booking['date'] }}
                </p>

                <div style="margin-top: 30px; text-align: center;">
                    <p style="font-size: 16px; color: #333;">شكراً لاستخدامك <strong>vCare</strong> 🌟</p>
                </div>
            </td>
        </tr>

        <tr>
            <td style="background-color: #f0f0f0; padding: 10px; text-align: center; font-size: 12px; color: #777;">
                © {{ now()->year }} vCare Clinic. جميع الحقوق محفوظة.
            </td>
        </tr>
    </table>

</body>
</html>
