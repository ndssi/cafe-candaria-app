<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Cafe Candaria</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,600;1,700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="about-page">
    <header class="navbar">
        <div class="navbar-wrapper">
            <a href="{{ route('beranda') }}" class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Cafe Candaria">
                <div>
                    <h2>Cafe Candaria</h2>
                    <span>SMKN 2 PURWAKARTA</span>
                </div>
            </a>
            <nav class="about-nav">
                <ul>
                    <li><a href="{{ route('beranda') }}">BERANDA</a></li>
                    <li><a href="{{ route('detailmenu') }}">MENU</a></li>
                    <li><a href="{{ route('admin.login') }}">LOGIN</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="about-hero">
            <div class="container">
                <p class="section-subtitle">TENTANG KAMI</p>
                <h1>Mengenal Cafe Candaria</h1>
                <p>Cerita singkat tentang cafe dan website profil Cafe Candaria di SMKN 2 Purwakarta.</p>
            </div>
        </section>

        <section class="about-page-content">
            <div class="container">
                <div class="about-story">
                    <p class="section-subtitle">TENTANG CAFE</p>
                    <h2>Cafe Candaria</h2>
                    <p>
                        Cafe Candaria merupakan cafe yang berada di lingkungan SMKN 2 Purwakarta.
                        Website ini dibuat sebagai media profil dan katalog agar pengunjung dapat mengenal
                        cafe, melihat menu makanan dan minuman, serta memperoleh informasi jam operasional.
                    </p>
                    <p>
                        Selain menu dan jadwal, website ini menampilkan struktur pengurus dan galeri foto
                        untuk memperkenalkan suasana serta aktivitas di Cafe Candaria.
                    </p>
                </div>

                <div class="about-facts">
                    <article class="about-fact-card">
                        <i class="fa-solid fa-code"></i>
                        <span>Dibuat Oleh</span>
                        <h3>Tim Pengembang<br>Website Cafe Candaria</h3>
                    </article>
                    <article class="about-fact-card">
                        <i class="fa-regular fa-calendar"></i>
                        <span>Tahun Pembuatan</span>
                        <h3>2026</h3>
                    </article>
                    <article class="about-fact-card">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Lokasi Cafe</span>
                        <h3>SMKN 2<br>Purwakarta</h3>
                    </article>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <h3>Cafe Candaria</h3>
            <p>SMKN 2 PURWAKARTA</p>
            <div class="copyright">
                &copy; 2026 Cafe Candaria. All Rights Reserved.
            </div>
        </div>
    </footer>
</body>

</html>
