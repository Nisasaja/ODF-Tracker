<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ODF Tracker</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="app-name">
            <img src="{{ asset('images/logo.png') }}" alt="ODF Logo" class="logo">
            <span>ODF</span>
        </div>
        <div class="menu-icon" onclick="toggleMenu()">
            <i class="fas fa-bars"></i> <!-- Hamburger icon -->
        </div>
    </header>

    <div id="sidebar" class="sidebar">
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="#laporan">Laporan</a></li>
            <li><a href="#penerima">Penerima</a></li>
        </ul>
    </div>

    <main>
        @yield('content') <!-- Konten spesifik untuk setiap halaman -->
    </main>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
