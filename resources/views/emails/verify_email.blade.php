<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
</head>
<body>
    <p>Hello {{ $user->fullname }},</p>
    <p>Thank you for registering at <strong>CoirCraft PH</strong>!</p>
    <p>Please verify your email by clicking the link below:</p>
    <p>
        <a href="{{ $verificationUrl }}" style="background-color: #c6a15b; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Verify Email
        </a>
    </p>
    <p>If you did not create this account, you can ignore this email.</p>
</body>
</html>