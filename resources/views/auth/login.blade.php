<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINORA - LOGIN</title>
    <!-- Link ke CSS dari folder public -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/LOGIN_style.css') }}">
</head>
<body>
    <div class="logo-container">
        <img src="{{ asset('images/BPS_logo.png') }}" alt="Company Logo" class="logo">
        <h1 class="company-name">Badan Pusat Statistik</h1>
    </div>

    <div class="background-blur"></div>

    <div class="login-container">
        <h1 class="app-name" style="color: #0093DD">SINO<span style="color: #000000">RA</span></h1>
        <p class="app-longname">(Sistem Informasi Penomoran Surat)</p>
        <form class="input-container" action="{{ route('login') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>