<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Jam Operasional - Cafe Candaria</title>
  <link rel="stylesheet" href="{{ asset('css/tambahorganigram.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,600;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/admin-sidebar-toggle.css') }}">
</head>
<body class="dashboard-body">

  <div class="admin-container">
    <!-- SIDEBAR LEFT -->
    <aside class="sidebar">
      <div class="sidebar-top-content">
        <!-- LOGO BOX -->
        <div class="sidebar-logo-box">
          <img src="{{ asset('images/logo.png') }}" alt="Logo SMKN 2 Purwakarta" class="sidebar-logo">
          <div class="logo-text">
            <span class="brand-title-sidebar">Cafe Candaria</span>
            <span class="brand-sub-sidebar">SMKN 2 PURWAKARTA</span>
          </div>
        </div>

        <!-- MENU NAVIGATION -->
        <div class="sidebar-menu-wrapper">
          <h3 class="sidebar-section-title">MENU ADMIN</h3>
          <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="nav-item">Dashboard</a>
            <a href="{{ route('admin.profil') }}" class="nav-item">Profil</a>
            <a href="{{ route('admin.organigram') }}" class="nav-item">Organigram</a>
            <a href="{{ route('admin.menu') }}" class="nav-item">Menu</a>
            <a href="{{ route('admin.jam-operasional') }}" class="nav-item active">Jam Operasional</a>
            <a href="{{ route('admin.galeri') }}" class="nav-item">Galeri</a>
          </nav>
        </div>
      </div>

      <!-- LOGOUT BUTTON -->
      <div class="sidebar-bottom-logout">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn-sidebar-logout">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
              <polyline points="16 17 21 12 16 7"></polyline>
              <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
            <span>Logout</span>
          </button>
        </form>
      </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
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
            <svg class="admin-icon" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
            <span class="admin-text">Admin</span>
          </div>
        </div>
      </header>

      <!-- FORM EDIT DATA CARD -->
      <div class="form-content-wrapper">
        <div class="form-card">
          <div class="form-header">
            <h2 class="form-title">Edit Jam Operasional</h2>
            <p class="form-subtitle">Perbaharui jadwal buka dan tutup di bawah ini</p>
          </div>

          <form action="{{ route('admin.jam-operasional.update', $id ?? '') }}" method="POST" class="add-data-form">
            @csrf
            @method('PUT')
            
            <div class="form-group">
              <label for="hari" class="form-label">Hari</label>
              <input type="text" id="hari" name="hari" class="form-control" value="{{ $item->hari ?? ($id == 1 ? 'Senin - Jumat' : ($id == 2 ? 'Sabtu' : ($id == 3 ? 'Minggu' : ''))) }}" required>
            </div>

            <div class="form-group">
              <label for="jam_buka" class="form-label">Jam Buka</label>
              <input type="text" id="jam_buka" name="jam_buka" class="form-control" value="{{ $item->jam_buka ?? ($id == 1 ? '07.00' : '-') }}" required>
            </div>

            <div class="form-group">
              <label for="jam_tutup" class="form-label">Jam Tutup</label>
              <input type="text" id="jam_tutup" name="jam_tutup" class="form-control" value="{{ $item->jam_tutup ?? ($id == 1 ? '14.00' : '-') }}" required>
            </div>

            <div class="form-actions">
              <a href="{{ route('admin.jam-operasional') }}" class="btn-cancel">Batal</a>
              <button type="submit" class="btn-submit">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>

<script src="{{ asset('js/admin-sidebar.js') }}"></script>
</body>
</html>

