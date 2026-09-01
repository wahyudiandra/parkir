<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loka — Parkir jadi mudah</title>
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
  .logo .dot{
    width:9px;height:9px;background:var(--yellow);
    display:inline-block;
  }
  .navlinks{
    display:flex;
    gap:36px;
    font-size:14.5px;
    font-weight:500;
    color:var(--muted);
  }
  .navlinks a{ text-decoration:none; }
  .navlinks a:hover{ color:var(--ink); }
  .nav-cta{
    background:var(--asphalt);
    color:var(--white-line);
    padding:11px 22px;
    font-size:14px;
    font-weight:600;
    border-radius:2px;
    text-decoration:none;
  }
  @media (max-width:820px){ .navlinks{ display:none; } }

  /* HERO */
  .hero{
    background:var(--asphalt);
    color:var(--white-line);
    position:relative;
    overflow:hidden;
    padding:64px 32px 0;
  }
  .hero-inner{
    max-width:1180px;
    margin:0 auto;
    display:grid;
    grid-template-columns:1.05fr 0.95fr;
    gap:40px;
    align-items:center;
    position:relative;
    z-index:2;
  }
  .hero h1{
    font-size:clamp(38px, 4.6vw, 62px);
    line-height:1.04;
    font-weight:600;
    margin:0 0 22px;
  }
  .hero h1 .yellow{ color:var(--yellow); }
  .hero p{
    font-family:'Inter', sans-serif;
    text-transform:none;
    font-size:16.5px;
    line-height:1.6;
    color:#C9C7C0;
    max-width:460px;
    margin:0 0 34px;
  }

  .search-bar{
    background:var(--white-line);
    border-radius:3px;
    padding:8px;
    display:flex;
    gap:8px;
    max-width:520px;
  }
  .search-bar input{
    flex:1;
    border:none;
    background:transparent;
    padding:12px 14px;
    font-size:15px;
    font-family:'Inter', sans-serif;
    color:var(--ink);
    outline:none;
  }
  .search-bar button{
    background:var(--yellow);
    color:var(--asphalt);
    border:none;
    font-family:'Oswald', sans-serif;
    text-transform:uppercase;
    font-weight:600;
    letter-spacing:0.02em;
    font-size:14px;
    padding:0 24px;
    border-radius:2px;
    cursor:pointer;
    transition:background .15s ease;
  }
  .search-bar button:hover{ background:#FFD84D; }

  .stats-row{
    display:flex;
    gap:44px;
    margin-top:44px;
    padding-top:28px;
    border-top:1px solid #43423E;
    max-width:520px;
  }
  .stats-row .num{
    font-family:'Oswald', sans-serif;
    font-size:28px;
    font-weight:600;
    color:var(--yellow);
  }
  .stats-row .lbl{
    font-size:12.5px;
    color:#A9A79F;
    text-transform:none;
    margin-top:2px;
  }

  /* Hero bay art */
  .bay-art{
    position:relative;
    height:420px;
  }
  .bay-art svg{ width:100%; height:100%; }
  .bay-art path{
    fill:none;
    stroke:var(--yellow);
    stroke-width:3;
    stroke-linecap:square;
    stroke-dasharray:900;
    stroke-dashoffset:900;
    animation:paint 1.8s ease forwards;
  }
  .bay-art path:nth-child(1){animation-delay:.1s;}
  .bay-art path:nth-child(2){animation-delay:.3s;}
  .bay-art path:nth-child(3){animation-delay:.5s;}
  .bay-art path:nth-child(4){animation-delay:.7s;}
  .bay-art .car{
    opacity:0;
    animation:fadeIn .6s ease forwards;
    animation-delay:1.3s;
  }
  .bay-art .car-outline{ stroke:var(--white-line); stroke-width:2; }
  @keyframes paint{ to{ stroke-dashoffset:0; } }
  @keyframes fadeIn{ to{ opacity:1; } }
  @media (prefers-reduced-motion:reduce){
    .bay-art path{ animation:none; stroke-dashoffset:0; }
    .bay-art .car{ animation:none; opacity:1; }
  }
  @media (max-width:900px){
    .hero-inner{ grid-template-columns:1fr; }
    .bay-art{ height:260px; }
  }

  /* HOW IT WORKS */
  .steps{
    padding:96px 32px 88px;
  }
  .section-head{
    max-width:560px;
    margin:0 0 56px;
  }
  .section-head .eyebrow{
    font-family:'Oswald', sans-serif;
    font-size:13px;
    color:var(--muted);
    font-weight:500;
    letter-spacing:0.02em;
    margin:0 0 10px;
  }
  .section-head h2{
    font-size:32px;
    font-weight:600;
    margin:0;
  }
  .step-row{
    display:grid;
    grid-template-columns:repeat(3, 1fr);
    gap:0;
    border-top:1px solid var(--line);
  }
  .step{
    padding:32px 28px 0 0;
    border-right:1px solid var(--line);
  }
  .step:last-child{ border-right:none; }
  .step .n{
    font-family:'Oswald', sans-serif;
    font-size:15px;
    color:var(--yellow);
    -webkit-text-stroke:1px var(--asphalt);
    font-weight:600;
    display:block;
    margin-bottom:18px;
  }
  .step h3{
    font-size:19px;
    font-weight:600;
    margin:0 0 10px;
  }
  .step p{
    text-transform:none;
    font-family:'Inter', sans-serif;
    font-size:14.5px;
    line-height:1.6;
    color:var(--muted);
    max-width:280px;
  }
  @media (max-width:760px){
    .step-row{ grid-template-columns:1fr; }
    .step{ border-right:none; border-bottom:1px solid var(--line); padding-bottom:32px; }
  }

  /* LIVE BOARD */
  .board-section{
    background:var(--asphalt-2);
    padding:88px 32px;
    color:var(--white-line);
  }
  .board-section .section-head .eyebrow{ color:#A9A79F; }
  .board-section .section-head h2{ color:var(--white-line); }
  .board{
    border:1px solid #4A4944;
  }
  .board-row{
    display:grid;
    grid-template-columns:2.2fr 1fr 1fr 0.9fr;
    padding:18px 22px;
    border-bottom:1px solid #4A4944;
    align-items:center;
    font-size:14.5px;
  }
  .board-row:last-child{ border-bottom:none; }
  .board-row.head{
    font-family:'Oswald', sans-serif;
    text-transform:uppercase;
    font-size:12px;
    color:#A9A79F;
    letter-spacing:0.03em;
    padding:14px 22px;
  }
  .board-row .loc{ font-weight:600; }
  .board-row .sub{ font-size:12.5px; color:#A9A79F; margin-top:2px; }
  .avail{
    font-family:'Oswald', sans-serif;
    font-weight:600;
    color:var(--yellow);
  }
  .avail.low{ color:#E86B4F; }
  .badge{
    display:inline-block;
    font-size:11.5px;
    padding:4px 10px;
    border:1px solid #5A5952;
    border-radius:2px;
    color:#C9C7C0;
  }

  /* FEATURES */
  .features{
    padding:96px 32px;
  }
  .feat-grid{
    display:grid;
    grid-template-columns:repeat(2, 1fr);
    gap:1px;
    background:var(--line);
    border:1px solid var(--line);
  }
  .feat{
    background:var(--concrete);
    padding:38px;
  }
  .feat h3{
    font-size:18px;
    font-weight:600;
    margin:0 0 10px;
    display:flex;
    align-items:center;
    gap:10px;
  }
  .feat h3 .mark{
    width:8px;height:8px;
    background:var(--yellow);
    display:inline-block;
    flex-shrink:0;
  }
  .feat p{
    text-transform:none;
    font-family:'Inter', sans-serif;
    font-size:14.5px;
    line-height:1.6;
    color:var(--muted);
    margin:0;
  }
  @media (max-width:700px){ .feat-grid{ grid-template-columns:1fr; } }

  /* CTA */
  .cta{
    background:var(--yellow);
    padding:80px 32px;
    text-align:left;
  }
  .cta-inner{
    max-width:1180px;
    margin:0 auto;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:24px;
    flex-wrap:wrap;
  }
  .cta h2{
    font-size:30px;
    font-weight:600;
    color:var(--asphalt);
    margin:0;
    max-width:480px;
  }
  .cta-btn{
    background:var(--asphalt);
    color:var(--white-line);
    padding:16px 30px;
    font-family:'Oswald', sans-serif;
    text-transform:uppercase;
    font-weight:600;
    font-size:14.5px;
    letter-spacing:0.02em;
    text-decoration:none;
    border-radius:2px;
    white-space:nowrap;
  }

  footer{
    background:var(--asphalt);
    color:#A9A79F;
    padding:44px 32px;
    font-size:13.5px;
  }
  .footer-inner{
    max-width:1180px;
    margin:0 auto;
    display:flex;
    justify-content:space-between;
    flex-wrap:wrap;
    gap:16px;
  }
</style>
</head>
<body>
    <nav>
  <div class="logo"><span class="dot"></span>halaman utama</div>
  <div class="navlinks">
    <a href="/cara_kerja">Cara kerja</a>
    <a href="/lokasi">Lokasi</a>
    <a href="/pengelola">Untuk pengelola</a>
    <a href="/bantuan">Bantuan</a>
  </div>
  <a href="/index" class="nav-cta">Masuk</a>
</nav>

<section class="hero">
  <div class="hero-inner">
    <div>
      <h1>Cari tempat parkir tanpa<br>muter-muter <span class="yellow">lagi.</span></h1>
      <p>Lihat slot kosong secara langsung, pesan dari HP, dan langsung masuk gerbang pakai QR — tanpa antre kertas tiket.</p>

      <div class="search-bar">
        <input type="text" placeholder="Masukkan lokasi, mis. Malang Town Square">
        <button type="button">Cari</button>
      </div>

      <div class="stats-row">
        <div>
          <div class="num">128</div>
          <div class="lbl">Lokasi terhubung</div>
        </div>
        <div>
          <div class="num">2.400+</div>
          <div class="lbl">Slot terpantau langsung</div>
        </div>
        <div>
          <div class="num">24/7</div>
          <div class="lbl">Akses & dukungan</div>
        </div>
      </div>
    </div>

    <div class="bay-art">
      <svg viewBox="0 0 400 400" preserveAspectRatio="xMidYMid meet">
        <path d="M40 40 L40 360" />
        <path d="M160 40 L160 360" />
        <path d="M280 40 L280 360" />
        <path d="M20 200 L300 200" />
        <g class="car" transform="translate(60,220)">
          <rect class="car-outline" x="0" y="0" width="70" height="120" rx="8" fill="none"/>
          <line class="car-outline" x1="0" y1="30" x2="70" y2="30" />
          <line class="car-outline" x1="0" y1="90" x2="70" y2="90" />
        </g>
      </svg>
    </div>
  </div>
</section>

<section class="steps container">
  <div class="section-head">
    <p class="eyebrow">Cara kerja</p>
    <h2>Tiga langkah, dari cari sampai parkir.</h2>
  </div>
  <div class="step-row">
    <div class="step">
      <span class="n">01</span>
      <h3>Cari slot terdekat</h3>
      <p>Ketik lokasi tujuan dan lihat jumlah slot kosong secara langsung sebelum berangkat.</p>
    </div>
    <div class="step">
      <span class="n">02</span>
      <h3>Pesan &amp; bayar di muka</h3>
      <p>Kunci slot pilihanmu dan bayar langsung dari aplikasi — tanpa uang tunai di gerbang.</p>
    </div>
    <div class="step">
      <span class="n">03</span>
      <h3>Masuk pakai QR</h3>
      <p>Tunjukkan QR di gerbang, palang terbuka otomatis, dan slotmu sudah menunggu.</p>
    </div>
  </div>
</section>

<section class="board-section">
  <div class="container">
    <div class="section-head">
      <p class="eyebrow">Papan ketersediaan</p>
      <h2>Slot kosong, saat ini juga.</h2>
    </div>
    <div class="board">
      <div class="board-row head">
        <div>Lokasi</div>
        <div>Tarif</div>
        <div>Slot kosong</div>
        <div>Status</div>
      </div>
      <div class="board-row">
        <div>
          <div class="loc">Malang Town Square</div>
          <div class="sub">Jl. Veteran, Malang</div>
        </div>
        <div>Rp3.000/jam</div>
        <div class="avail">86 slot</div>
        <div><span class="badge">Buka 24 jam</span></div>
      </div>
      <div class="board-row">
        <div>
          <div class="loc">Stasiun Malang Kota Baru</div>
          <div class="sub">Jl. Trunojoyo, Malang</div>
        </div>
        <div>Rp2.000/jam</div>
        <div class="avail low">6 slot</div>
        <div><span class="badge">Ramai</span></div>
      </div>
      <div class="board-row">
        <div>
          <div class="loc">RSUD Saiful Anwar</div>
          <div class="sub">Jl. Jaksa Agung Suprapto</div>
        </div>
        <div>Rp2.500/jam</div>
        <div class="avail">41 slot</div>
        <div><span class="badge">Buka 24 jam</span></div>
      </div>
    </div>
  </div>
</section>

<section class="features container">
  <div class="section-head">
    <p class="eyebrow">Kenapa Loka</p>
    <h2>Dibangun untuk yang buru-buru.</h2>
  </div>
  <div class="feat-grid">
    <div class="feat">
      <h3><span class="mark"></span>Ketersediaan langsung</h3>
      <p>Sensor di tiap gerbang memperbarui jumlah slot kosong setiap beberapa detik, jadi info yang kamu lihat selalu akurat.</p>
    </div>
    <div class="feat">
      <h3><span class="mark"></span>Reservasi jaminan slot</h3>
      <p>Slot yang sudah kamu pesan tidak akan diambil orang lain, meski kamu tiba lebih lambat dari perkiraan.</p>
    </div>
    <div class="feat">
      <h3><span class="mark"></span>Bayar tanpa tunai</h3>
      <p>Terhubung ke e-wallet dan kartu debit, dengan struk otomatis untuk laporan pengeluaran kantor.</p>
    </div>
    <div class="feat">
      <h3><span class="mark"></span>Untuk pengelola gedung</h3>
      <p>Pantau okupansi, atur tarif per jam sibuk, dan kelola akses langganan dari satu dasbor.</p>
    </div>
  </div>
</section>

<section class="cta">
  <div class="cta-inner">
    <h2>Cari slot kosong terdekat dari lokasimu sekarang.</h2>
    <a href="#" class="cta-btn">Buka Loka</a>
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