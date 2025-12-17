<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/skolafit-removebg-preview.png') }}" type="image/x-icon">
    <title>Dashboard Admin</title>
</head>
<body>
    <h2>Welcome to Admin Dashboard</h2>
    hai {{ Auth::user()->name }} anda telah login sebagai admin
    <a href="/home">
        Kembali ke Home
    </a>
    
</body>
</html>