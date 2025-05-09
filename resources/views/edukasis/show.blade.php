@extends('partial.main')

@section('body')
<div class="container mt-5">
    <h1 class="text-primary">Detail Kegiatan</h1>

    <!-- Display success message if available -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Edukasi Details -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>{{ $edukasi->judul }}</h4>
        </div>
        <div class="card-body">
            <!-- Display Image -->
            @if($edukasi->gambar)
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/edukasi/' . $edukasi->gambar) }}" alt="{{ $edukasi->judul }}" class="img-fluid rounded" style="max-height: 400px;">
                </div>
            @endif

            {{--  Display Content   --}}
            <p><strong>Konten:</strong></p>
            <p>{!! nl2br(e($edukasi->isi)) !!}</p>

            <!-- Metadata -->
            <p><strong>Created At:</strong> {{ \Carbon\Carbon::parse($edukasi->created_at)->format('d-m-Y') }}</p>
            <p><strong>Updated At:</strong> {{ \Carbon\Carbon::parse($edukasi->updated_at)->format('d-m-Y') }}</p>

            <!-- Back to list button -->
            <a href="{{ route('edukasis.index') }}" class="btn btn-primary mt-3">Kembali ke Daftar Edukasi</a>
        </div>
    </div>
</div>
@endsection
