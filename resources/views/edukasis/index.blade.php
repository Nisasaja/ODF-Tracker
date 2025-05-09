@extends('partial.main')

@section('body')
<div class="container mt-5">
    <!-- Title with Center Alignment -->
    <div class="text-center mb-4">
        <h1 class="text-primary">Daftar Edukasi</h1>
    </div>
    
    @auth
        @if (Auth::user()->role === 'admin')
            <a href="{{ route('edukasis.create') }}" class="btn btn-primary mb-3">
                <i class="fa-solid fa-plus me-2"></i> Tambah Edukasi
            </a>
        @endif
    @endauth

    <div class="container mt-4">
        @if(session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif

    {{--  Tab Navigantion  --}}
    <ul class="nav nav-tabs mb-4" id="edukasiTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="artikel-tab" data-bs-toggle="tab" data-bs-target="#artikel" type="button" role="tab" aria-controls="artikel" aria-selected="true">
                Berita Acara
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video" type="button" role="tab" aria-controls="video" aria-selected="false">
                Video
            </button>
        </li>
    </ul>

    {{--  Tab Content --}}
    <div class="tab-content" id="edukasiTabsContent">
        <!-- Artikel Tab -->
        <div class="tab-pane fade show active" id="artikel" role="tabpanel" aria-labelledby="artikel-tab">
            <div class="row">
                @forelse ($edukasis->where('jenis', 'artikel') as $edukasi)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if ($edukasi->gambar)
                                <img src="{{ asset('storage/edukasi/' . $edukasi->gambar) }}" class="card-img-top" alt="{{ $edukasi->judul }}">
                            @else
                                <img src="https://via.placeholder.com/150x150.png?text=No+Image" class="card-img-top" alt="{{ $edukasi->judul }}">
                            @endif
                            <div class="card-body">
                                <h3 class="card-title">{{ $edukasi->judul }}</h3>
                                <p class="card-text">{{ Str::limit($edukasi->isi, 100) }}</p>
                                <p class="text-muted">{{ $edukasi->created_at->format('d-m-Y') }}</p>
                                <a href="{{ route('edukasis.show', $edukasi->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa-solid fa-eye me-1"></i> Lihat
                                </a>
                                @if (Auth::user()->role === 'admin')
                                <a href="{{ route('edukasis.edit', $edukasi->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-edit me-1"></i> Edit
                                </a>
                                <form action="{{ route('edukasis.destroy', $edukasi->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                        <i class="fa-solid fa-trash me-1"></i> Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Tidak ada acara tersedia.</p>
                @endforelse
            </div>
        </div>

        {{--  Video  --}}
        <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
            <div class="row">
                @forelse ($edukasis->where('jenis', 'video') as $edukasi)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if ($edukasi->gambar)
                                <img src="{{ asset('storage/edukasi/' . $edukasi->gambar) }}" class="card-img-top" alt="{{ $edukasi->judul }}">
                            @else
                                <img src="https://via.placeholder.com/150x150.png?text=No+Image" class="card-img-top" alt="{{ $edukasi->judul }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $edukasi->judul }}</h5>
                                <p class="card-text">Video Edukasi</p>
                                <p class="text-muted">{{ $edukasi->created_at->format('d-m-Y') }}</p>
                                <a href="{{ $edukasi->video_url }}" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-play me-1"></i> Tonton Video
                                </a>
                                @if (Auth::user()->role === 'admin')
                                <a href="{{ route('edukasis.edit', $edukasi->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-edit me-1"></i> Edit
                                </a>
                                <!-- Trigger Modal for Delete -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $edukasi->id }}">
                                    <i class="fa-solid fa-trash me-1"></i> Hapus
                                </button>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="hapusModal{{ $edukasi->id }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus edukasi "{{ $edukasi->judul }}"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('edukasis.destroy', $edukasi->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Tidak ada video tersedia.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Pagination Links -->
    {{ $edukasis->links() }}
</div>
@endsection
