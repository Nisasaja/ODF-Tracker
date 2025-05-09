<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ODF-Tracker</title>
    <link rel="icon" href="{{ asset('assets/image/ODF.png') }}" type="image/png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <!-- Hero Section -->
    <section class="hero" style="background-image: url('{{ asset('assets/image/ODF_sekatak.jpeg') }}'); background-size: cover; background-position: center; height: 600px; position: relative; color: white;">
        <!-- Overlay untuk memberikan efek gelap pada gambar -->
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5);"></div>
    
        <!-- Konten Hero -->
        <div class="container" style="position: relative; z-index: 2;">
            <h1 class="display-4">Selamat Datang di ODF-Tracker</h1>
            <p class="lead">Solusi Terbaik untuk Memantau Status ODF di Desa Binaan PT Pesona Khatulistiwa Nusantara</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Masuk</a>
        </div>
    </section>    

    <!-- Features Section -->
    <section class="features container my-5">
        <h2 class="text-center mb-4">Fitur Utama ODF-Tracker</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-chart-line fa-3x mb-3"></i>
                        <h5 class="card-title">Pelacakan Real-Time</h5>
                        <p class="card-text">Pantau progres ODF secara langsung dengan grafik yang interaktif dan data yang selalu diperbarui.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-users fa-3x mb-3"></i>
                        <h5 class="card-title">Manajemen Penerima Bantuan</h5>
                        <p class="card-text">Atur dan kelola data penerima bantuan secara mudah, lengkap dengan status perbaikan dan pembuatan jamban.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-shield-alt fa-3x mb-3"></i>
                        <h5 class="card-title">Keamanan Data</h5>
                        <p class="card-text">Sistem dilengkapi dengan autentikasi untuk melindungi data sensitif dan menjaga kerahasiaan informasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta" style="background-color: #0852a0; color: white; padding: 40px 0;">
        <div class="container text-center">
            <h2>Mari Ikut Berpartisipasi</h2>    
            <p>Pantau status perkembangan ODF di desa anda</p>
            <a href="{{}}" class="btn btn-light btn-lg">Daftar Sekarang</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 ODF-Tracker. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
    
    <!-- Custom CSS -->
    <style>
        .hero {
            background-image: url('https://via.placeholder.com/1500x600.png?text=ODF-Tracker+Hero');
            background-size: cover;
            background-position: center;
            height: 600px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .features {
            padding: 50px 0;
        }

        .features .card {
            transition: transform 0.3s;
        }

        .features .card:hover {
            transform: scale(1.05);
        }

        .cta {
            background-color: #28a745;
            color: white;
            padding: 50px 0;
            text-align: center;
        }

        .cta h2 {
            margin-bottom: 20px;
        }

        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
        }
</style>
</html>
