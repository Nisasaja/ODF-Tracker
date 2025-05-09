<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ODF-Tracker</title>
    <link rel="icon" href="{{ asset('assets/image/ODF.png') }}" type="image/png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS (Satu Versi) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body>
    {{-- Navbar dan Sidebar secara kondisional --}}
    @if (!Request::is('login') && !Request::is('register') && !Request::is('laporans/create') && !Request::is('laporans/*/edit') && !Request::is('penerimas/create') && !Request::is('penerimas/*/edit'))
        @include('partial.navbar')
        @include('partial.sidebar')
    @endif

    <div class="container-fluid" style="margin-top: 70px;">
        @yield('body')
    </div>
    
    <!-- Bootstrap JS Bundle (Satu Versi) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- Section untuk JS tambahan pada halaman tertentu -->
    @yield('scripts')
</body>
</html>
