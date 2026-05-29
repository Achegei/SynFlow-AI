<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-xl shadow w-96">

    <h1 class="text-xl font-bold mb-4">
        Set Your New Password
    </h1>

    <form method="POST" action="{{ route('auth.password.force-change') }}">
    @csrf

    <input type="password"
           name="password"
           placeholder="New Password"
           class="w-full border p-2 rounded mb-3">

    <input type="password"
           name="password_confirmation"
           placeholder="Confirm Password"
           class="w-full border p-2 rounded mb-4">

    <button class="w-full bg-black text-white py-2 rounded">
        Update Password
    </button>
</form>

</div>

</body>
</html>