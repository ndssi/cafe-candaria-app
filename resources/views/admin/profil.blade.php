<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil - Cafe Candaria</title>
  <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,600;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/admin-sidebar-toggle.css') }}">
</head>
<body class="dashboard-body">

  <div class="admin-container">
    <!-- SIDEBAR LEFT -->
    <aside class="sidebar">
      <div class="sidebar-top-content">
        <div class="sidebar-logo-box">
          <img src="{{ asset('images/logo.png') }}" alt="Logo Cafe Candaria" class="sidebar-logo">
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
      </div>

      <!-- LOGOUT DI BAGIAN BAWAH SIDEBAR -->
      <div class="sidebar-bottom-logout">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn-sidebar-logout" title="Logout">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

        <div class="top-right-section">
          <div class="admin-badge">
            <svg class="admin-icon" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
            <span class="admin-text">Admin</span>
          </div>
        </div>
      </header>

      <!-- Content Wrapper -->
      <div class="profil-content-wrapper">
        <div class="main-card">
          {{-- FIX: sebelumnya tidak ada pesan sukses/error sama sekali,
               jadi kalau upload gagal (format/ukuran tidak sesuai) user tidak tahu kenapa. --}}
          @if (session('success'))
            <div style="background:#e6f7e1; color:#2f6b2f; padding:10px 14px; border-radius:8px; margin-bottom:14px; font-size:14px;">
              {{ session('success') }}
            </div>
          @endif
          @if ($errors->any())
            <div style="background:#fdecea; color:#b3261e; padding:10px 14px; border-radius:8px; margin-bottom:14px; font-size:14px;">
              <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <div class="card-title-group">
            <span class="subtitle-kelola">KELOLA</span>
            <h1 class="main-title">PROFIL CAFE</h1>
          </div>

          <!-- Gambar Cafe -->
          <div class="image-container">
          {{-- FIX: sebelumnya gambar ini di-hardcode ke images/candaria 1.png,
               jadi walau upload foto baru berhasil, tampilannya tidak pernah berubah. --}}
          <img src="{{ $profil->gambar ? asset('storage/' . $profil->gambar) : asset('images/candaria 1.png') }}" alt="CAFE CANDARIA">
          </div>

          <!-- Section Judul -->
          <div class="field-section">
            <label class="field-label">JUDUL</label>
            <div class="field-box">
              <span class="field-text">{{ $profil->judul ?? 'CAFE CANDARIA SMKN 2 PURWAKARTA' }}</span>
              <div class="action-icons">
                <a href="{{ route('admin.editprofil') }}" class="icon-btn edit" title="Edit Judul">
                  <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                  </svg>
                </a>
                <form action="{{ route('admin.profil.delete-judul') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus judul?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="icon-btn delete" title="Hapus Judul">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                      <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                    </svg>
                  </button>
                </form>
              </div>
            </div>
          </div>

          <!-- Section Sejarah -->
          <div class="field-section">
            <label class="field-label">SEJARAH</label>
            <div class="field-box align-start">
              <p class="field-text">
                {{ $profil->sejarah ?? 'Cafe Candaria adalah kantin SMKN 2 PURWAKARTA yang di kelola dengan konsep cafe modern. Kami menghadirkan menu makanan dan minuman yang enak, terjangkau, dan nyaman untuk jadi tempat berkumpul siswa maupun guru di sela aktivitas sekolah.' }}
              </p>
              <div class="action-icons">
                <a href="{{ route('admin.editprofil') }}" class="icon-btn edit" title="Edit Sejarah">
                  <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                  </svg>
                </a>
                <form action="{{ route('admin.profil.delete-sejarah') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus sejarah?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="icon-btn delete" title="Hapus Sejarah">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                      <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                    </svg>
                  </button>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </main>
  </div>

<script src="{{ asset('js/admin-sidebar.js') }}"></script>
</body>
</html>