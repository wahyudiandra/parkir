<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi — Loka</title>
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
  .container{
    max-width:1180px;
    margin:0 auto;
    padding:0 32px;
  }

  /* NAV */
  nav{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:26px 32px;
    max-width:1180px;
    margin:0 auto;
  }
  .logo{
    font-family:'Oswald', sans-serif;
    font-size:22px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:0.02em;
    display:flex;
    align-items:center;
    gap:8px;
  }
  .logo .dot{ width:9px;height:9px;background:var(--yellow); display:inline-block; }
  .navlinks{ display:flex; gap:36px; font-size:14.5px; font-weight:500; color:var(--muted); }
  .navlinks a{ text-decoration:none; }
  .navlinks a:hover, .navlinks a.active{ color:var(--ink); }
  .nav-cta{
    background:var(--asphalt); color:var(--white-line);
    padding:11px 22px; font-size:14px; font-weight:600;
    border-radius:2px; text-decoration:none;
  }
  @media (max-width:820px){ .navlinks{ display:none; } }

  /* PAGE HERO */
  .page-hero{
    background:var(--asphalt);
    color:var(--white-line);
    padding:56px 32px 40px;
  }
  .page-hero .eyebrow{
    font-family:'Oswald', sans-serif;
    font-size:13px; color:var(--yellow); font-weight:500;
    letter-spacing:0.03em; margin:0 0 14px;
  }
  .page-hero h1{
    font-size:clamp(30px, 3.6vw, 44px);
    font-weight:600; line-height:1.08;
    margin:0 0 28px; max-width:600px;
  }
  .search-bar{
    background:var(--white-line);
    border-radius:3px;
    padding:8px;
    display:flex;
    gap:8px;
    max-width:560px;
  }
  .search-bar input{
    flex:1; border:none; background:transparent;
    padding:12px 14px; font-size:15px;
    font-family:'Inter', sans-serif; color:var(--ink); outline:none;
  }
  .search-bar button{
    background:var(--yellow); color:var(--asphalt);
    border:none; font-family:'Oswald', sans-serif;
    text-transform:uppercase; font-weight:600; letter-spacing:0.02em;
    font-size:14px; padding:0 24px; border-radius:2px; cursor:pointer;
    transition:background .15s ease;
  }
  .search-bar button:hover{ background:#FFD84D; }

  /* FILTER BAR */
  .filter-bar{
    background:var(--concrete);
    border-bottom:1px solid var(--line);
    padding:20px 32px;
    position:sticky;
    top:0;
    z-index:5;
  }
  .filter-inner{
    max-width:1180px;
    margin:0 auto;
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    align-items:center;
  }
  .chip{
    font-family:'Oswald', sans-serif;
    font-size:13px;
    text-transform:uppercase;
    letter-spacing:0.02em;
    padding:9px 16px;
    border:1px solid var(--line);
    border-radius:2px;
    background:transparent;
    color:var(--muted);
    cursor:pointer;
    font-weight:500;
  }
  .chip.active{
    background:var(--asphalt);
    border-color:var(--asphalt);
    color:var(--white-line);
  }
  .filter-count{
    margin-left:auto;
    font-size:13.5px;
    color:var(--muted);
  }
  @media (max-width:700px){ .filter-count{ display:none; } }

  /* LIST */
  .list-section{ padding:56px 32px 96px; }
  .loc-list{ border-top:1px solid var(--line); }
  .loc-row{
    display:grid;
    grid-template-columns:2.1fr 0.9fr 1fr 0.9fr auto;
    align-items:center;
    gap:16px;
    padding:24px 4px;
    border-bottom:1px solid var(--line);
  }
  .loc-row .tag{
    font-family:'Oswald', sans-serif;
    font-size:11px;
    text-transform:uppercase;
    letter-spacing:0.02em;
    color:var(--muted);
    margin-bottom:6px;
    display:block;
  }
  .loc-row .name{
    font-size:17px;
    font-weight:600;
    margin-bottom:4px;
  }
  .loc-row .addr{
    font-size:13.5px;
    color:var(--muted);
  }
  .loc-row .tarif{
    font-size:14.5px;
  }
  .loc-row .avail{
    font-family:'Oswald', sans-serif;
    font-weight:600;
    font-size:15px;
    color:var(--asphalt);
  }
  .loc-row .avail.low{ color:#B84A32; }
  .loc-row .avail .lbl{
    display:block;
    font-family:'Inter', sans-serif;
    font-weight:400;
    font-size:11.5px;
    color:var(--muted);
    text-transform:none;
    margin-top:2px;
  }
  .status-badge{
    display:inline-block;
    font-size:11.5px;
    padding:4px 10px;
    border:1px solid var(--line);
    border-radius:2px;
    color:var(--muted);
  }
  .status-badge.open{ border-color:#5C7A5F; color:#456047; }
  .loc-row .detail-link{
    font-family:'Oswald', sans-serif;
    font-size:13px;
    text-transform:uppercase;
    letter-spacing:0.02em;
    font-weight:600;
    color:var(--ink);
    text-decoration:none;
    white-space:nowrap;
    border-bottom:1.5px solid var(--yellow);
    padding-bottom:2px;
  }
  @media (max-width:900px){
    .loc-row{
      grid-template-columns:1fr;
      gap:8px;
    }
    .loc-row .detail-link{ margin-top:4px; }
  }

  .load-more{
    display:block;
    margin:40px auto 0;
    background:transparent;
    border:1.5px solid var(--asphalt);
    color:var(--asphalt);
    font-family:'Oswald', sans-serif;
    text-transform:uppercase;
    font-weight:600;
    font-size:13.5px;
    letter-spacing:0.02em;
    padding:13px 30px;
    border-radius:2px;
    cursor:pointer;
  }
  .load-more:hover{ background:var(--asphalt); color:var(--white-line); }

  /* CTA */
  .cta{ background:var(--yellow); padding:80px 32px; }
  .cta-inner{
    max-width:1180px; margin:0 auto;
    display:flex; align-items:center; justify-content:space-between;
    gap:24px; flex-wrap:wrap;
  }
  .cta h2{ font-size:28px; font-weight:600; color:var(--asphalt); margin:0; max-width:480px; }
  .cta-btn{
    background:var(--asphalt); color:var(--white-line);
    padding:16px 30px; font-family:'Oswald', sans-serif;
    text-transform:uppercase; font-weight:600; font-size:14.5px;
    letter-spacing:0.02em; text-decoration:none; border-radius:2px; white-space:nowrap;
  }

  footer{
    background:var(--asphalt); color:#A9A79F;
    padding:44px 32px; font-size:13.5px;
  }
  .footer-inner{
    max-width:1180px; margin:0 auto;
    display:flex; justify-content:space-between; flex-wrap:wrap; gap:16px;
  }
</style>
</head>
<body>
    <nav>
  <div class="logo"><span class="dot"></span>Lokasi</div>
  <div class="navlinks">
    <a href="/cara_kerja">Cara kerja</a>
    <a href="/lokasi" class="active">Lokasi</a>
    <a href="/pengelola">Untuk pengelola</a>
    <a href="/bantuan">Bantuan</a>
  </div>
  <a href="/dasboard" class="nav-home">Halaman utama</a>
  <a href="/index" class="nav-cta">Masuk</a>
</nav>

<section class="page-hero">
  <p class="eyebrow">Lokasi</p>
  <h1>128 titik parkir terhubung, tersebar di tiga kota.</h1>
  <div class="search-bar">
    <input type="text" placeholder="Cari nama lokasi atau area, mis. Dinoyo">
    <button type="button">Cari</button>
  </div>
</section>

<div class="filter-bar">
  <div class="filter-inner">
    <button class="chip active">Semua</button>
    <button class="chip">Mal &amp; pusat belanja</button>
    <button class="chip">Stasiun &amp; terminal</button>
    <button class="chip">Rumah sakit</button>
    <button class="chip">Perkantoran</button>
    <button class="chip">Apartemen</button>
    <span class="filter-count">128 lokasi</span>
  </div>
</div>

<section class="list-section container">
  <div class="loc-list">

    <div class="loc-row">
      <div>
        <span class="tag">Mal &amp; pusat belanja</span>
        <div class="name">Malang Town Square</div>
        <div class="addr">Jl. Veteran, Malang</div>
      </div>
      <div class="tarif">Rp3.000/jam</div>
      <div class="avail">86<span class="lbl">slot kosong</span></div>
      <div><span class="status-badge open">Buka 24 jam</span></div>
      <a href="#" class="detail-link">Detail</a>
    </div>

    <div class="loc-row">
      <div>
        <span class="tag">Stasiun &amp; terminal</span>
        <div class="name">Stasiun Malang Kota Baru</div>
        <div class="addr">Jl. Trunojoyo, Malang</div>
      </div>
      <div class="tarif">Rp2.000/jam</div>
      <div class="avail low">6<span class="lbl">slot kosong</span></div>
      <div><span class="status-badge">Ramai</span></div>
      <a href="#" class="detail-link">Detail</a>
    </div>

    <div class="loc-row">
      <div>
        <span class="tag">Rumah sakit</span>
        <div class="name">RSUD Saiful Anwar</div>
        <div class="addr">Jl. Jaksa Agung Suprapto, Malang</div>
      </div>
      <div class="tarif">Rp2.500/jam</div>
      <div class="avail">41<span class="lbl">slot kosong</span></div>
      <div><span class="status-badge open">Buka 24 jam</span></div>
      <a href="#" class="detail-link">Detail</a>
    </div>

    <div class="loc-row">
      <div>
        <span class="tag">Perkantoran</span>
        <div class="name">Menara BRI Malang</div>
        <div class="addr">Jl. Basuki Rahmat, Malang</div>
      </div>
      <div class="tarif">Rp4.000/jam</div>
      <div class="avail">23<span class="lbl">slot kosong</span></div>
      <div><span class="status-badge">Tutup 21.00</span></div>
      <a href="#" class="detail-link">Detail</a>
    </div>

    <div class="loc-row">
      <div>
        <span class="tag">Mal &amp; pusat belanja</span>
        <div class="name">Transmart Cirebon</div>
        <div class="addr">Jl. Cipto Mangunkusumo, Cirebon</div>
      </div>
      <div class="tarif">Rp2.500/jam</div>
      <div class="avail">54<span class="lbl">slot kosong</span></div>
      <div><span class="status-badge open">Buka 24 jam</span></div>
      <a href="#" class="detail-link">Detail</a>
    </div>

    <div class="loc-row">
      <div>
        <span class="tag">Apartemen</span>
        <div class="name">Apartemen Puncak Dieng</div>
        <div class="addr">Jl. Dieng, Malang</div>
      </div>
      <div class="tarif">Rp1.500/jam</div>
      <div class="avail low">4<span class="lbl">slot kosong</span></div>
      <div><span class="status-badge">Ramai</span></div>
      <a href="#" class="detail-link">Detail</a>
    </div>

    <div class="loc-row">
      <div>
        <span class="tag">Stasiun &amp; terminal</span>
        <div class="name">Terminal Purabaya</div>
        <div class="addr">Bungurasih, Surabaya</div>
      </div>
      <div class="tarif">Rp2.000/jam</div>
      <div class="avail">67<span class="lbl">slot kosong</span></div>
      <div><span class="status-badge open">Buka 24 jam</span></div>
      <a href="#" class="detail-link">Detail</a>
    </div>

    <div class="loc-row">
      <div>
        <span class="tag">Rumah sakit</span>
        <div class="name">RS Siloam Surabaya</div>
        <div class="addr">Jl. Raya Gubeng, Surabaya</div>
      </div>
      <div class="tarif">Rp3.000/jam</div>
      <div class="avail">18<span class="lbl">slot kosong</span></div>
      <div><span class="status-badge open">Buka 24 jam</span></div>
      <a href="#" class="detail-link">Detail</a>
    </div>

  </div>

  <button type="button" class="load-more">Muat lebih banyak</button>
</section>

<section class="cta">
  <div class="cta-inner">
    <h2>Lokasi favoritmu belum ada di daftar?</h2>
    <a href="#" class="cta-btn">Ajukan gedungmu</a>
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