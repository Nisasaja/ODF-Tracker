@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Edukasi</h1>

    <form action="{{ route('edukasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="judul">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
            @error('judul')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="jenis">Jenis</label>
            <select name="jenis" id="jenis" class="form-control" required>
                <option value="">Pilih Jenis</option>
                <option value="artikel" {{ old('jenis') == 'artikel' ? 'selected' : '' }}>Artikel</option>
                <option value="video" {{ old('jenis') == 'video' ? 'selected' : '' }}>Video</option>
            </select>
            @error('jenis')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3" id="isi-group">
            <label for="isi">Isi</label>
            <textarea name="isi" id="isi" class="form-control">{{ old('isi') }}</textarea>
            @error('isi')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3" id="video-group">
            <label for="video_url">URL Video</label>
            <input type="url" name="video_url" id="video_url" class="form-control" value="{{ old('video_url') }}">
            @error('video_url')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
            @error('gambar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('edukasi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jenis = document.getElementById('jenis');
        const isiGroup = document.getElementById('isi-group');
        const videoGroup = document.getElementById('video-group');

        function toggleFields() {
            if (jenis.value === 'artikel') {
                isiGroup.style.display = 'block';
                videoGroup.style.display = 'none';
            } else if (jenis.value === 'video') {
                isiGroup.style.display = 'none';
                videoGroup.style.display = 'block';
            } else {
                isiGroup.style.display = 'none';
                videoGroup.style.display = 'none';
            }
        }

        jenis.addEventListener('change', toggleFields);
        toggleFields();
    });
</script>
@endsection
