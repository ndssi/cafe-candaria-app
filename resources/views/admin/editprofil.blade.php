<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profil - Cafe Candaria</title>
  <link rel="stylesheet" href="{{ asset('css/editprofil.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,600;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/admin-sidebar-toggle.css') }}">
</head>
<body class="dashboard-body">

  <div class="admin-container">
    <!-- SIDEBAR LEFT -->
    <aside class="sidebar">
      <div class="sidebar-logo-box">
        <img src="{{ asset('images/logo.png') }}" alt="Logo SMKN 2 Purwakarta" class="sidebar-logo">
        <div class="logo-text">
          <span class="brand-title-sidebar">Cafe Candaria</span>
          <span class="brand-sub-sidebar">SMKN 2 PURWAKARTA</span>
        </div>
      </div>

      <div class="sidebar-menu-wrapper">
        <h3 class="sidebar-section-title">MENU ADMIN</h3>
        <nav class="sidebar-nav">
          <a href="{{ route('admin.dashboard') }}" class="nav-item">Dashboard</a>
          <a href="{{ route('admin.profil') }}" class="nav-item active">Profil</a>
          <a href="{{ route('admin.organigram') }}" class="nav-item">Organigram</a>
          <a href="{{ route('admin.menu') }}" class="nav-item">Menu</a>
          <a href="{{ route('admin.jam-operasional') }}" class="nav-item">Jam Operasional</a>
          <a href="{{ route('admin.galeri') }}" class="nav-item">Galeri</a>
        </nav>
      </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="main-content">
      <!-- Top Navbar -->
      <header class="top-navbar">
        <button class="hamburger-btn" aria-label="Toggle Menu">
          <span></span>
          <span></span>
          <span></span>
        </button>

        <div class="admin-badge">
          <svg class="admin-icon" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
          </svg>
          <span class="admin-text">Admin</span>
        </div>
      </header>

      <!-- Center Container for Edit Card -->
      <div class="edit-content-wrapper">
        
        <!-- EDIT PROFIL CARD -->
        <div class="edit-card">
          <h2 class="edit-title">Edit Profil</h2>
          <p class="edit-subtitle">Perbaharui profil di bawah ini</p>

          @if ($errors->any())
            <div style="background:#fdecea; color:#b3261e; padding:10px 14px; border-radius:8px; margin-bottom:14px; font-size:14px;">
              <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" class="form-edit-profil">
            @csrf
            @method('PUT')

            <!-- Input Judul -->
            <div class="form-group">
              <label for="judul" class="input-label">Judul</label>
              <input type="text" id="judul" name="judul" class="custom-input" placeholder="Masukkan judul profil..." value="{{ $profil->judul ?? '' }}">
            </div>

            <!-- Input Sejarah -->
            <div class="form-group">
              <label for="sejarah" class="input-label">Sejarah</label>
              <textarea id="sejarah" name="sejarah" class="custom-input textarea-input" rows="2" placeholder="Masukkan sejarah cafe...">{{ $profil->sejarah ?? '' }}</textarea>
            </div>

            <!-- Input Foto Cafe -->
            <div class="form-group">
              <label for="foto" class="input-label">Foto Cafe</label>
              <input type="file" id="foto" name="foto" class="custom-input file-input" accept="image/*">
            </div>

            <!-- Tombol Aksi -->
            <div class="button-group">
              <a href="{{ route('admin.profil') }}" class="btn-batal">Batal</a>
              <button type="submit" class="btn-simpan">Simpan Perubahan</button>
            </div>
          </form>
        </div>

        <!-- Tombol Logout -->
        <div class="logout-wrapper">
          <form action="{{ url('/logout') }}" method="POST" id="logout-form">
            @csrf
            <button type="submit" class="btn-logout" style="border: none; cursor: pointer;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
              </svg>
              <span>Logout</span>
            </button>
          </form>
        </div>

      </div>
    </main>
  </div>

<script src="{{ asset('js/admin-sidebar.js') }}"></script>
</body>
</html>