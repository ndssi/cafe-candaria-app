<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Candaria - SMKN 2 Purwakarta</title>
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,600;1,700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS Halaman (file terpisah) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <!-- NAVBAR (EDGE TO EDGE) -->
    <header class="navbar">
        <div class="navbar-wrapper">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" onerror="this.src='images/logo.jpg'" alt="Logo Cafe Candaria">
                <div>
                    <h2>Cafe Candaria</h2>
                    <span>SMKN 2 PURWAKARTA</span>
                </div>
            </div>

            <!-- TOMBOL HAMBURGER (hanya tampil di mobile) -->
            <button class="hamburger-btn" id="hamburgerBtn" onclick="toggleMenu()" aria-label="Buka menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            <nav id="navMenu">
                <ul>
                    <li><a href="#beranda" class="active">BERANDA</a></li>
                    <li><a href="#tentang-kami" class="about-trigger">TENTANG KAMI</a></li>
                    <li><a href="#profil">PROFIL</a></li>
                    <li><a href="#menu">MENU</a></li>
                    <li><a href="#jam-operasional">JAM OPERASIONAL</a></li>
                    <li><a href="#galeri">GALERI</a></li>
                    <li><a href="{{ route('admin.login') }}">LOGIN</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- HERO SECTION (EDGE TO EDGE) -->
    <section class="hero" id="beranda">
        <div class="circle circle-left"></div>
        <div class="circle circle-right"></div>

        <div class="hero-content">
            <p class="sub-title">SMKN 2 PURWAKARTA</p>
            <h1>Halo, Selamat Datang<br>di</h1>
            <h1 class="brand-name">Cafe Candaria</h1>

            <p class="description">
                Tempat nongkrong nyaman dengan menu makanan & minuman pilihan.
                Cek menu, jam buka, dan lokasi kami.
            </p>

            <div class="hero-buttons">
                <a href="#menu" class="btn btn-green">Menu</a>
                <a href="#profil" class="btn btn-outline">Profil</a>
            </div>
            <p class="hero-note">Buka setiap jam operasional kami</p>
        </div>
    </section>

    <!-- SEJARAH / PROFIL SECTION (EDGE TO EDGE) -->
    {{-- FIX: sebelumnya foto, judul, dan teks sejarah di sini di-hardcode,
         jadi perubahan dari Profil admin tidak pernah tampil di sini. --}}
    <section class="history-section" id="profil">
        <div class="container">
            <div class="hero-banner">
                <img src="{{ !empty($profil->gambar) ? asset('storage/' . $profil->gambar) : asset('images/cafe.jpg') }}" alt="Foto Cafe Candaria">
            </div>

            <h2>{{ $profil->judul ?? 'SEJARAH CAFE CANDARIA' }}</h2>
            <p class="history-desc">
                {{ $profil->sejarah ?? 'Cafe Candaria berawal dari kebutuhan siswa dan guru SMKN 2 Purwakarta akan tempat istirahat yang nyaman dengan menu yang enak dan terjangkau. Dari sinilah ide untuk menghadirkan kantin sekolah dengan konsep cafe modern muncul, memadukan pelayanan ramah dengan suasana yang hangat untuk mendukung aktivitas belajar sehari-hari.' }}
            </p>

            <div class="leadership-cards">
                {{-- FIX: sebelumnya cuma 2 pengurus hardcoded tanpa foto (avatar kosong),
                     sekarang dari database lengkap dengan fotonya --}}
                @forelse ($organigrams as $org)
                    <div class="profile-card">
                        @if (!empty($org->foto))
                            <img src="{{ asset('storage/' . $org->foto) }}" alt="{{ $org->nama }}" class="avatar-placeholder avatar-photo">
                        @else
                            <div class="avatar-placeholder"></div>
                        @endif
                        <h3>{{ strtoupper($org->jabatan) }}</h3>
                        <p>{{ $org->nama }}</p>
                    </div>
                @empty
                    <div class="profile-card">
                        <div class="avatar-placeholder"></div>
                        <h3>PEMBINA</h3>
                        <p>Wulan Febrianti, S.Pd</p>
                    </div>
                    <div class="profile-card">
                        <div class="avatar-placeholder"></div>
                        <h3>Ketua</h3>
                        <p>Preti Nurfanjani</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- MENU SECTION (EDGE TO EDGE) -->
    <section class="menu-section" id="menu">
        <div class="container">
            <p class="section-subtitle">MENU UNGGULAN</p>
            <h2 class="section-title">Cafe Candaria</h2>

            <!-- GRID MENU -->
            {{-- FIX: sebelumnya 6 kartu di-hardcode, sekarang ditarik dari database --}}
            <div class="menu-grid" id="menuGrid">
                @forelse ($menus as $item)
                    <div class="menu-card">
                        <div class="menu-img">
                            <img src="{{ !empty($item->gambar) ? asset('storage/' . $item->gambar) : 'https://picsum.photos/300/200?random=' . $item->id }}" alt="{{ $item->nama_menu }}">
                        </div>
                        <span class="category">{{ strtoupper($item->kategori ?? '') }}</span>
                        <h4>{{ $item->nama_menu }}</h4>
                        <p class="price">Rp {{ $item->harga }}</p>
                    </div>
                @empty
                    <p>Menu belum tersedia.</p>
                @endforelse
            </div>

            <!-- KONTROL PAGINATION (Muncul otomatis jika item > 6) -->
            <div class="menu-pagination-controls hidden" id="menuPagination">
                <button class="page-btn" id="prevBtn" onclick="prevPage()">Sebelumnya</button>
                <span class="page-info" id="pageInfo">Halaman 1</span>
                <button class="page-btn" id="nextBtn" onclick="nextPage()">Selanjutnya</button>
            </div>

            <!-- BUTTON LIHAT SEMUA MENU -->
            <div class="more-menu-container">
                <a href="{{ route('detailmenu') }}" class="btn-green-full">Lihat Semua Menu</a>
            </div>
        </div>
    </section>

    <!-- JAM OPERASIONAL & KONTAK (EDGE TO EDGE) -->
    <section class="info-section" id="jam-operasional">
        <div class="container">
            <p class="info-subtitle">KAPAN KAMI BUKA</p>
            <h2 class="info-title">Jam Operasional</h2>

            <div class="info-grid">
                @php
                    $operationalDays = $jam_operasional->pluck('hari')
                        ->map(fn ($day) => strtolower(trim($day)))
                        ->all();
                @endphp
                {{-- FIX: jam operasional sebelumnya hardcoded, sekarang dari database --}}
                @forelse ($jam_operasional as $jo)
                    @if (!in_array(strtolower(trim($jo->hari)), ['sabtu', 'minggu'], true))
                        <div class="info-card">
                            <i class="fa-regular fa-clock info-card-icon"></i>
                            <h4>{{ $jo->hari }}</h4>
                            <p>
                                @if ($jo->jam_buka && $jo->jam_buka !== '-')
                                    {{ $jo->jam_buka }} - {{ $jo->jam_tutup }}
                                @else
                                    <span class="closed-label">Tutup</span>
                                @endif
                            </p>
                        </div>
                    @endif
                @empty
                    <div class="info-card">
                        <h4>Senin - Jumat</h4>
                        <p>08.00 - 14.00</p>
                    </div>
                @endforelse
                @if (!in_array('sabtu - minggu', $operationalDays, true))
                    <div class="info-card">
                        <i class="fa-regular fa-clock info-card-icon"></i>
                        <h4>Sabtu - Minggu</h4>
                        <p><span class="closed-label">Tutup</span></p>
                    </div>
                @endif
                <div class="info-card">
                        <i class="fa-solid fa-location-dot info-card-icon"></i>
                    <h4>ALAMAT</h4>
                    <p>Jalan Jenderal A. Yani Nomor 98, Nagri Tengah, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114</p>
                </div>
                <div class="info-card">
                        <i class="fa-brands fa-whatsapp info-card-icon"></i>
                    <h4>Kontak</h4>
                    <a href="https://wa.me/" target="_blank" class="whatsapp-link">
                        <i class="fa-brands fa-whatsapp"></i> Chat via Whatsapp
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- GALERI SECTION (EDGE TO EDGE) -->
    <section class="gallery-section" id="galeri">
        <div class="container">
            <p class="gallery-subtitle">MOMEN DI CAFE CANDARIA</p>
            <h2 class="gallery-title">Galeri Candaria</h2>
            <p class="gallery-desc">Kumpulan suasana Cafe Candaria - dari sudut 
