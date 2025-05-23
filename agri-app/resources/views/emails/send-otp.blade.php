<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Password Reset OTP - AgriApp</title>
</head>

<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">

    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); overflow: hidden;">
                    <tr>
                        <td style="background-color: #28a745; padding: 20px 0; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0;">AgriApp</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px;">
                            <h2 style="color: #333;">Password Reset Request</h2>
                            <p style="font-size: 16px; color: #555;">We received a request to reset your password.</p>

                            <p style="font-size: 18px; margin: 20px 0;">
                                <strong>Your OTP Code:</strong>
                                <span
                                    style="display: inline-block; font-size: 24px; font-weight: bold; background-color: #f1f1f1; padding: 10px 20px; border-radius: 8px; margin-top: 10px;">{{ $otp }}</span>
                            </p>

                            <p style="font-size: 14px; color: #888; margin-top: 10px;">This OTP is valid for 10 minutes.
                                Do not share it with anyone.</p>

                            <p style="margin-top: 30px; color: #333;">Thanks,<br><strong>AgriApp Team</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="background-color: #f1f1f1; text-align: center; padding: 15px; font-size: 12px; color: #888;">
                            &copy; {{ date('Y') }} AgriApp. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>