@extends('partial.main')

@section('body')
<div class="container mt-4">
    <h1 class="mt-5 mb-4">Tambah Edukasi</h1>

    <form action="{{ route('edukasis.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{--  Judul  --}}
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Edukasi</label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Masukkan judul edukasi" required>
            @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{--  Jenis  --}}
        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Edukasi</label>
            <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required>
                <option value="" selected disabled>Pilih Jenis</option>
                <option value="artikel" {{ old('jenis', 'artikel') == 'artikel' ? 'selected' : '' }}>Berita Acara</option>
                <option value="video" {{ old('jenis') == 'video' ? 'selected' : '' }}>Video</option>
            </select>
            @error('jenis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{--  isi (hanya untuk artikel)  --}}
        <div class="mb-3" id="isi-container" style="display: none;">
            <label for="isi" class="form-label">Isi Berita Acara</label>
            <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="5">{{ old('isi') }}</textarea>
            @error('isi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{--  video (hanya untuk link url)  --}}
        <div class="mb-3" id="video-container" style="display: none;">
            <label for="video_url" class="form-label">URL Video</label>
            <input type="url" class="form-control @error('video_url') is-invalid @enderror" id="video_url" name="video_url" value="{{ old('video_url') }}" placeholder="Masukkan URL video">
            @error('video_url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{--  Gambar  --}}
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Edukasi</label>
            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
            <img id="preview" src="#" alt="Preview Gambar" style="display: none; max-width: 100%; height: 150px; object-fit: cover; margin-top: 10px;">
            @error('gambar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{--  Submit  --}}
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-save me-2"></i> Simpan
        </button>
        <a href="{{ route('edukasis.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-2"></i> Kembali
        </a>
    </form>
</div>
@endsection

@section('scripts')
    <script>
        document.getElementById('gambar').addEventListener('change', function (event) {
            const reader = new FileReader();
            reader.onload = function () {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        });

        document.addEventListener('DOMContentLoaded', function () {
            const jenisSelect = document.getElementById('jenis');
            const isiContainer = document.getElementById('isi-container');
            const videoContainer = document.getElementById('video-container');

            function toggleFields() {
                const selectedJenis = jenisSelect.value;
                if (selectedJenis === 'artikel') {
                    isiContainer.style.display = 'block';
                    videoContainer.style.display = 'none';
                    videoContainer.querySelector('input').value = ''; // Reset URL video
                } else if (selectedJenis === 'video') {
                    isiContainer.style.display = 'none';
                    videoContainer.style.display = 'block';
                    isiContainer.querySelector('textarea').value = ''; // Reset isi artikel
                } else {
                    isiContainer.style.display = 'none';
                    videoContainer.style.display = 'none';
                }
            }

            // Initial toggle based on old input
            toggleFields();

            jenisSelect.addEventListener('change', toggleFields);
        });
    </script>
    <style>
        #preview {
            display: none;
            max-width: 100%;
            height: 150px; 
            object-fit: cover; 
            margin-top: 10px;
        }        
    </style>
@endsection
