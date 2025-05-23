<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Welcome to AgriApp</title>
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
                            <h2 style="color: #333;">Welcome to AgriCulture Blog App!</h2>
                            <p style="font-size: 16px; color: #555;">Your account has been created successfully. Below
                                are your login details:</p>

                            <table cellpadding="10" cellspacing="0" width="100%" style="margin: 20px 0;">
                                <tr>
                                    <td style="background-color: #f8f9fa; border: 1px solid #dee2e6;"><strong>Email
                                            ID:</strong></td>
                                    <td style="border: 1px solid #dee2e6;">{{ $email }}</td>
                                </tr>
                                <tr>
                                    <td style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                        <strong>Password:</strong>
                                    </td>
                                    <td style="border: 1px solid #dee2e6;">{{ $password }}</td>
                                </tr>
                            </table>

                            <p style="font-size: 16px;">You can login using the following link:</p>
                            <p>
                                <a href="{{ $appLink }}"
                                    style="display: inline-block; padding: 10px 20px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px;">Login
                                    to AgriApp</a>
                            </p>

                            <hr style="margin: 30px 0; border: none; border-top: 1px solid #ddd;">

                            <p style="font-size: 14px; color: #777;">If you did not register for this account, please
                                ignore this email.</p>

                            <p style="margin-top: 30px; color: #333;">
                                Thanks,<br>
                                <strong>AgriApp Team</strong>
                            </p>
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