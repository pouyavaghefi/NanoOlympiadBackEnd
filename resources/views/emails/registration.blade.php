<!DOCTYPE html>
<html>
<head>
    <title>Complete Your Registration</title>
</head>
<body>
<h1>Hi, {{ $name }}</h1>
<p>Thank you for registering! Please click the link below to complete your registration:</p>
<a href="{{ env('URL_FRONT') }}/clientarea/verify">Complete Registration</a>
<p>If you didn't register, please ignore this email.</p>
</body>
</html>
