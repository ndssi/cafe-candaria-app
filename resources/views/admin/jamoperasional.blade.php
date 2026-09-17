<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Jam Operasional - Cafe Candaria</title>
  <link rel="stylesheet" href="{{ asset('css/jamoperasional.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,600;1,700;1,800&display=swap" rel="stylesheet">
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

      <!-- KELOLA JAM OPERASIONAL CONTAINER -->
      <div class="table-content-wrapper">
        <div class="table-card">
          <!-- CARD HEADER -->
          <div class="card-header-titles">
            <span class="card-subtitle-top">KELOLA</span>
            <h2 class="card-main-title">JAM OPERASIONAL</h2>
          </div>

          <!-- TABLE DATA -->
          <div class="table-responsive">
            <table class="data-table">
              <thead>
                <tr>
                  <th class="col-no">NO</th>
                  <th class="col-hari">HARI</th>
                  <th class="col-buka">JAM BUKA</th>
                  <th class="col-tutup">JAM TUTUP</th>
                  <th class="col-aksi">AKSI</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($jam_operasional ?? [] as $index => $item)
                  <tr>
                    <td class="col-no">{{ $index + 1 }}</td>
                    <td class="col-hari">{{ $item->hari }}</td>
                    <td class="col-buka">{{ $item->jam_buka ?? '-' }}</td>
                    <td class="col-tutup">{{ $item->jam_tutup ?? '-' }}</td>
                    <td class="col-aksi">
                      <div class="action-buttons">
                        <a href="{{ route('admin.jam-operasional.edit', $item->id) }}" class="btn-action edit-btn" title="Edit">
                          <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                          </svg>
                        </a>
                        <a href="{{ route('admin.jam-operasional.delete', $item->id) }}" class="btn-action delete-btn" title="Hapus">
                          <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                          </svg>
                        </a>
                      </div>
                    </td>
                  </tr>
                @empty
                  <!-- STATIC DATA (PERSIS SESUAI DESAIN) -->
                  <tr>
                    <td class="col-no">1</td>
                    <td class="col-hari">Senin - Jumat</td>
                    <td class="col-buka">07.00</td>
                    <td class="col-tutup">14.00</td>
                    <td class="col-aksi">
                      <div class="action-buttons">
                        <a href="{{ route('admin.jam-operasional.edit', 1) }}" class="btn-action edit-btn" title="Edit">
                          <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                          </svg>
                        </a>
                        <a href="{{ route('admin.jam-operasional.delete', 1) }}" class="btn-action delete-btn" title="Hapus">
                          <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                          </svg>
                        </a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="col-no">2</td>
                    <td class="col-hari">Sabtu</td>
                    <td class="col-buka">-</td>
                    <td class="col-tutup">-</td>
                    <td class="col-aksi">
                      <div class="action-buttons">
                        <a href="{{ route('admin.jam-operasional.edit', 2) }}" class="btn-action edit-btn" title="Edit">
                          <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                          </svg>
                        </a>
                        <a href="{{ route('admin.jam-operasional.delete', 2) }}" class="btn-action delete-btn" title="Hapus">
                          <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                          </svg>
                        </a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="col-no">3</td>
                    <td class="col-hari">Minggu</td>
                    <td class="col-buka">-</td>
                    <td class="col-tutup">-</td>
                    <td class="col-aksi">
                      <div class="action-buttons">
                        <a href="{{ route('admin.jam-operasional.edit', 3) }}" class="btn-action edit-btn" title="Edit">
                          <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                          </svg>
                        </a>
                        <a href="{{ route('admin.jam-operasional.delete', 3) }}" class="btn-action delete-btn" title="Hapus">
                          <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                          </svg>
                        </a>
                      </div>
                    </td>
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

