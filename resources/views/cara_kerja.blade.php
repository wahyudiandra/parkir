<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara kerja — Loka</title>
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
  .nav-right{ display:flex; align-items:center; gap:14px; }
  .navlinks a{ text-decoration:none; }
  .navlinks a:hover, .navlinks a.active{ color:var(--ink); }
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

  /* PAGE HERO */
  .page-hero{
    background:var(--asphalt);
    color:var(--white-line);
    padding:64px 32px 72px;
  }
  .page-hero .eyebrow{
    font-family:'Oswald', sans-serif;
    font-size:13px;
    color:var(--yellow);
    font-weight:500;
    letter-spacing:0.03em;
    margin:0 0 14px;
  }
  .page-hero h1{
    font-size:clamp(34px, 4vw, 52px);
    font-weight:600;
    line-height:1.06;
    margin:0 0 18px;
    max-width:640px;
  }
  .page-hero p{
    text-transform:none;
    font-family:'Inter', sans-serif;
    font-size:16px;
    line-height:1.6;
    color:#C9C7C0;
    max-width:520px;
    margin:0;
  }

  /* STEP DETAIL BLOCKS */
  .step-detail{
    padding:96px 32px;
  }
  .step-block{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:64px;
    align-items:center;
    padding:56px 0;
    border-bottom:1px solid var(--line);
  }
  .step-block:first-child{ padding-top:0; }
  .step-block:last-child{ border-bottom:none; }
  .step-block.rev .art{ order:2; }
  .step-block.rev .copy{ order:1; }

  .copy .n{
    font-family:'Oswald', sans-serif;
    font-size:14px;
    color:var(--muted);
    font-weight:600;
    letter-spacing:0.03em;
    display:block;
    margin-bottom:16px;
  }
  .copy .n span{ color:var(--yellow); -webkit-text-stroke:0.6px var(--asphalt); }
  .copy h2{
    font-size:26px;
    font-weight:600;
    margin:0 0 14px;
  }
  .copy p{
    text-transform:none;
    font-family:'Inter', sans-serif;
    font-size:15px;
    line-height:1.65;
    color:var(--muted);
    max-width:420px;
    margin:0 0 20px;
  }
  .copy ul{
    list-style:none;
    margin:0;
    padding:0;
  }
  .copy ul li{
    font-size:14px;
    color:var(--ink);
    padding-left:18px;
    position:relative;
    margin-bottom:10px;
  }
  .copy ul li::before{
    content:"";
    position:absolute;
    left:0; top:7px;
    width:7px; height:7px;
    background:var(--yellow);
  }

  .art{
    background:var(--asphalt);
    aspect-ratio:4/3;
    display:flex;
    align-items:center;
    justify-content:center;
  }
  .art svg{ width:72%; height:72%; }
  .art path, .art rect, .art circle, .art line{
    fill:none;
    stroke:var(--yellow);
    stroke-width:2.2;
    stroke-linecap:round;
    stroke-linejoin:round;
  }
  .art .fill{ fill:var(--yellow); stroke:none; }
  .art .white{ stroke:var(--white-line); }

  @media (max-width:820px){
    .step-block, .step-block.rev{
      grid-template-columns:1fr;
      gap:28px;
    }
    .step-block.rev .art, .step-block.rev .copy{ order:0; }
  }

  /* MANAGER CALLOUT */
  .manager{
    background:var(--asphalt-2);
    color:var(--white-line);
    padding:72px 32px;
  }
  .manager-inner{
    max-width:1180px;
    margin:0 auto;
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:32px;
    flex-wrap:wrap;
  }
  .manager h2{
    font-size:24px;
    font-weight:600;
    margin:0 0 10px;
  }
  .manager p{
    text-transform:none;
    font-family:'Inter', sans-serif;
    font-size:14.5px;
    color:#A9A79F;
    max-width:440px;
    margin:0;
  }
  .manager-btn{
    background:var(--yellow);
    color:var(--asphalt);
    padding:14px 26px;
    font-family:'Oswald', sans-serif;
    text-transform:uppercase;
    font-weight:600;
    font-size:14px;
    letter-spacing:0.02em;
    text-decoration:none;
    border-radius:2px;
    white-space:nowrap;
  }

  /* FAQ */
  .faq{
    padding:96px 32px;
  }
  .section-head{
    max-width:560px;
    margin:0 0 48px;
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
    font-size:30px;
    font-weight:600;
    margin:0;
  }
  .faq-list{
    border-top:1px solid var(--line);
    max-width:760px;
  }
  .faq-item{
    border-bottom:1px solid var(--line);
  }
  .faq-item summary{
    padding:22px 0;
    font-family:'Oswald', sans-serif;
    font-size:16px;
    font-weight:500;
    text-transform:none;
    cursor:pointer;
    display:flex;
    justify-content:space-between;
    align-items:center;
    list-style:none;
  }
  .faq-item summary::-webkit-details-marker{ display:none; }
  .faq-item summary::after{
    content:"+";
    font-size:20px;
    color:var(--muted);
    font-family:'Inter', sans-serif;
    transition:transform .18s ease;
  }
  .faq-item[open] summary::after{ content:"–"; }
  .faq-item p{
    text-transform:none;
    font-family:'Inter', sans-serif;
    font-size:14.5px;
    line-height:1.65;
    color:var(--muted);
    margin:0 0 24px;
    max-width:600px;
  }

  /* CTA */
  .cta{
    background:var(--yellow);
    padding:80px 32px;
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
    font-size:28px;
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
  <div class="logo"><span class="dot"></span>cara kerja</div>
  <div class="navlinks">
    <a href="/cara_kerja" class="active">Cara kerja</a>
    <a href="/lokasi">Lokasi</a>
    <a href="/pengelola">Untuk pengelola</a>
    <a href="/bantuan">Bantuan</a>
  </div class="nav-right">
  <a href="/dasboard" class="nav-home">Halaman utama</a>
  <a href="/index" class="nav-cta">Masuk</a>
</nav>

<section class="page-hero">
  <p class="eyebrow">Cara kerja</p>
  <h1>Dari cari slot sampai palang terbuka, empat langkah saja.</h1>
  <p>Tidak ada tiket kertas, tidak ada muter-muter cari slot kosong. Begini alurnya dari layar HP-mu sampai kamu turun dari mobil.</p>
</section>

<section class="step-detail container">

  <div class="step-block">
    <div class="art">
      <svg viewBox="0 0 120 100">
        <circle cx="45" cy="42" r="22" />
        <line x1="61" y1="58" x2="82" y2="79" class="white"/>
        <path d="M45 30 L45 54 M33 42 L57 42" />
      </svg>
    </div>
    <div class="copy">
      <span class="n">Langkah <span>01</span></span>
      <h2>Cari lokasi tujuanmu</h2>
      <p>Ketik nama mal, stasiun, rumah sakit, atau alamat tujuan. Loka menampilkan semua titik parkir terhubung di sekitar sana, lengkap dengan jarak dan tarif per jam.</p>
      <ul>
        <li>Jumlah slot kosong diperbarui tiap beberapa detik</li>
        <li>Tarif dan jam operasional langsung terlihat</li>
      </ul>
    </div>
  </div>

  <div class="step-block rev">
    <div class="art">
      <svg viewBox="0 0 120 100">
        <rect x="24" y="18" width="72" height="64" rx="2" />
        <line x1="24" y1="36" x2="96" y2="36" />
        <line x1="24" y1="52" x2="96" y2="52" />
        <line x1="24" y1="68" x2="96" y2="68" />
        <circle class="fill" cx="86" cy="27" r="3.2" />
      </svg>
    </div>
    <div class="copy">
      <span class="n">Langkah <span>02</span></span>
      <h2>Pilih slot &amp; kunci pesananmu</h2>
      <p>Lihat papan ketersediaan seperti di lokasi langsung — pilih titik parkir yang paling cocok, lalu kunci slot itu untukmu selama waktu yang kamu tentukan.</p>
      <ul>
        <li>Slot yang sudah dikunci tidak bisa diambil pengguna lain</li>
        <li>Bisa diperpanjang langsung dari aplikasi bila perlu</li>
      </ul>
    </div>
  </div>

  <div class="step-block">
    <div class="art">
      <svg viewBox="0 0 120 100">
        <rect x="20" y="30" width="80" height="40" rx="4" />
        <line x1="20" y1="46" x2="100" y2="46" stroke-dasharray="4 4"/>
        <circle class="fill" cx="35" cy="58" r="3"/>
        <line x1="50" y1="58" x2="80" y2="58" class="white"/>
      </svg>
    </div>
    <div class="copy">
      <span class="n">Langkah <span>03</span></span>
      <h2>Bayar di muka, tanpa tunai</h2>
      <p>Selesaikan pembayaran lewat e-wallet atau kartu debit yang tersimpan. Struk otomatis dikirim ke email — cocok buat kamu yang perlu laporan pengeluaran.</p>
      <ul>
        <li>Tidak perlu siapkan uang pas di gerbang</li>
        <li>Riwayat transaksi tersimpan rapi di akunmu</li>
      </ul>
    </div>
  </div>

  <div class="step-block rev">
    <div class="art">
      <svg viewBox="0 0 120 100">
        <line x1="30" y1="20" x2="30" y2="80" />
        <path d="M30 30 L85 30" class="white"/>
        <path d="M75 22 L88 30 L75 38" class="white"/>
        <rect x="18" y="55" width="34" height="20" rx="4"/>
        <line x1="18" y1="63" x2="52" y2="63"/>
      </svg>
    </div>
    <div class="copy">
      <span class="n">Langkah <span>04</span></span>
      <h2>Scan QR, palang terbuka</h2>
      <p>Sampai di gerbang, tunjukkan kode QR dari aplikasi ke kamera pemindai. Palang terbuka otomatis dan slot yang sudah kamu pesan sudah menunggu.</p>
      <ul>
        <li>Tidak perlu ambil atau simpan tiket kertas</li>
        <li>QR yang sama dipakai lagi saat keluar</li>
      </ul>
    </div>
  </div>

</section>

<section class="manager">
  <div class="manager-inner">
    <div>
      <h2>Punya gedung dengan area parkir?</h2>
      <p>Loka juga punya alur khusus untuk pengelola — pantau okupansi secara langsung, atur tarif jam sibuk, dan kelola akses langganan dari satu dasbor.</p>
    </div>
    <a href="#" class="manager-btn">Lihat untuk pengelola</a>
  </div>
</section>

<section class="faq container">
  <div class="section-head">
    <p class="eyebrow">Pertanyaan umum</p>
    <h2>Yang biasa ditanyakan.</h2>
  </div>
  <div class="faq-list">
    <details class="faq-item" open>
      <summary>Apa yang terjadi kalau saya datang lebih lambat dari jadwal?</summary>
      <p>Slot yang sudah kamu pesan tetap ditahan selama masa toleransi yang ditampilkan saat pemesanan. Kamu juga bisa perpanjang waktu langsung dari aplikasi sebelum masa itu habis.</p>
    </details>
    <details class="faq-item">
      <summary>Bagaimana kalau saya keluar lebih cepat dari waktu yang dipesan?</summary>
      <p>Sisa waktu yang belum terpakai akan dihitung ulang secara otomatis, dan selisihnya dikembalikan ke metode pembayaranmu sesuai kebijakan masing-masing lokasi.</p>
    </details>
    <details class="faq-item">
      <summary>Apakah saya perlu mencetak QR di kertas?</summary>
      <p>Tidak. QR ditampilkan langsung di aplikasi dan bisa dipindai dari layar HP-mu di gerbang masuk maupun keluar.</p>
    </details>
    <details class="faq-item">
      <summary>Bagaimana kalau jaringan internet saya bermasalah di gerbang?</summary>
      <p>Kode QR-mu tetap bisa dipindai dalam mode offline selama masih tersimpan di aplikasi — proses verifikasi berjalan langsung di gerbang tanpa perlu koneksi baru saat itu.</p>
    </details>
  </div>
</section>

<section class="cta">
  <div class="cta-inner">
    <h2>Siap coba parkir tanpa muter-muter?</h2>
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