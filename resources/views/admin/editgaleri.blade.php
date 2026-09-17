<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Galeri - Cafe Candaria</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/editgaleri.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin-sidebar-toggle.css') }}">
</head>
<body>

<div class="dashboard-container">
    <aside class="sidebar">
        <div>
            <div class="brand-logo-container">
                <div class="brand-badge">
                    <img src="{{ asset('images/logo-smk.png') }}" alt="Logo" onerror="this.src='https://via.placeholder.com/35x40?text=LOGO'">
                    <div class="brand-text">
                        <h1>Cafe Candaria</h1>
                        <p>SMKN 2 PURWAKARTA</p>
                    </div>
                </div>
            </div>

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

        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <button class="toggle-btn">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="admin-pill">
                <i class="fa-solid fa-user"></i>
                <span>Admin</span>
            </div>
        </header>

        <div class="edit-card">
            <div class="edit-header">
                <h2>Edit Galeri</h2>
                <p>Perbaharui galeri di bawah ini</p>
            </div>

            @if ($errors->any())
                <div style="color:#b3261e; margin-bottom:12px;">
                    <ul style="margin:0; padding-left:18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.galeri.update', $id ?? ($galeri->id ?? '')) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="keterangan">Judul Galeri</label>
                    <input type="text" id="keterangan" name="keterangan" class="form-input-text" value="{{ $galeri->keterangan ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="gambar">Foto Galeri</label>
                    <div class="file-input-wrapper">
                        <input type="file" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
                    </div>
                </div>

                <div class="preview-box">
                    <i id="placeholderIcon" class="fa-regular fa-image" style="font-size: 26px; color: #4a7c59;"></i>
                    <img id="imagePreview" src="" alt="Preview" style="display: none;">
                </div>

                <div class="form-actions">
                    <!-- Kembali ke galeri.blade.php -->
                    <a href="{{ route('admin.galeri') }}" class="btn-batal">Batal</a>
                    <button type="submit" class="btn-simpan">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');
        const icon = document.getElementById('placeholderIcon');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                if (icon) icon.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script src="{{ asset('js/admin-sidebar.js') }}"></script>
</body>
</html>