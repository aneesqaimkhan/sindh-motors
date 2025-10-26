<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Platinum Class Certificate</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root{
      --accent: rgba(200,200,200,0.85);
      --muted: rgba(200,200,200,0.65);
      --display: 'Montserrat', Arial, sans-serif;
    }

    html,body{
      height:100%;
      margin:0;
      font-family: Montserrat, Arial, sans-serif;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      background: #222; /* fallback */
    }

    /* Full page certificate wrapper */
    .certificate{
      box-sizing:border-box;
      width: 100%;
      height: 100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:4vh 5vw;
      background-image: var(--bg-image);
      background-repeat:no-repeat;
      background-position:center;
      background-size:contain;
    }

    /* content card is transparent so the background's border remains visible */
    .card{
      width: 90%;
      max-width: 1200px;
      min-height: 70vh;
      display:flex;
      flex-direction:column;
      align-items:center;
      justify-content:flex-start;
      padding:6vh 6vw;
      color:var(--accent);
      text-align:center;
      gap:1.6rem;
      position:relative;
    }

    .logo{
      width:96px;
      height:96px;
      border-radius:50%;
      border:3px solid rgba(200,200,200,0.18);
      display:flex;
      align-items:center;
      justify-content:center;
      margin-bottom:6px;
      backdrop-filter: blur(2px);
    }

    .logo svg{width:60px;height:60px;opacity:0.9}

    h1{
      font-size:48px;
      letter-spacing:2px;
      margin:0;
      font-weight:800;
      color:var(--accent);
      text-transform:uppercase;
    }

    .subtitle{
      font-size:18px;
      color:var(--muted);
      margin-top:6px;
    }

    .name{
      font-size:48px;
      margin:8px 0 0 0;
      font-weight:700;
      color:var(--accent);
    }

    .badge{
      display:inline-block;
      margin-top:14px;
      padding:12px 28px;
      border-radius:28px;
      border:2px solid rgba(200,200,200,0.18);
      font-weight:600;
      color:var(--accent);
      background:rgba(255,255,255,0.01);
    }

    .desc{
      max-width:900px;
      margin-top:18px;
      font-size:18px;
      color:var(--muted);
      line-height:1.6;
    }

    /* Bottom area with signature and organization text */
    .bottom{
      width:100%;
      margin-top:auto;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:1rem;
      padding-top:28px;
    }

    .sign{
      display:flex;
      flex-direction:column;
      align-items:flex-start;
      gap:8px;
    }

    .sign img{height:52px;object-fit:contain}

    .org{
      text-align:center;
      flex:1;
      font-size:20px;
      color:var(--accent);
      font-weight:600;
    }

    .footer-note{
      width:100%;
      margin-top:8px;
      font-size:16px;
      color:var(--muted);
      text-align:center;
    }

    .qr{
      width:88px;height:88px;
      border-radius:8px;
      background:#ddd; /* placeholder color - replace with actual QR image */
      opacity:0.12;
    }

    /* Responsive tweaks */
    @media (max-width:800px){
      h1{font-size:32px}
      .name{font-size:32px}
      .card{padding:4vh 3vw}
      .org{font-size:16px}
    }

    /* print as landscape by default */
    @media print{
      @page { size: A4 landscape; }
      html,body{height:auto}
      .certificate{padding:0}
      .card{box-shadow:none}
    }
  </style>
</head>
<body>
  <div class="certificate">
    <div class="card" role="main">

      <div class="logo" aria-hidden="true">
        <!-- simple car icon in circle to imitate original -->
        <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <circle cx="32" cy="32" r="30" stroke="rgba(200,200,200,0.18)" stroke-width="2"/>
          <rect x="14" y="26" width="36" height="14" rx="4" fill="rgba(200,200,200,0.06)" stroke="rgba(200,200,200,0.25)"/>
          <path d="M20 34h4M40 34h4" stroke="rgba(200,200,200,0.35)" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </div>

      <h1>Platinum Class Certificate</h1>
      <div class="subtitle">This certificate is proudly presented to</div>
      <div class="name">Ali Raza 1</div>
      <div class="badge">Platinum Member</div>

      <p class="desc">In recognition of their commitment to excellence in the automotive community and adherence to QCSA standards.</p>

      <div class="bottom" aria-label="certificate footer area">
        <div class="sign">
          <!-- Replace src with actual transparent signature image if you have one -->
          <img src="/mnt/data/signature_placeholder.png" alt="signature" onerror="this.style.display='none'">
          <div style="font-size:14px;color:var(--muted);">Muhammad Yaseen Behan<br><strong style="color:var(--accent);">PRESIDENT</strong></div>
        </div>

        <div class="org">
          Qasimabad Car Showroom Association<br>
          <span class="footer-note">Membership Certificate Distribution Ceremony</span>
        </div>

        <div style="display:flex;flex-direction:column;align-items:flex-end;gap:10px;">
          <div class="qr" aria-hidden="true"></div>
        </div>
      </div>

    </div>
  </div>
</body>
</html>
