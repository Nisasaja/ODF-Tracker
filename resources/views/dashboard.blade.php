@extends('partial.main')

@section('body')
<div class="container">
    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-black mb-3">
                <div class="card-header text-white bg-info">Total Penerima</div>
                <div class="card-body">
                    <h1 class="card-title">{{ $totalPenerima }}</h1>
                    <p class="card-text ">Total penerima program saat ini.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-black mb-3">
                <div class="card-header text-white bg-success">Selesai</div>
                <div class="card-body">
                    <h1 class="card-title">{{ $totalSelesai }}</h1>
                    <p class="card-text">Penerima yang sudah menyelesaikan jamban</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-black mb-3">
                <div class="card-header text-white bg-warning">Belum Selesai</div>
                <div class="card-body">
                    <h1 class="card-title">{{ $totalBelumSelesai }}</h1>
                    <p class="card-text">Penerima dalam proses perbaikan.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Penyelesaian Per Penerima -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #62d1b4;">Waktu Penyelesaian per Penerima</div>
                <div class="card-body">
                    <canvas id="grafikPenyelesaian"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Rata-Rata Penyelesaian per Desa -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #73c3f4;">Rata-Rata Waktu Penyelesaian per Desa</div>
                <div class="card-body">
                    <canvas id="grafikDesa"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Distribusi Status per Desa -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #ee9090;">Distribusi Status Berdasarkan Desa</div>
                <div class="card-body">
                    <canvas id="grafikStatusDesa"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data for Grafik Penyelesaian per Penerima
        var ctxPenyelesaian = document.getElementById('grafikPenyelesaian').getContext('2d');
        var chartPenyelesaian = new Chart(ctxPenyelesaian, {
            type: 'bar',
            data: {
                labels: {!! json_encode($namaPenerima) !!},
                datasets: [{
                    label: 'Hari Penyelesaian',
                    data: {!! json_encode($waktuPenyelesaian) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Data for Grafik Rata-Rata Penyelesaian per Desa
        var ctxDesa = document.getElementById('grafikDesa').getContext('2d');
        var chartDesa = new Chart(ctxDesa, {
            type: 'bar',
            data: {
                labels: {!! json_encode($namaDesa) !!},
                datasets: [{
                    label: 'Rata-Rata Hari Penyelesaian',
                    data: {!! json_encode($rataRataDesa) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Data for Grafik Distribusi Status Berdasarkan Desa
        var ctxStatusDesa = document.getElementById('grafikStatusDesa').getContext('2d');
        var grafikStatusDesaData = {!! $grafikStatusDesaJSON !!};

        var statusDesaLabels = Object.keys(grafikStatusDesaData);
        var statusData = {
            baruMulai: [],
            progres: [],
            selesai: []
        };

        statusDesaLabels.forEach(function(desa) {
            statusData.baruMulai.push(grafikStatusDesaData[desa]['baru mulai']);
            statusData.progres.push(grafikStatusDesaData[desa]['progres']);
            statusData.selesai.push(grafikStatusDesaData[desa]['selesai']);
        });

        var chartStatusDesa = new Chart(ctxStatusDesa, {
            type: 'bar',
            data: {
                labels: statusDesaLabels,
                datasets: [{
                    label: 'Baru Mulai',
                    data: statusData.baruMulai,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Progres',
                    data: statusData.progres,
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Selesai',
                    data: statusData.selesai,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <footer class="text-center mt-4">
        <p>&copy; 2024 ODF-Tracker. All rights reserved.</p>
    </footer>
@endsection
