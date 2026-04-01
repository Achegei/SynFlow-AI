<!DOCTYPE html>
<html>
<head>
    <title>Welcome to the Partner Dashboard</title>
</head>
<body>
    <h1>Hello {{ $user->name }},</h1>
    <p>Your partner account has been created successfully!</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Password:</strong> {{ $password }}</p>
    <p>Please log in and change your password immediately for security.</p>
    <p>Dashboard link: <a href="{{ url('/login') }}">Login Here</a></p>
</body>
</html>