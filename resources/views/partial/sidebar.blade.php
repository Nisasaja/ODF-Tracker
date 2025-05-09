<!-- Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start custom-offcanvas" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <aside class="sidebar">
            <!-- Logo Section -->
            <div class="sidebar-logo-container text-center my-4">
                <img src="{{ asset('assets/image/ODF.png') }}" alt="Logo" class="sidebar-logo mb-4">
            </div>
            <!-- Navigation Menu -->
            <ul class="menu-list list-unstyled">
                <li>
                    <a href="{{ route('dashboard') }}" class="menu-item d-flex align-items-center {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-gauge me-2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('penerimas.index') }}" class="menu-item d-flex align-items-center {{ request()->is('penerimas*') ? 'active' : '' }}">
                        <i class="fa-solid fa-person me-2"></i> Profil Penerima
                    </a>
                </li>
                <li>
                    <a href="{{ route('laporans.index') }}" class="menu-item d-flex align-items-center {{ request()->is('laporans*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard me-2"></i> Laporan
                    </a>
                </li>
                <li>
                    <a href="{{ route('edukasi.index') }}" class="menu-item d-flex align-items-center {{ request()->is('edukasi*') ? 'active' : '' }}">
                        <i class="fa-solid fa-face-grin-wink me-2"></i> Edukasi
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="menu-item btn btn-link d-flex align-items-center text-start text-decoration-none">
                            <i class="fas fa-sign-out-alt me-2"></i> Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </aside>
    </div>
</div>
