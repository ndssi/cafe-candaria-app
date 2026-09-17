<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Organigram - Cafe Candaria</title>
  <link rel="stylesheet" href="{{ asset('css/organigram.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,600;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/admin-sidebar-toggle.css') }}">
</head>
<body class="dashboard-body">

  <div class="admin-container">
    <!-- SIDEBAR LEFT -->
    <aside class="sidebar">
      <div class="sidebar-top-content">
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
            <a href="{{ route('admin.profil') }}" class="nav-item">Profil</a>
            <a href="{{ route('admin.organigram') }}" class="nav-item active">Organigram</a>
            <a href="{{ route('admin.menu') }}" class="nav-item">Menu</a>
            <a href="{{ route('admin.jam-operasional') }}" class="nav-item">Jam Operasional</a>
            <a href="{{ route('admin.galeri') }}" class="nav-item">Galeri</a>
          </nav>
        </div>
      </div>

      <!-- LOGOUT DI BAWAH SIDEBAR -->
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

      <!-- Content Wrapper / Card Organigram -->
      <div class="organigram-content-wrapper">
        <div class="main-card">
          
          <div class="card-header-flex">
            <div class="card-title-group">
              <span class="subtitle-kelola">KELOLA</span>
              <h1 class="main-title">ORGANIGRAM</h1>
            </div>

            <!-- Tombol Tambah Pengurus -->
            <a href="{{ route('admin.organigram.tambah') }}" class="btn-tambah-pengurus">
              + Tambah Pengurus
            </a>
          </div>

          @if (session('success'))
            <div style="background:#e6f7e1; color:#2f6b2f; padding:10px 14px; border-radius:8px; margin-bottom:14px; font-size:14px;">
              {{ session('success') }}
            </div>
          @endif

          <!-- Tabel Organigram -->
          <div class="table-responsive">
            <table class="organigram-table">
              <thead>
                <tr>
                  <th class="col-no">NO</th>
                  <th class="col-foto">FOTO</th>
                  <th class="col-nama">NAMA</th>
                  <th class="col-jabatan">JABATAN</th>
                  <th class="col-aksi">AKSI</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($organigrams as $index => $item)
                  <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                      @if (!empty($item->foto))
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" style="width:45px; height:45px; object-fit:cover; border-radius:50%;">
                      @else
                        <span style="color:#aaa; font-size:12px;">-</span>
                      @endif
                    </td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jabatan }}</td>
                    <td>
                      <div class="action-buttons">
                        <a href="{{ route('admin.organigram.edit', $item->id) }}" class="btn-icon edit" title="Edit">
                          <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                          </svg>
                        </a>
                        <a href="{{ route('admin.organigram.hapus', $item->id) }}" class="btn-icon delete" title="Hapus">
                          <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                          </svg>
                        </a>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center">Belum ada data pengurus.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </main>
  </div>

<script src="{{ asset('js/admin-sidebar.js') }}"></script>
</body>
</html>