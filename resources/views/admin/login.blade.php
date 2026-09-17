<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin Panel - Cafe Candaria</title>
  <link rel="stylesheet" href="/css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;0,700;1,600&display=swap" rel="stylesheet">
</head>
<body class="login-body">

  <div class="login-card">
    <!-- Accent Line Orange di atas kartu -->
    <div class="card-top-accent"></div>

    <!-- Logo & Header -->
    <div class="login-header">
      <img src="{{ asset('images/logo.png') }}" style="width: 90px; height: auto; margin-bottom: 15px;">
      <h1 class="brand-title">Cafe Candaria</h1>
      <p class="brand-subtitle">ADMIN PANEL - SMKN 2 PURWAKARTA</p>
    </div>

    @if (session('error'))
      <p style="color:#c0392b; text-align:center; font-weight:600; margin: 0 0 10px;">{{ session('error') }}</p>
    @endif
    @if ($errors->any())
      <p style="color:#c0392b; text-align:center; font-weight:600; margin: 0 0 10px;">{{ $errors->first() }}</p>
    @endif

    <!-- Form Login: kini benar-benar diverifikasi ke database (tbl_user) -->
    <form action="{{ route('admin.login.attempt') }}" method="POST" class="login-form">
      @csrf
      <div class="form-group">
        <label for="username">USERNAME</label>
        <input type="text" id="username" name="username" value="{{ old('username') }}" required autocomplete="off">
      </div>

      <div class="form-group">
        <label for="password">PASSWORD</label>
        <input type="password" id="password" name="password" required>
      </div>

      <div class="button-group">
        <button type="submit" class="btn-masuk">MASUK</button>
      </div>
    </form>

    <a href="{{ route('beranda') }}" class="btn-kembali" aria-label="Kembali ke Beranda" title="Kembali ke Beranda"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Kembali ke Beranda</a>
  </div>

</body>
</html>
