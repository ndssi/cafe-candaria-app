<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Semua Menu - Cafe Candaria</title>
  <!-- Link CSS disesuaikan ke menu.css -->
  <link rel="stylesheet" href="{{ asset('css/detailmenu.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>

  <div class="container">
    <!-- HEADER TITLES -->
    <header class="menu-header">
      <h1 class="main-title">SEMUA MENU</h1>
      <h2 class="sub-title">Cafe Candaria</h2>
    </header>

    <!-- GRID MENU CARDS -->
    {{-- FIX: sebelumnya 6 item di sini di-hardcode langsung di HTML, jadi
         perubahan menu lewat panel admin tidak pernah muncul di halaman ini.
         Sekarang datanya ditarik langsung dari database. --}}
    <main class="menu-grid">
      @forelse ($menus as $item)
        <div class="menu-card">
          <div class="card-img-wrapper">
            <img src="{{ !empty($item->gambar) ? asset('storage/' . $item->gambar) : 'https://picsum.photos/300/200?random=' . $item->id }}" alt="{{ $item->nama_menu }}">
          </div>
          <div class="card-body">
            <span class="category">{{ strtoupper($item->kategori ?? '') }}</span>
            <h3 class="item-name">{{ $item->nama_menu }}</h3>
            <span class="price">Rp {{ $item->harga }}</span>
          </div>
        </div>
      @empty
        <p>Belum ada menu yang ditambahkan.</p>
      @endforelse
    </main>

    <!-- BUTTON KEMBALI -->
    <footer class="menu-footer">
      <a href="{{ route('beranda') }}" class="btn-back">Kembali Ke Beranda</a>
    </footer>
  </div>

</body>
</html>