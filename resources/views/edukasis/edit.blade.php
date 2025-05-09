<!-- resources/views/edukasis/edit.blade.php -->

@extends('partial.main')

@section('body')
<div class="container mt-4">
    <h1 class="mt-5 mb-4">Edit Edukasi</h1>

    <form action="{{ route('edukasis.update', $edukasi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Edukasi</label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $edukasi->judul) }}" required>
            @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Jenis -->
        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Edukasi</label>
            <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required>
                <option value="" disabled>Pilih Jenis</option>
                <option value="artikel" {{ old('jenis', $edukasi->jenis) == 'artikel' ? 'selected' : '' }}>Berita Acara</option>
                <option value="video" {{ old('jenis', $edukasi->jenis) == 'video' ? 'selected' : '' }}>Video</option>
            </select>
            @error('jenis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Isi (Hanya untuk Artikel) -->
        <div class="mb-3" id="isi-container" style="display: none;">
            <label for="isi" class="form-label">Isi Berita Acara</label>
            <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="5">{{ old('isi', $edukasi->isi) }}</textarea>
            @error('isi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Video URL (Hanya untuk Video) -->
        <div class="mb-3" id="video-container" style="display: none;">
            <label for="video_url" class="form-label">URL Video</label>
            <input type="url" class="form-control @error('video_url') is-invalid @enderror" id="video_url" name="video_url" value="{{ old('video_url', $edukasi->video_url) }}">
            @error('video_url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Gambar -->
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Edukasi</label>
            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
            @error('gambar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($edukasi->gambar)
                <div class="mt-2">
                    <img src="{{ asset('storage/edukasi/' . $edukasi->gambar) }}" alt="Gambar Edukasi" class="img-thumbnail" style="max-width: 200px;">
                </div>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-warning">
            <i class="fa-solid fa-save me-2"></i> Perbarui
        </button>
        <a href="{{ route('edukasis.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-2"></i> Kembali
        </a>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jenisSelect = document.getElementById('jenis');
        const isiContainer = document.getElementById('isi-container');
        const videoContainer = document.getElementById('video-container');

        function toggleFields() {
            const selectedJenis = jenisSelect.value;
            if (selectedJenis === 'artikel') {
                isiContainer.style.display = 'block';
                videoContainer.style.display = 'none';
            } else if (selectedJenis === 'video') {
                isiContainer.style.display = 'none';
                videoContainer.style.display = 'block';
            } else {
                isiContainer.style.display = 'none';
                videoContainer.style.display = 'none';
            }
        }

        // Initial toggle based on old input or existing jenis
        toggleFields();

        jenisSelect.addEventListener('change', toggleFields);
    });
</script>
@endsection
