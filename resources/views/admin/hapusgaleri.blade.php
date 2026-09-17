<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hapus Galeri - Cafe Candaria</title>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,600;1,700&display=swap" rel="stylesheet">
  <!-- CSS Hapus Galeri -->
  <link rel="stylesheet" href="{{ asset('css/hapusgaleri.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin-sidebar-toggle.css') }}">
</head>
<body class="dashboard-body">

  <div class="admin-container">
    <!-- ================= SIDEBAR LEFT ================= -->
    <aside class="sidebar">
      <div class="sidebar-top-content">
        <!-- LOGO BRAND -->
        <div class="sidebar-logo-box">
          <img src="{{ asset('images/logo.png') }}" alt="Logo SMKN 2 Purwakarta" class="sidebar-logo" onerror="this.src='https://via.placeholder.com/35x40?text=LOGO'">
          <div class="logo-text">
            <span class="brand-title-sidebar">Cafe Candaria</span>
            <span class="brand-sub-sidebar">SMKN 2 PURWAKARTA</span>
          </div>
        </div>

        <!-- MENU ADMIN LIST -->
        <div class="sidebar-menu-wrapper">
          <h3 class="sidebar-section-title">MENU ADMIN</h3>
          <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="nav-item">Dashboard</a>
            <a href="{{ route('admin.profil') }}" class="nav-item">Profil</a>
            <a href="{{ route('admin.organigram') }}" class="nav-item">Organigram</a>
            <a href="{{ route('admin.menu') }}" class="nav-item">Menu</a>
            <a href="{{ route('admin.jam-operasional') }}" class="nav-item">Jam Operasional</a>
            <a href="{{ route('admin.galeri') }}" class="nav-item active">Galeri</a>
          </nav>
        </div>
      </div>

      <!-- LOGOUT BUTTON -->
      <div class="sidebar-bottom-logout">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn-sidebar-logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
          </button>
        </form>
      </div>
    </aside>

    <!-- ================= MAIN CONTENT AREA ================= -->
    <main class="main-content">
      <!-- TOP NAVBAR -->
      <header class="top-navbar">
        <button class="hamburger-btn" aria-label="Toggle Menu">
          <span></span>
          <span></span>
          <span></span>
        </button>

        <div class="top-right-section">
          <div class="admin-badge">
            <i class="fa-solid fa-user admin-icon"></i>
            <span class="admin-text">Admin</span>
          </div>
        </div>
      </header>

      <!-- DELETE CONFIRMATION CARD -->
      <div class="delete-content-wrapper">
        <div class="delete-card">
          <!-- ICON SAMPAH -->
          <div class="trash-icon-box">
            <svg viewBox="0 0 24 24" fill="currentColor">
              <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
            </svg>
          </div>

          <h2 class="delete-title">Hapus foto galeri ini?</h2>
          <p class="delete-description">
            Data yang sudah di hapus tidak bisa dikembalikan. Pastikan kamu yakin sebelum melanjutkan.
          </p>

          <!-- PREVIEW GAMBAR GALERI YANG AKAN DIHAPUS -->
          <div class="gallery-preview-box">
            @if(isset($galeri->gambar) && $galeri->gambar)
              <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="Foto Galeri" onerror="this.src='https://picsum.photos/300/200?random={{ $galeri->id ?? ($id ?? 1) }}'">
            @else
              <img src="https://picsum.photos/300/200?random={{ is_object($galeri ?? null) ? $galeri->id : ($id ?? 1) }}" alt="Foto Galeri">
            @endif
          </div>

          <!-- DISPLAY KETERANGAN / NAMA FOTO -->
          <div class="target-input-box">
            <input type="text" value="{{ $galeri->keterangan ?? ($galeri->judul ?? ('Foto Galeri #' . ($id ?? 1))) }}" readonly class="readonly-target-input">
          </div>

          <!-- ACTION BUTTONS -->
          <form action="{{ route('admin.galeri.destroy', $galeri->id ?? ($id ?? '')) }}" method="POST" class="delete-actions-form">
            @csrf
            @method('DELETE')
            <div class="form-actions">
              <a href="{{ route('admin.galeri') }}" class="btn-cancel">Batal</a>
              <button type="submit" class="btn-delete">Ya, Hapus</button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>

<script src="{{ asset('js/admin-sidebar.js') }}"></script>
</body>
</html>

