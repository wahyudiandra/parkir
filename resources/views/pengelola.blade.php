<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untuk pengelola — Loka</title>
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
  body{
    font-family:'Inter', sans-serif;
    color:var(--ink);
    background:var(--concrete);
  }
  h1,h2,h3,.disp{
    font-family:'Oswald', sans-serif;
    text-transform:uppercase;
    letter-spacing:0.01em;
  }
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
  .hero{
    background:var(--asphalt);
    color:var(--white-line);
    padding:64px 32px 80px;
  }
  .hero-inner{
    max-width:1180px; margin:0 auto;
    display:grid; grid-template-columns:1.05fr 0.95fr;
    gap:40px; align-items:center;
  }
  .hero .eyebrow{
    font-family:'Oswald', sans-serif; font-size:13px; color:var(--yellow);
    font-weight:500; letter-spacing:0.03em; margin:0 0 14px;
  }
  .hero h1{
    font-size:clamp(32px, 3.8vw, 48px); font-weight:600; line-height:1.08;
    margin:0 0 18px;
  }
  .hero p{
    text-transform:none; font-family:'Inter', sans-serif;
    font-size:16px; line-height:1.6; color:#C9C7C0;
    max-width:460px; margin:0 0 32px;
  }
  .btn-row{ display:flex; gap:14px; flex-wrap:wrap; }
  .btn-yellow{
    background:var(--yellow); color:var(--asphalt);
    padding:15px 26px; font-family:'Oswald', sans-serif;
    text-transform:uppercase; font-weight:600; font-size:14px;
    letter-spacing:0.02em; text-decoration:none; border-radius:2px;
  }
  .btn-outline{
    background:transparent; color:var(--white-line);
    border:1.5px solid #4A4944;
    padding:14px 26px; font-family:'Oswald', sans-serif;
    text-transform:uppercase; font-weight:600; font-size:14px;
    letter-spacing:0.02em; text-decoration:none; border-radius:2px;
  }
  .btn-outline:hover{ border-color:var(--yellow); color:var(--yellow); }

  /* Dashboard mock art */
  .dash-art{
    background:var(--asphalt-2);
    border:1px solid #4A4944;
    padding:22px;
  }
  .dash-art .dash-head{
    display:flex; justify-content:space-between; align-items:center;
    margin-bottom:18px;
  }
  .dash-art .dash-head .t{
    font-family:'Oswald', sans-serif; font-size:12px; color:#A9A79F;
    text-transform:uppercase; letter-spacing:0.03em;
  }
  .dash-bars{ display:flex; align-items:flex-end; gap:8px; height:100px; margin-bottom:18px; }
  .dash-bars .bar{ flex:1; background:#4A4944; }
  .dash-bars .bar.hi{ background:var(--yellow); }
  .dash-stats{ display:flex; gap:24px; border-top:1px solid #4A4944; padding-top:16px; }
  .dash-stats div .num{ font-family:'Oswald', sans-serif; font-size:20px; font-weight:600; color:var(--white-line); }
  .dash-stats div .lbl{ font-size:11px; color:#A9A79F; margin-top:2px; }
  @media (max-width:900px){ .hero-inner{ grid-template-columns:1fr; } }

  /* BENEFITS */
  .features{ padding:96px 32px; }
  .section-head{ max-width:560px; margin:0 0 56px; }
  .section-head .eyebrow{
    font-family:'Oswald', sans-serif; font-size:13px; color:var(--muted);
    font-weight:500; letter-spacing:0.02em; margin:0 0 10px;
  }
  .section-head h2{ font-size:32px; font-weight:600; margin:0; }
  .feat-grid{
    display:grid; grid-template-columns:repeat(2, 1fr); gap:1px;
    background:var(--line); border:1px solid var(--line);
  }
  .feat{ background:var(--concrete); padding:38px; }
  .feat h3{
    font-size:18px; font-weight:600; margin:0 0 10px;
    display:flex; align-items:center; gap:10px;
  }
  .feat h3 .mark{ width:8px;height:8px; background:var(--yellow); display:inline-block; flex-shrink:0; }
  .feat p{
    text-transform:none; font-family:'Inter', sans-serif;
    font-size:14.5px; line-height:1.6; color:var(--muted); margin:0;
  }
  @media (max-width:700px){ .feat-grid{ grid-template-columns:1fr; } }

  /* ONBOARDING STEPS */
  .steps{ background:var(--asphalt-2); color:var(--white-line); padding:96px 32px; }
  .steps .section-head .eyebrow{ color:#A9A79F; }
  .steps .section-head h2{ color:var(--white-line); }
  .step-row{ display:grid; grid-template-columns:repeat(3, 1fr); border-top:1px solid #4A4944; }
  .step{ padding:32px 28px 0 0; border-right:1px solid #4A4944; }
  .step:last-child{ border-right:none; }
  .step .n{
    font-family:'Oswald', sans-serif; font-size:15px; color:var(--yellow);
    font-weight:600; display:block; margin-bottom:18px;
  }
  .step h3{ font-size:18px; font-weight:600; margin:0 0 10px; }
  .step p{
    text-transform:none; font-family:'Inter', sans-serif;
    font-size:14px; line-height:1.6; color:#A9A79F; max-width:280px;
  }
  @media (max-width:760px){
    .step-row{ grid-template-columns:1fr; }
    .step{ border-right:none; border-bottom:1px solid #4A4944; padding-bottom:32px; }
  }

  /* QUOTE */
  .quote-section{ padding:96px 32px; }
  .quote-box{
    max-width:760px; margin:0 auto; text-align:left;
    border-left:3px solid var(--yellow); padding-left:32px;
  }
  .quote-box p{
    font-family:'Oswald', sans-serif; font-weight:400; text-transform:none;
    font-size:24px; line-height:1.4; color:var(--ink); margin:0 0 20px;
  }
  .quote-box .attr{ font-size:14px; color:var(--muted); }
  .quote-box .attr strong{ color:var(--ink); }

  /* CTA */
  .cta{ background:var(--yellow); padding:80px 32px; }
  .cta-inner{
    max-width:1180px; margin:0 auto;
    display:flex; align-items:center; justify-content:space-between;
    gap:24px; flex-wrap:wrap;
  }
  .cta h2{ font-size:28px; font-weight:600; color:var(--asphalt); margin:0; max-width:480px; }
  .cta-btns{ display:flex; gap:14px; flex-wrap:wrap; }
  .cta-btn{
    background:var(--asphalt); color:var(--white-line);
    padding:16px 30px; font-family:'Oswald', sans-serif;
    text-transform:uppercase; font-weight:600; font-size:14.5px;
    letter-spacing:0.02em; text-decoration:none; border-radius:2px; white-space:nowrap;
  }
  .cta-btn.ghost{
    background:transparent; color:var(--asphalt); border:1.5px solid var(--asphalt);
  }

  footer{ background:var(--asphalt); color:#A9A79F; padding:44px 32px; font-size:13.5px; }
  .footer-inner{
    max-width:1180px; margin:0 auto;
    display:flex; justify-content:space-between; flex-wrap:wrap; gap:16px;
  }
</style>
</head>
<body>
    <nav>
  <div class="logo"><span class="dot"></span>pengelola</div>
  <div class="navlinks">
    <a href="/cara_kerja">Cara kerja</a>
    <a href="/lokasi">Lokasi</a>
    <a href="/pengelola" class="active">Untuk pengelola</a>
    <a href="/bantuan">Bantuan</a>
  </div>
  <div class="nav-right">
    <a href="/dasboard" class="nav-home">Halaman utama</a>
    <a href="/index" class="nav-cta">Masuk</a>
  </div>
</nav>

<section class="hero">
  <div class="hero-inner">
    <div>
      <p class="eyebrow">Untuk pengelola</p>
      <h1>Area parkirmu, dipantau dan diatur dari satu layar.</h1>
      <p>Hubungkan gerbang dan sensor gedungmu ke Loka. Pantau okupansi secara langsung, atur tarif jam sibuk, dan biarkan pengunjung bayar sendiri lewat aplikasi — tanpa antrean di loket.</p>
      <div class="btn-row">
        <a href="#" class="btn-yellow">Ajukan gedungmu</a>
      </div>
    </div>

    <div class="dash-art">
      <div class="dash-head">
        <span class="t">Okupansi hari ini</span>
        <span class="t">07.00 – 19.00</span>
      </div>
      <div class="dash-bars">
        <div class="bar" style="height:30%"></div>
        <div class="bar" style="height:45%"></div>
        <div class="bar" style="height:38%"></div>
        <div class="bar hi" style="height:82%"></div>
        <div class="bar hi" style="height:90%"></div>
        <div class="bar hi" style="height:76%"></div>
        <div class="bar" style="height:52%"></div>
        <div class="bar" style="height:40%"></div>
        <div class="bar" style="height:28%"></div>
      </div>
      <div class="dash-stats">
        <div>
          <div class="num">312</div>
          <div class="lbl">Kendaraan hari ini</div>
        </div>
        <div>
          <div class="num">86%</div>
          <div class="lbl">Okupansi puncak</div>
        </div>
        <div>
          <div class="num">Rp4,2jt</div>
          <div class="lbl">Pendapatan hari ini</div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="features container">
  <div class="section-head">
    <p class="eyebrow">Yang kamu dapat</p>
    <h2>Satu dasbor untuk seluruh operasional parkir.</h2>
  </div>
  <div class="feat-grid">
    <div class="feat">
      <h3><span class="mark"></span>Pantauan okupansi langsung</h3>
      <p>Lihat jumlah slot terisi dan kosong secara langsung dari sensor di tiap gerbang, tanpa perlu cek lapangan.</p>
    </div>
    <div class="feat">
      <h3><span class="mark"></span>Tarif dinamis jam sibuk</h3>
      <p>Atur tarif berbeda untuk jam sibuk dan jam sepi agar okupansi lebih merata sepanjang hari.</p>
    </div>
    <div class="feat">
      <h3><span class="mark"></span>Akses langganan bulanan</h3>
      <p>Kelola daftar penyewa atau karyawan dengan akses langganan tanpa perlu kartu fisik.</p>
    </div>
    <div class="feat">
      <h3><span class="mark"></span>Laporan pendapatan otomatis</h3>
      <p>Rekap harian dan bulanan tersedia langsung di dasbor, siap dipakai untuk laporan ke manajemen.</p>
    </div>
  </div>
</section>

<section class="steps">
  <div class="container">
    <div class="section-head">
      <p class="eyebrow">Cara bergabung</p>
      <h2>Tiga langkah untuk mulai.</h2>
    </div>
    <div class="step-row">
      <div class="step">
        <span class="n">01</span>
        <h3>Daftarkan gedungmu</h3>
        <p>Isi data gedung dan jumlah slot parkir yang tersedia. Tim Loka akan menghubungi dalam 2x24 jam.</p>
      </div>
      <div class="step">
        <span class="n">02</span>
        <h3>Pasang sensor &amp; gerbang</h3>
        <p>Tim teknis memasang sensor okupansi dan palang pintar tanpa mengganggu operasional harianmu.</p>
      </div>
      <div class="step">
        <span class="n">03</span>
        <h3>Mulai terima pembayaran</h3>
        <p>Gedungmu tampil di aplikasi Loka, pengunjung bisa langsung memesan dan membayar dari HP mereka.</p>
      </div>
    </div>
  </div>
</section>

<section class="quote-section container">
  <div class="quote-box">
    <p>"Sejak pakai Loka, kami nggak perlu lagi tambah orang buat jaga loket tiap akhir pekan. Okupansi juga jadi kelihatan jelas dari kantor."</p>
    <div class="attr"><strong>Pengelola Gedung</strong> — Kawasan perkantoran, Malang</div>
  </div>
</section>

<section class="cta">
  <div class="cta-inner">
    <h2>Siap hubungkan gedungmu ke Loka?</h2>
    <div class="cta-btns">
      <a href="#" class="cta-btn">Ajukan gedungmu</a>
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