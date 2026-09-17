// FIX: tombol hamburger sebelumnya cuma dekorasi (tidak ada JS sama sekali),
// jadi klik-klik tidak terjadi apa-apa. Sekarang benar-benar toggle sidebar.
document.addEventListener('DOMContentLoaded', function () {
    var toggleBtn = document.querySelector('.hamburger-btn, .toggle-btn');
    var sidebar = document.querySelector('.sidebar');

    if (!toggleBtn || !sidebar) return;

    toggleBtn.addEventListener('click', function () {
        sidebar.classList.toggle('sidebar-hidden');
    });
});