duduk santai sampai keseruan jam istirahat sekolah</p>

            <div class="gallery-grid">
                {{-- FIX: sebelumnya 4 foto hardcoded, sekarang dari database --}}
                @forelse ($galleries as $g)
                    <div class="gallery-item">
                        <img src="{{ $g->gambar ? asset('storage/' . $g->gambar) : 'https://picsum.photos/300/200?random=' . $g->id }}" alt="{{ $g->keterangan ?? 'Foto Galeri' }}">
                    </div>
                @empty
                    <div class="gallery-item"><img src="{{ asset('images/cafe.jpg') }}" alt="Foto Galeri 1"></div>
                    <div class="gallery-item"><img src="{{ asset('images/TEH JUS.jpg') }}" alt="Foto Galeri 2"></div>
                    <div class="gallery-item"><img src="{{ asset('images/DIMSUM.jpg') }}" alt="Foto Galeri 3"></div>
                    <div class="gallery-item"><img src="{{ asset('images/DONAT.jpg') }}" alt="Foto Galeri 4"></div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- FOOTER (EDGE TO EDGE) -->
    <footer>
        <div class="container footer-content">
            <h3>Cafe Candaria</h3>
            <p>SMKN 2 PURWAKARTA</p>
            <a href="#tentang-kami" class="footer-about-link about-trigger">Tentang Kami</a>
            <div class="copyright">
                &copy; 2026 Cafe Candaria. All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- MODAL TENTANG KAMI -->
    <div class="about-modal" id="aboutModal" aria-hidden="true">
        <div class="about-modal-backdrop about-close"></div>
        <section class="about-modal-card" role="dialog" aria-modal="true" aria-labelledby="aboutModalTitle">
            <button class="about-modal-close about-close" type="button" aria-label="Tutup Tentang Kami">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="about-modal-icon"><i class="fa-solid fa-mug-hot"></i></div>
            <p class="section-subtitle">TENTANG KAMI</p>
            <h2 id="aboutModalTitle">Cafe Candaria</h2>
            <p class="about-modal-text">
                Cafe Candaria adalah cafe di lingkungan SMKN 2 Purwakarta yang hadir sebagai tempat
                istirahat nyaman dengan pilihan makanan dan minuman yang enak serta terjangkau.
            </p>
            <p class="about-modal-text">
                Website ini dibuat sebagai media profil dan katalog untuk menampilkan menu, jam operasional,
                struktur pengurus, serta galeri suasana Cafe Candaria.
            </p>
            <div class="about-modal-usage">
                <h3>Cara Menggunakan Website</h3>
                <ul class="about-modal-usage-list">
                    <li>Pilih menu untuk pindah ke halaman yang diinginkan.</li>
                    <li>Scroll halaman untuk melihat profil, menu, galeri, dan jam operasional.</li>
                    <li>Klik <strong>Lihat Semua Menu</strong> untuk melihat daftar menu lengkap.</li>
                </ul>
            </div>
            <div class="about-modal-facts">
                <div>
                    <i class="fa-solid fa-code"></i>
                    <span>Dibuat oleh</span>
                    <strong>Desi Nur Lestari</strong>
                </div>
                <div>
                    <i class="fa-regular fa-calendar"></i>
                    <span>Tahun pembuatan</span>
                    <strong>2026</strong>
                </div>
            </div>
        </section>
    </div>

    <!-- JAVASCRIPT UNTUK TOGGLE NAVBAR MOBILE -->
    <script>
        const navbar = document.querySelector('.navbar');
        const navLinks = document.querySelectorAll('#navMenu a[href^="#"]');

        function toggleMenu() {
            document.getElementById('navMenu').classList.toggle('open');
        }

        function setActiveNavLink(id) {
            navLinks.forEach(link => {
                const isActive = link.getAttribute('href') === '#' + id;
                link.classList.toggle('active', isActive);
                if (isActive) {
                    link.setAttribute('aria-current', 'page');
                } else {
                    link.removeAttribute('aria-current');
                }
            });
        }

        if (navbar) {
            const updateNavbarState = () => {
                const isScrolled = window.scrollY > 10;
                navbar.classList.toggle('scrolled', isScrolled);
            };

            updateNavbarState();
            window.addEventListener('scroll', updateNavbarState);
        }

        const sections = document.querySelectorAll('section[id]');

        if (sections.length) {
            const observer = new IntersectionObserver((entries) => {
                const visibleEntries = entries
                    .filter(entry => entry.isIntersecting)
                    .sort((a, b) => b.intersectionRatio - a.intersectionRatio);

                if (visibleEntries.length) {
                    setActiveNavLink(visibleEntries[0].target.id);
                }
            }, {
                root: null,
                threshold: [0.25, 0.5, 0.75],
                rootMargin: '-10% 0px -30% 0px'
            });

            sections.forEach(section => observer.observe(section));
        }

        const aboutModal = document.getElementById('aboutModal');

        function openAboutModal(event) {
            event.preventDefault();
            aboutModal.classList.add('is-visible');
            aboutModal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('modal-open');
        }

        function closeAboutModal() {
            aboutModal.classList.remove('is-visible');
            aboutModal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('modal-open');
        }

        document.querySelectorAll('.about-trigger').forEach(trigger => {
            trigger.addEventListener('click', openAboutModal);
        });

        document.querySelectorAll('.about-close').forEach(closeButton => {
            closeButton.addEventListener('click', closeAboutModal);
        });

        document.addEventListener('keydown', event => {
            if (event.key === 'Escape' && aboutModal.classList.contains('is-visible')) {
                closeAboutModal();
            }
        });
    </script>

    <!-- JAVASCRIPT UNTUK PAGINASI MENU (> 6 ITEMS) -->
    <script>
        const ITEMS_PER_PAGE = 6;
        let currentPage = 1;
        const menuCards = document.querySelectorAll('#menuGrid .menu-card');
        const totalItems = menuCards.length;
        const totalPages = Math.ceil(totalItems / ITEMS_PER_PAGE);

        function updateMenuDisplay() {
            if (totalItems <= ITEMS_PER_PAGE) {
                document.getElementById('menuPagination').classList.add('hidden');
                menuCards.forEach(card => card.style.display = 'block');
                return;
            }

            document.getElementById('menuPagination').classList.remove('hidden');

            const start = (currentPage - 1) * ITEMS_PER_PAGE;
            const end = start + ITEMS_PER_PAGE;

            menuCards.forEach((card, index) => {
                if (index >= start && index < end) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('pageInfo').innerText = `Halaman ${currentPage} dari ${totalPages}`;
            document.getElementById('prevBtn').disabled = (currentPage === 1);
            document.getElementById('nextBtn').disabled = (currentPage === totalPages);
        }

        function nextPage() {
            if (currentPage < totalPages) {
                currentPage++;
                updateMenuDisplay();
            }
        }

        function prevPage() {
            if (currentPage > 1) {
                currentPage--;
                updateMenuDisplay();
            }
        }

        document.addEventListener('DOMContentLoaded', updateMenuDisplay);
    </script>
</body>

</html>