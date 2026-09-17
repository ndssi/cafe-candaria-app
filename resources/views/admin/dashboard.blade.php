<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin - Cafe Candaria</title>
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,600;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/admin-sidebar-toggle.css') }}">
</head>
<body class="dashboard-body">

  <div class="admin-container">
    <!-- SIDEBAR LEFT -->
    <aside class="sidebar">
      <div class="sidebar-top-content">
        <!-- Logo Box Header -->
        <div class="sidebar-logo-box">
          <img src="{{ asset('images/logo.png') }}" alt="Logo SMKN 2 Purwakarta" class="sidebar-logo" onerror="this.src='https://via.placeholder.com/35x40?text=LOGO'">
          <div class="logo-text">
            <span class="brand-title-sidebar">Cafe Candaria</span>
            <span class="brand-sub-sidebar">SMKN 2 PURWAKARTA</span>
          </div>
        </div>

        <!-- Menu Section -->
        <div class="sidebar-menu-wrapper">
          <h3 class="sidebar-section-title">MENU ADMIN</h3>
          <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="nav-item active">Dashboard</a>
            <a href="{{ route('admin.profil') }}" class="nav-item">Profil</a>
            <a href="{{ route('admin.organigram') }}" class="nav-item">Organigram</a>
            <a href="{{ route('admin.menu') }}" class="nav-item">Menu</a>
            <a href="{{ route('admin.jam-operasional') }}" class="nav-item">Jam Operasional</a>
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

      <!-- Welcome Banner Text -->
      <div class="welcome-section">
        <h1 class="welcome-title">Halo, Admin!</h1>
        <p class="welcome-subtitle">Kelola informasi website Cafe Candaria dari sini.</p>
      </div>

      <!-- Card Panel Container -->
      <div class="dashboard-panel">
        <div class="cards-grid">
          
          <!-- Card 1: Profil -->
          <div class="dash-card">
            <h2 class="card-title">Profil</h2>
            <p class="card-desc">Kelola data profil Cafe Candaria</p>
            <a href="{{ route('admin.profil') }}" class="btn-kelola">Kelola</a>
          </div>

          <!-- Card 2: Organigram -->
          <div class="dash-card">
            <h2 class="card-title">Organigram</h2>
            <p class="card-desc">{{ $totalOrganigram ?? 0 }} pengurus terdaftar</p>
            <a href="{{ route('admin.organigram') }}" class="btn-kelola">Kelola</a>
          </div>

          <!-- Card 3: Menu -->
          <div class="dash-card">
            <h2 class="card-title">Menu</h2>
            <p class="card-desc">{{ $totalMenu ?? 0 }} item menu tersedia</p>
            <a href="{{ route('admin.menu') }}" class="btn-kelola">Kelola</a>
          </div>

          <!-- Card 4: Jam Operasional -->
          <div class="dash-card">
            <h2 class="card-title">Jam Operasional</h2>
            <p class="card-desc">Kelola jadwal buka Cafe Candaria</p>
            <a href="{{ route('admin.jam-operasional') }}" class="btn-kelola">Kelola</a>
          </div>

          <!-- Card 5: Galeri -->
          <div class="dash-card">
            <h2 class="card-title">Galeri</h2>
            <p class="card-desc">{{ $totalGaleri ?? 0 }} foto tersimpan</p>
            <a href="{{ route('admin.galeri') }}" class="btn-kelola">Kelola</a>
          </div>

        </div>

      </div>
    </main>
  </div>

<script src="{{ asset('js/admin-sidebar.js') }}"></script>
</body>
</html>