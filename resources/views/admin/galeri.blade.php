<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Galeri - Cafe Candaria</title>
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- File CSS Eksternal -->
    <link rel="stylesheet" href="{{ asset('css/galeri.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin-sidebar-toggle.css') }}">
</head>
<body>

<div class="dashboard-container">
    
    <!-- ================= SIDEBAR ================= -->
    <aside class="sidebar">
        <div>
            <!-- Brand Badge -->
            <div class="brand-logo-container">
                <div class="brand-badge">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.src='https://via.placeholder.com/35x40?text=LOGO'">
                    <div class="brand-text">
                        <h1>Cafe Candaria</h1>
                        <p>SMKN 2 PURWAKARTA</p>
                    </div>
                </div>
            </div>

            <!-- List Menu -->
            <nav class="sidebar-menu">
                <div class="sidebar-title">MENU ADMIN</div>
                <ul class="sidebar-list">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.profil') }}">Profil</a></li>
                    <li><a href="{{ route('admin.organigram') }}">Organigram</a></li>
                    <li><a href="{{ route('admin.menu') }}">Menu</a></li>
                    <li><a href="{{ route('admin.jam-operasional') }}">Jam Operasional</a></li>
                    <li class="active"><a href="{{ route('admin.galeri') }}">Galeri</a></li>
                </ul>
            </nav>
        </div>

        <!-- Tombol Logout -->
        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- ================= MAIN CONTENT ================= -->
    <main class="main-content">
        <!-- Topbar -->
        <header class="topbar">
            <button class="toggle-btn" aria-label="Toggle Menu">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="admin-pill">
                <i class="fa-solid fa-user"></i>
                <span>Admin</span>
            </div>
        </header>

        <!-- Card Wrapper -->
        <div class="content-card">
            <div class="card-header" style="display:flex; justify-content:space-between; align-items:flex-end; gap:12px; flex-wrap:wrap;">
                <div>
                    <div class="subtitle">KELOLA</div>
                    <h2 class="title">GALERI</h2>
                    <p class="desc">Perbaharui galeri di bawah ini</p>
                </div>
                <a href="{{ route('admin.galeri.create') }}" class="btn-action" style="white-space:nowrap;">
                    <i class="fa-solid fa-plus"></i> Tambah Foto
                </a>
            </div>

            @if (session('success'))
                <div style="background:#e6f7e1; color:#2f6b2f; padding:10px 14px; border-radius:8px; margin-bottom:14px; font-size:14px;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Gallery Cards Grid -->
            <div class="gallery-grid">
                {{-- Menampilkan galeri dinamis (otomatis fallback ke 4 dummy jika data kosong) --}}
                @forelse($galleries ?? [1, 2, 3, 4] as $item)
                    <div class="gallery-item">
                        <div class="img-wrapper">
                            @if(is_object($item) && !empty($item->gambar))
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="Foto Galeri" onerror="this.src='https://picsum.photos/300/200?random={{ $item->id }}'">
                            @else
                                <img src="https://picsum.photos/300/200?random={{ is_object($item) ? $item->id : $item }}" alt="Foto Galeri">
                            @endif
                        </div>
                        
                        <div class="action-buttons">
                            <!-- Tombol Hapus menuju halaman konfirmasi hapusgaleri -->
                            <a href="{{ route('admin.galeri.hapus', is_object($item) ? $item->id : $item) }}" class="btn-action">
                                <i class="fa-solid fa-trash-can"></i> Hapus
                            </a>

                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.galeri.edit', is_object($item) ? $item->id : $item) }}" class="btn-action">
                                <i class="fa-solid fa-pencil"></i> Edit
                            </a>
                        </div>
                    </div>
                @empty
                    <p>Tidak ada data galeri.</p>
                @endforelse
            </div>
        </div>
    </main>

</div>

<script src="{{ asset('js/admin-sidebar.js') }}"></script>
</body>
</html>