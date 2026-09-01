<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bantuan — Loka</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --asphalt: #201F1D;
    --asphalt-2: #2C2B28;
    --concrete: #ECEAE4;
    --white-line: #FAFAF7;
    --yellow: #F4C21D;
    --ink: #201F1D;
    --muted: #706E68;
    --line: #D9D6CC;
  }
  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}
  body{ font-family:'Inter', sans-serif; color:var(--ink); background:var(--concrete); }
  h1,h2,h3,.disp{ font-family:'Oswald', sans-serif; text-transform:uppercase; letter-spacing:0.01em; }
  a{ color:inherit; }
  .container{ max-width:1180px; margin:0 auto; padding:0 32px; }

  /* NAV */
  nav{
    display:flex; align-items:center; justify-content:space-between;
    padding:26px 32px; max-width:1180px; margin:0 auto;
  }
  .logo{
    font-family:'Oswald', sans-serif; font-size:22px; font-weight:700;
    text-transform:uppercase; letter-spacing:0.02em;
    display:flex; align-items:center; gap:8px;
    text-decoration:none; color:var(--ink);
  }
  .logo .dot{ width:9px;height:9px;background:var(--yellow); display:inline-block; }
  .navlinks{ display:flex; gap:36px; font-size:14.5px; font-weight:500; color:var(--muted); }
  .navlinks a{ text-decoration:none; }
  .navlinks a:hover, .navlinks a.active{ color:var(--ink); }
  .nav-right{ display:flex; align-items:center; gap:14px; }
  .nav-home{
    font-size:14px; font-weight:600; color:var(--ink);
    text-decoration:none; border-bottom:1.5px solid var(--yellow); padding-bottom:2px;
  }
  .nav-cta{
    background:var(--asphalt); color:var(--white-line);
    padding:11px 22px; font-size:14px; font-weight:600;
    border-radius:2px; text-decoration:none;
  }
  @media (max-width:820px){ .navlinks{ display:none; } }

  /* HERO */
  .page-hero{
    background:var(--asphalt); color:var(--white-line);
    padding:64px 32px 56px; text-align:center;
  }
  .page-hero .eyebrow{
    font-family:'Oswald', sans-serif; font-size:13px; color:var(--yellow);
    font-weight:500; letter-spacing:0.03em; margin:0 0 14px;
  }
  .page-hero h1{
    font-size:clamp(30px, 3.8vw, 46px); font-weight:600; line-height:1.1;
    margin:0 0 30px;
  }
  .search-bar{
    background:var(--white-line); border-radius:3px; padding:8px;
    display:flex; gap:8px; max-width:520px; margin:0 auto;
  }
  .search-bar input{
    flex:1; border:none; background:transparent; padding:12px 14px;
    font-size:15px; font-family:'Inter', sans-serif; color:var(--ink); outline:none;
  }
  .search-bar button{
    background:var(--yellow); color:var(--asphalt); border:none;
    font-family:'Oswald', sans-serif; text-transform:uppercase; font-weight:600;
    letter-spacing:0.02em; font-size:14px; padding:0 24px; border-radius:2px; cursor:pointer;
  }
  .search-bar button:hover{ background:#FFD84D; }

  /* CATEGORIES */
  .cat-section{ padding:88px 32px 64px; }
  .section-head{ max-width:560px; margin:0 0 48px; }
  .section-head.center{ margin-left:auto; margin-right:auto; text-align:center; }
  .section-head .eyebrow{
    font-family:'Oswald', sans-serif; font-size:13px; color:var(--muted);
    font-weight:500; letter-spacing:0.02em; margin:0 0 10px;
  }
  .section-head h2{ font-size:30px; font-weight:600; margin:0; }

  .cat-grid{
    display:grid; grid-template-columns:repeat(4, 1fr); gap:1px;
    background:var(--line); border:1px solid var(--line);
  }
  .cat{
    background:var(--concrete); padding:32px 26px;
    text-decoration:none; color:var(--ink);
  }
  .cat:hover{ background:var(--white-line); }
  .cat .icon{
    width:36px; height:36px; margin-bottom:20px;
  }
  .cat .icon svg{ width:100%; height:100%; }
  .cat .icon path, .cat .icon circle, .cat .icon rect, .cat .icon line{
    fill:none; stroke:var(--asphalt); stroke-width:2; stroke-linecap:round; stroke-linejoin:round;
  }
  .cat h3{ font-size:16px; font-weight:600; margin:0 0 8px; }
  .cat p{
    text-transform:none; font-family:'Inter', sans-serif;
    font-size:13.5px; color:var(--muted); margin:0; line-height:1.5;
  }
  @media (max-width:820px){ .cat-grid{ grid-template-columns:repeat(2, 1fr); } }
  @media (max-width:520px){ .cat-grid{ grid-template-columns:1fr; } }

  /* FAQ */
  .faq{ padding:64px 32px 96px; }
  .faq-list{ border-top:1px solid var(--line); max-width:760px; margin:0 auto; }
  .faq-item{ border-bottom:1px solid var(--line); }
  .faq-item summary{
    padding:22px 0; font-family:'Oswald', sans-serif; font-size:16px; font-weight:500;
    text-transform:none; cursor:pointer;
    display:flex; justify-content:space-between; align-items:center; list-style:none;
  }
  .faq-item summary::-webkit-details-marker{ display:none; }
  .faq-item summary::after{
    content:"+"; font-size:20px; color:var(--muted);
    font-family:'Inter', sans-serif; transition:transform .18s ease;
  }
  .faq-item[open] summary::after{ content:"–"; }
  .faq-item p{
    text-transform:none; font-family:'Inter', sans-serif; font-size:14.5px;
    line-height:1.65; color:var(--muted); margin:0 0 24px; max-width:640px;
  }

  /* CONTACT */
  .contact{ background:var(--asphalt-2); color:var(--white-line); padding:88px 32px; }
  .contact .section-head .eyebrow{ color:#A9A79F; }
  .contact .section-head h2{ color:var(--white-line); }
  .contact-grid{
    display:grid; grid-template-columns:repeat(3, 1fr); border-top:1px solid #4A4944;
  }
  .contact-item{ padding:32px 28px 0 0; border-right:1px solid #4A4944; }
  .contact-item:last-child{ border-right:none; }
  .contact-item h3{ font-size:18px; font-weight:600; margin:0 0 10px; }
  .contact-item p{
    text-transform:none; font-family:'Inter', sans-serif; font-size:14px;
    line-height:1.6; color:#A9A79F; margin:0 0 16px; max-width:280px;
  }
  .contact-item .cta-link{
    font-family:'Oswald', sans-serif; font-size:13px; text-transform:uppercase;
    letter-spacing:0.02em; font-weight:600; color:var(--yellow);
    text-decoration:none; border-bottom:1.5px solid var(--yellow); padding-bottom:2px;
  }
  @media (max-width:760px){
    .contact-grid{ grid-template-columns:1fr; }
    .contact-item{ border-right:none; border-bottom:1px solid #4A4944; padding-bottom:32px; }
  }

  footer{ background:var(--asphalt); color:#A9A79F; padding:44px 32px; font-size:13.5px; }
  .footer-inner{
    max-width:1180px; margin:0 auto; display:flex;
    justify-content:space-between; flex-wrap:wrap; gap:16px;
  }
</style>
</head>
<body>
    <nav>
  <div class="logo"><span class="dot"></span>bantuan</div>
  <div class="navlinks">
    <a href="/cara_kerja">Cara kerja</a>
    <a href="/lokasi">Lokasi</a>
    <a href="/pengelola">Untuk pengelola</a>
    <a href="/bantuan" class="active">Bantuan</a>
  </div>
  <div class="nav-right">
    <a href="/dasboard" class="nav-home">Halaman utama</a>
    <a href="/" class="nav-cta">Masuk</a>
  </div>
</nav>

<section class="page-hero">
  <p class="eyebrow">Bantuan</p>
  <h1>Ada yang bisa kami bantu?</h1>
  <div class="search-bar">
    <input type="text" placeholder="Cari topik, mis. batalkan reservasi">
    <button type="button">Cari</button>
  </div>
</section>

<section class="cat-section container">
  <div class="section-head center">
    <p class="eyebrow">Topik populer</p>
    <h2>Pilih kategori bantuan</h2>
  </div>
  <div class="cat-grid">
    <a href="#" class="cat">
      <div class="icon"><svg viewBox="0 0 40 40"><circle cx="20" cy="15" r="7"/><path d="M8 34 C8 25, 32 25, 32 34"/></svg></div>
      <h3>Akun &amp; pembayaran</h3>
      <p>Metode bayar, struk, dan pengaturan profil.</p>
    </a>
    <a href="#" class="cat">
      <div class="icon"><svg viewBox="0 0 40 40"><rect x="8" y="10" width="24" height="22" rx="2"/><line x1="8" y1="18" x2="32" y2="18"/><line x1="14" y1="6" x2="14" y2="14"/><line x1="26" y1="6" x2="26" y2="14"/></svg></div>
      <h3>Reservasi &amp; pembatalan</h3>
      <p>Ubah, perpanjang, atau batalkan pesanan slot.</p>
    </a>
    <a href="#" class="cat">
      <div class="icon"><svg viewBox="0 0 40 40"><rect x="10" y="10" width="20" height="20" rx="2"/><line x1="15" y1="15" x2="15" y2="19"/><line x1="20" y1="15" x2="20" y2="15.1"/><line x1="25" y1="15" x2="25" y2="19"/><line x1="15" y1="25" x2="25" y2="25"/></svg></div>
      <h3>Gerbang &amp; kode QR</h3>
      <p>Kode QR tidak terbaca, palang tidak terbuka.</p>
    </a>
    <a href="#" class="cat">
      <div class="icon"><svg viewBox="0 0 40 40"><path d="M8 32 L8 20 L16 20 L16 32"/><path d="M16 32 L16 12 L24 12 L24 32"/><path d="M24 32 L24 16 L32 16 L32 32"/></svg></div>
      <h3>Untuk pengelola</h3>
      <p>Pendaftaran gedung, sensor, dan dasbor.</p>
    </a>
  </div>
</section>

<section class="faq container">
  <div class="section-head center">
    <p class="eyebrow">Pertanyaan umum</p>
    <h2>Yang paling sering ditanyakan</h2>
  </div>
  <div class="faq-list">
    <details class="faq-item" open>
      <summary>Bagaimana cara membatalkan reservasi?</summary>
      <p>Buka tab "Pesanan Saya" di aplikasi, pilih reservasi yang ingin dibatalkan, lalu ketuk "Batalkan". Pembatalan sebelum masa toleransi habis tidak dikenakan biaya tambahan.</p>
    </details>
    <details class="faq-item">
      <summary>Kode QR saya tidak terbaca di gerbang, harus bagaimana?</summary>
      <p>Pastikan kecerahan layar HP-mu cukup dan kode QR tidak terpotong. Bila masih gagal, tekan tombol bantuan di tiang gerbang untuk terhubung langsung dengan petugas.</p>
    </details>
    <details class="faq-item">
      <summary>Kapan saldo pengembalian (refund) saya cair?</summary>
      <p>Pengembalian dana untuk sisa waktu yang tidak terpakai biasanya masuk ke metode pembayaran asal dalam 1–3 hari kerja, tergantung penyedia layanan pembayaranmu.</p>
    </details>
    <details class="faq-item">
      <summary>Bisakah satu akun dipakai untuk lebih dari satu kendaraan?</summary>
      <p>Bisa. Tambahkan pelat nomor kendaraan lain lewat menu "Kendaraan Saya", lalu pilih kendaraan yang sesuai setiap kali membuat reservasi baru.</p>
    </details>
    <details class="faq-item">
      <summary>Bagaimana cara mendaftarkan gedung saya ke Loka?</summary>
      <p>Kunjungi halaman "Untuk pengelola" dan isi formulir pengajuan. Tim Loka akan menghubungi dalam 2x24 jam untuk membahas pemasangan sensor dan gerbang.</p>
    </details>
  </div>
</section>

<section class="contact">
  <div class="container">
    <div class="section-head">
      <p class="eyebrow">Belum ketemu jawabannya?</p>
      <h2>Hubungi kami langsung</h2>
    </div>
    <div class="contact-grid">
      <div class="contact-item">
        <h3>Obrolan langsung</h3>
        <p>Tersedia setiap hari, 07.00–22.00, untuk pertanyaan seputar reservasi dan pembayaran.</p>
        <a href="#" class="cta-link">Mulai obrolan</a>
      </div>
      <div class="contact-item">
        <h3>Email</h3>
        <p>Kirim pertanyaan lebih rinci dan lampirkan tangkapan layar bila perlu. Dibalas dalam 1x24 jam.</p>
        <a href="#" class="cta-link">bantuan@loka.id</a>
      </div>
      <div class="contact-item">
        <h3>Telepon</h3>
        <p>Untuk kendala mendesak di gerbang, seperti palang tidak terbuka.</p>
        <a href="#" class="cta-link">0800-1-LOKA</a>
      </div>
    </div>
  </div>
</section>

<footer>
  <div class="footer-inner">
    <div>© 2026 Loka. Parkir jadi lebih tenang.</div>
    <div>Malang · Surabaya · Jakarta</div>
  </div>
</footer>

</body>
</html>