<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    @vite('resources/css/app.css')
<title>Masuk — Loka</title>
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
    --error: #B84A32;
  }
  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}
  body{
    font-family:'Inter', sans-serif;
    color:var(--ink);
    background:var(--concrete);
    min-height:100vh;
  }
  h1,h2,.disp{ font-family:'Oswald', sans-serif; text-transform:uppercase; letter-spacing:0.01em; }
  a{ color:inherit; }

  .wrap{
    display:grid;
    grid-template-columns:1fr 1fr;
    min-height:100vh;
  }

  /* LEFT — brand panel */
  .brand{
    background:var(--asphalt);
    color:var(--white-line);
    position:relative;
    overflow:hidden;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    padding:44px 56px;
  }
  .logo{
    font-family:'Oswald', sans-serif;
    font-size:21px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:0.02em;
    display:flex;
    align-items:center;
    gap:8px;
    text-decoration:none;
    color:var(--white-line);
    z-index:2;
  }
  .logo .dot{ width:9px;height:9px;background:var(--yellow); display:inline-block; }

  .brand-copy{ max-width:420px; z-index:2; }
  .brand-copy h1{
    font-size:clamp(30px, 3.2vw, 42px);
    line-height:1.1;
    font-weight:600;
    margin:0 0 16px;
  }
  .brand-copy h1 .yellow{ color:var(--yellow); }
  .brand-copy p{
    text-transform:none;
    font-family:'Inter', sans-serif;
    font-size:15.5px;
    line-height:1.6;
    color:#C9C7C0;
    margin:0;
    max-width:360px;
  }

  .bay-art{
    position:absolute;
    inset:0;
    z-index:1;
    opacity:0.9;
  }
  .bay-art path{
    fill:none;
    stroke:#3A3936;
    stroke-width:2;
    stroke-linecap:square;
    stroke-dasharray:1200;
    stroke-dashoffset:1200;
    animation:paint 2s ease forwards;
  }
  .bay-art path.hi{ stroke:#3D3B36; }
  .bay-art path:nth-child(1){animation-delay:.1s;}
  .bay-art path:nth-child(2){animation-delay:.35s;}
  .bay-art path:nth-child(3){animation-delay:.6s;}
  .bay-art path:nth-child(4){animation-delay:.85s;}
  .bay-art path:nth-child(5){animation-delay:1.1s;}
  @keyframes paint{ to{ stroke-dashoffset:0; } }
  @media (prefers-reduced-motion:reduce){ .bay-art path{ animation:none; stroke-dashoffset:0; } }

  .brand-stats{
    display:flex;
    gap:36px;
    z-index:2;
    border-top:1px solid #43423E;
    padding-top:22px;
  }
  .brand-stats .num{ font-family:'Oswald', sans-serif; font-size:22px; font-weight:600; color:var(--yellow); }
  .brand-stats .lbl{ font-size:11.5px; color:#A9A79F; text-transform:none; margin-top:2px; }

  /* RIGHT — form panel */
  .panel{
    display:flex;
    align-items:center;
    justify-content:center;
    padding:48px 32px;
  }
  .form-col{ width:100%; max-width:380px; }
  .form-col h2{
    font-size:27px;
    font-weight:600;
    margin:0 0 6px;
  }
  .form-col .sub{
    text-transform:none;
    color:var(--muted);
    font-size:14.5px;
    margin:0 0 36px;
  }
  .form-col .sub a{ color:var(--ink); font-weight:600; text-decoration:none; border-bottom:1.5px solid var(--yellow); }
  .form-col .sub a:hover{ color:var(--ink); }

  .field{ position:relative; margin-bottom:26px; }
  .field input{
    width:100%;
    border:none;
    border-bottom:1.5px solid var(--line);
    background:transparent;
    padding:14px 2px 10px;
    font-size:15.5px;
    font-family:'Inter', sans-serif;
    color:var(--ink);
    outline:none;
    transition:border-color .18s ease;
  }
  .field input:focus{ border-bottom-color:var(--asphalt); }
  .field input:focus-visible{ outline:2px solid var(--yellow); outline-offset:3px; }
  .field label{
    position:absolute;
    left:2px; top:14px;
    font-size:15.5px;
    color:var(--muted);
    pointer-events:none;
    transition:transform .16s ease, font-size .16s ease, color .16s ease;
    transform-origin:left top;
  }
  .field input:focus + label,
  .field input:not(:placeholder-shown) + label{
    transform:translateY(-14px);
    font-size:12px;
    color:var(--ink);
  }
  .field .toggle-pass{
    position:absolute;
    right:2px; top:14px;
    background:none; border:none;
    font-size:12.5px; font-weight:600;
    color:var(--muted);
    cursor:pointer; padding:2px 0;
  }
  .field .toggle-pass:hover{ color:var(--ink); }
  .field .err{ display:none; font-size:12.5px; color:var(--error); margin-top:6px; }
  .field.invalid input{ border-bottom-color:var(--error); }
  .field.invalid .err{ display:block; }

  .row-between{
    display:flex; align-items:center; justify-content:space-between;
    margin:-6px 0 28px; font-size:13.5px;
  }
  .remember{ display:flex; align-items:center; gap:8px; color:var(--muted); }
  .remember input{ accent-color:var(--asphalt); width:15px; height:15px; }
  .row-between a{ color:var(--ink); text-decoration:none; font-weight:600; border-bottom:1.5px solid var(--yellow); }

  .btn-primary{
    width:100%;
    background:var(--asphalt);
    color:var(--white-line);
    border:none;
    padding:14px 0;
    font-family:'Oswald', sans-serif;
    text-transform:uppercase;
    letter-spacing:0.02em;
    font-size:14.5px;
    font-weight:600;
    border-radius:2px;
    cursor:pointer;
    transition:background .18s ease, transform .08s ease;
  }
  .btn-primary:hover{ background:#0F0E0D; }
  .btn-primary:active{ transform:scale(0.99); }
  .btn-primary:focus-visible{ outline:2px solid var(--yellow); outline-offset:3px; }

  .divider{
    display:flex; align-items:center; gap:14px;
    margin:28px 0; color:var(--muted); font-size:12.5px; text-transform:none;
  }
  .divider::before, .divider::after{ content:""; flex:1; height:1px; background:var(--line); }
  .btn-alt{
    width:100%;
    background:var(--parchment);
    border:1.5px solid var(--line);
    color:var(--ink);
    padding:12px 0;
    font-size:14.5px;
    font-weight:600;
    font-family:'Public Sans', sans-serif;
    border-radius:3px;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    transition:border-color .18s ease, background .18s ease;
  }
  .btn-dash{
    width:100%;
    background:transparent;
    border:1.5px solid var(--asphalt);
    color:var(--ink);
    padding:12.5px 0;
    font-family:'Oswald', sans-serif;
    text-transform:uppercase;
    letter-spacing:0.02em;
    font-size:14px;
    font-weight:600;
    border-radius:2px;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    text-decoration:none;
    transition:background .18s ease, color .18s ease;
  }
  .btn-dash:hover{ background:var(--asphalt); color:var(--white-line); }
  .btn-dash svg{ width:16px; height:16px; }
  .btn-dash svg path, .btn-dash svg rect{ fill:none; stroke:currentColor; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; }

  @media (max-width:860px){
    .wrap{ grid-template-columns:1fr; }
    .brand{ display:none; }
    .panel{ padding:40px 24px; }
  }
</style>
</head>
<body>
   <div class="wrap">

  <div class="brand">
 <div class="logo"><span class="dot"></span>login</div>

    <svg class="bay-art" viewBox="0 0 600 800" preserveAspectRatio="xMidYMax slice">
      <path d="M150 780 L150 40" />
      <path d="M300 780 L300 40" />
      <path d="M450 780 L450 40" />
      <path class="hi" d="M40 300 L560 300" />
      <path class="hi" d="M40 560 L560 560" />
    </svg>

    <div class="brand-copy">
      <h1>Masuk untuk lanjutkan reservasi <span class="yellow">slot parkirmu.</span></h1>
      <p>Kelola reservasi, riwayat pembayaran, dan kendaraan tersimpan dari satu akun.</p>
    </div>

    <div class="brand-stats">
      <div>
        <div class="num">128</div>
        <div class="lbl">Lokasi terhubung</div>
      </div>
      <div>
        <div class="num">2.400+</div>
        <div class="lbl">Slot terpantau langsung</div>
      </div>
    </div>
  </div>

  <div class="panel">
    <div class="form-col">
      <h2>Selamat datang kembali</h2>
      <p class="sub">Belum punya akun? <a href="#">Daftar di sini</a></p>

      <form id="loginForm" novalidate>
        <div class="field" id="emailField">
          <input type="email" id="email" placeholder=" " autocomplete="email" required>
          <label for="email">Alamat email</label>
          <div class="err">Masukkan alamat email yang valid.</div>
        </div>

        <div class="field" id="passField">
          <input type="password" id="password" placeholder=" " autocomplete="current-password" required>
          <label for="password">Kata sandi</label>
          <button type="button" class="toggle-pass" id="togglePass">Tampilkan</button>
          <div class="err">Kata sandi wajib diisi.</div>
        </div>

        <div class="row-between">
          <label class="remember">
            <input type="checkbox">
            Ingat saya
          </label>
          <a href="#">Lupa kata sandi?</a>
        </div>

        <button type="submit" class="btn-primary">Masuk</button>
      </form>

      <div class="divider">atau</div>

      <button type="button" class="btn-alt">
        <svg width="17" height="17" viewBox="0 0 18 18"><path fill="#4285F4" d="M17.64 9.2c0-.64-.06-1.25-.16-1.84H9v3.48h4.84c-.21 1.13-.85 2.09-1.81 2.73v2.27h2.93c1.71-1.58 2.69-3.9 2.69-6.64z"/><path fill="#34A853" d="M9 18c2.43 0 4.47-.8 5.96-2.18l-2.93-2.27c-.81.54-1.85.86-3.03.86-2.33 0-4.3-1.57-5.01-3.68H.94v2.34C2.42 16.02 5.48 18 9 18z"/><path fill="#FBBC05" d="M3.99 10.73c-.18-.54-.28-1.11-.28-1.73s.1-1.19.28-1.73V4.93H.94A8.97 8.97 0 000 9c0 1.45.35 2.83.94 4.07l3.05-2.34z"/><path fill="#EA4335" d="M9 3.58c1.32 0 2.51.45 3.44 1.35l2.6-2.6C13.46.89 11.43 0 9 0 5.48 0 2.42 1.98.94 4.93l3.05 2.34C4.7 5.15 6.67 3.58 9 3.58z"/></svg>
        Google
      </a>
    </div>
  </div>

</div>

<script>
  const form = document.getElementById('loginForm');
  const email = document.getElementById('email');
  const password = document.getElementById('password');
  const emailField = document.getElementById('emailField');
  const passField = document.getElementById('passField');
  const toggle = document.getElementById('togglePass');

  toggle.addEventListener('click', () => {
    const isPass = password.type === 'password';
    password.type = isPass ? 'text' : 'password';
    toggle.textContent = isPass ? 'Sembunyikan' : 'Tampilkan';
  });

  function validEmail(v){
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
  }

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    let ok = true;

    if(!validEmail(email.value)){
      emailField.classList.add('invalid');
      ok = false;
    } else {
      emailField.classList.remove('invalid');
    }

    if(password.value.trim() === ''){
      passField.classList.add('invalid');
      ok = false;
    } else {
      passField.classList.remove('invalid');
    }

    if(ok){
      window.location.href = 'dashboard.html';
    }
  });

  [email, password].forEach(el => {
    el.addEventListener('input', () => {
      el.closest('.field').classList.remove('invalid');
    });
  });
</script>
</body>
</html>