@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Edukasi</h1>

    <form action="{{ route('edukasi.update', $edukasi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="judul">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ $edukasi->judul }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="jenis">Jenis</label>
            <select name="jenis" id="jenis" class="form-control" required>
                <option value="artikel" {{ $edukasi->jenis == 'artikel' ? 'selected' : '' }}>Artikel</option>
                <option value="video" {{ $edukasi->jenis == 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="isi">Isi</label>
            <textarea name="isi" id="isi" class="form-control">{{ $edukasi->isi }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="video_url">URL Video</label>
            <input type="url" name="video_url" id="video_url" class="form-control" value="{{ $edukasi->video_url }}">
        </div>

        <div class="form-group mb-3">
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
            @if ($edukasi->gambar)
                <img src="{{ asset('storage/edukasi/' . $edukasi->gambar) }}" alt="Gambar" width="100">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('edukasi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
