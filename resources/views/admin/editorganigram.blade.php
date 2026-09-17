<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Pengurus - Cafe Candaria</title>
  <link rel="stylesheet" href="{{ asset('css/editorganigram.css') }}">
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
          <img src="{{ asset('images/logo.png') }}" alt="Logophp SMKN 2 Purwakarta" class="sidebar-logo">
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
            <a href="{{ route('admin.organigram') }}" class="nav-item active">Organigram</a>
            <a href="{{ route('admin.menu') }}" class="nav-item">Menu</a>
            <a href="{{ route('admin.jam-operasional') }}" class="nav-item">Jam Operasional</a>
            <a href="{{ route('admin.galeri') }}" class="nav-item">Galeri</a>
          </nav>
        </div>
      </div>

      <!-- LOGOUT BUTTON (BOTTOM) -->
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

      <!-- EDIT CARD FORM -->
      <div class="edit-content-wrapper">
        <div class="edit-card">
          <h2 class="edit-title">Edit Pengurus</h2>
          <p class="edit-description">Perbaharui data pengurus di bawah ini</p>

          @if ($errors->any())
            <div style="background:#fdecea; color:#b3261e; padding:10px 14px; border-radius:8px; margin-bottom:14px; font-size:14px;">
              <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('admin.organigram.update', $id ?? '') }}" method="POST" class="edit-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Input Nama -->
            <div class="form-group">
              <label for="nama">Nama</label>
              {{-- FIX: sebelumnya value tidak diisi, jadi field ini selalu kosong saat diedit --}}
              <input type="text" id="nama" name="nama" class="form-input" autocomplete="off" value="{{ $organigram->nama ?? '' }}">
            </div>

            <!-- Input Jabatan -->
            <div class="form-group">
              <label for="jabatan">Jabatan</label>
              <input type="text" id="jabatan" name="jabatan" class="form-input" autocomplete="off" value="{{ $organigram->jabatan ?? '' }}">
            </div>

            <!-- Input Foto -->
            <div class="form-group">
              <label for="foto">Foto Pengurus</label>
              @if (!empty($organigram->foto))
                <div style="margin-bottom:8px;">
                  <img src="{{ asset('storage/' . $organigram->foto) }}" alt="{{ $organigram->nama }}" style="width:70px; height:70px; object-fit:cover; border-radius:50%; border:1px solid #ddd;">
                </div>
              @endif
              <input type="file" id="foto" name="foto" class="form-input" accept="image/*">
              <small style="color:#777;">Kosongkan kalau tidak ingin mengganti foto.</small>
            </div>

            <!-- Action Buttons -->
            <div class="form-actions">
              <a href="{{ route('admin.organigram') }}" class="btn-cancel">Batal</a>
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