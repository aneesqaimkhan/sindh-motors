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
      background-image: url('<?= base_url('public/assets/certificate/border-img.png') ?>');
      background-repeat: no-repeat;
      background-position: center;
      background-size: contain;
    }

    /* content card is transparent so the background's border remains visible */
    .card{
      width: 70%;
      max-width: 900px;
      min-height: 55vh;
      display:flex;
      flex-direction:column;
      align-items:center;
      justify-content:flex-start;
      padding:3vh 3vw;
      color:var(--accent);
      text-align:center;
      gap:0.5rem;
      position:relative;
    }

    .logo{
      width:80px;
      height:80px;
      display:flex;
      align-items:center;
      justify-content:center;
      margin-bottom:2px;
      backdrop-filter: blur(2px);
    }


    h1{
      font-size:36px;
      letter-spacing:2px;
      margin:0;
      font-weight:800;
      color:var(--accent);
      text-transform:uppercase;
      line-height:1.0;
    }

    .subtitle{
      font-size:18px;
      color:var(--muted);
      margin-top:2px;
      line-height:1.0;
    }

    .name{
      font-size:48px;
      margin:4px 0 0 0;
      font-weight:700;
      color:var(--accent);
      line-height:1.0;
    }

    .badge{
      display:inline-block;
      margin-top:8px;
      padding:8px 20px;
      border-radius:28px;
      border:2px solid rgba(200,200,200,0.18);
      font-weight:600;
      color:var(--accent);
      background:rgba(255,255,255,0.01);
      line-height:1.0;
    }

    .desc{
      max-width:900px;
      margin-top:10px;
      font-size:18px;
      color:var(--muted);
      line-height:1.1;
    }

    /* Showroom details box */
    .showroom-details{
      width:700px;
      margin-top:6px;
      padding:12px 20px;
      border:2px solid rgba(200,200,200,0.15);
      border-radius:12px;
      background:rgba(255,255,255,0.02);
      backdrop-filter: blur(1px);
    }

    .showroom-details h3{
      font-size:20px;
      font-weight:600;
      color:var(--accent);
      margin:0 0 8px 0;
      text-align:center;
      line-height:1.0;
    }

    .details-grid{
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:4px 15px;
      text-align:left;
    }

    .detail-item{
      display:flex;
      flex-direction:column;
      gap:1px;
    }

    .detail-label{
      font-size:14px;
      color:var(--muted);
      font-weight:500;
      line-height:1.0;
    }

    .detail-value{
      font-size:16px;
      color:var(--accent);
      font-weight:600;
      line-height:1.0;
    }

    /* Bottom area with signature and organization text */
    .bottom{
      width:100%;
      margin-top:auto;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:0.5rem;
      padding-top:15px;
    }

    .sign{
      display:flex;
      flex-direction:column;
      align-items:flex-start;
      gap:4px;
    }

    .sign img{height:52px;object-fit:contain}

    .org{
      text-align:center;
      flex:1;
      font-size:20px;
      color:var(--accent);
      font-weight:600;
      line-height:1.0;
    }

    .footer-note{
      width:100%;
      margin-top:4px;
      font-size:16px;
      color:var(--muted);
      text-align:center;
      line-height:1.0;
    }

    .qr{
      width:88px;height:88px;
      border-radius:8px;
      background:#ddd; /* placeholder color - replace with actual QR image */
      opacity:0.12;
    }

    /* Browser view adjustments */
    @media screen {
      .certificate {
        padding: 2vh 3vw;
        /* Ensure background image is visible in browser */
        background-attachment: scroll;
      }
      .card {
        width: 65%;
        max-width: 800px;
        min-height: 50vh;
        padding: 2vh 2vw;
      }
    }

    /* Responsive tweaks */
    @media (max-width:800px){
      h1{font-size:32px}
      .name{font-size:32px}
      .card{padding:4vh 3vw}
      .org{font-size:16px}
      .showroom-details{
        width:90%;
        max-width:600px;
        padding:10px 15px;
        margin-top:4px;
      }
      .showroom-details h3{
        font-size:18px;
      }
      .details-grid{
        grid-template-columns:1fr;
        gap:3px 10px;
      }
      .detail-value{
        font-size:15px;
      }
    }

    /* print as landscape by default */
    @media print{
      @page { 
        size: A4 landscape;
        margin: 0;
      }
      html,body{height:auto}
      .certificate{padding:0}
      .card{box-shadow:none}
      
      /* Hide print details */
      @page {
        margin: 0;
        padding: 0;
      }
      
      /* Remove any browser print headers/footers */
      body {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }
    }
  </style>
</head>
<body>
  <div class="certificate" style="background-image: url('<?= base_url('public/assets/certificate/border-img.png') ?>');">
    <div class="card" role="main">

      <div class="logo" aria-hidden="true">
        <!-- simple car icon in circle to imitate original -->
        <img src="<?= base_url('public/assets/certificate/car-logo.png') ?>" alt="Award Badge" style="width: 240px; height: 120px; object-fit: contain;">
      </div>

      <h1>Platinum Class Certificate</h1>
      <div class="subtitle">This certificate is proudly presented to</div>
      <div class="name"><?= esc($showroom['name']) ?></div>
      <div class="badge">Platinum Member</div>

      <p class="desc">In recognition of their commitment to excellence in the automotive community and adherence to QCSA standards.</p>
      <div class="showroom-details">
        <h3>Showroom Details</h3>
        <div class="details-grid">
          <div class="detail-item">
            <div class="detail-label">Showroom Name</div>
            <div class="detail-value"><?= esc($showroom['name']) ?></div>
          </div>
          <div class="detail-item">
            <div class="detail-label">CNIC</div>
            <div class="detail-value"><?= esc($showroom['cnic_no'] ?? 'N/A') ?></div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Mobile Number</div>
            <div class="detail-value"><?= esc($showroom['cell_no'] ?? 'N/A') ?></div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Address</div>
            <div class="detail-value"><?= esc($showroom['showroom_address'] ?? 'N/A') ?></div>
          </div>
        </div>
      </div>

      <div class="bottom" aria-label="certificate footer area">
        <div class="sign">
          <!-- Replace src with actual transparent signature image if you have one -->
          <img style=" 
    width: 115px !important; 
    height: 108px !important;
    margin-left: 30px !important;
    margin-top: -50px !important;
" src="<?= base_url('public/assets/signature/signature-white.png') ?>" alt="signature" onerror="this.style.display='none'">
          <div style="font-size:14px;color:var(--muted);">Muhammad Yaseen Behan<br><strong style="color:var(--accent);">PRESIDENT</strong></div>
        </div>

        <div class="org">
          Qasimabad Car Showroom Association<br>
          <span class="footer-note">Membership Certificate Distribution Ceremony</span>
        </div>

        <div style="display:flex;flex-direction:column;align-items:flex-end;gap:5px;">
          <div class="qr" aria-hidden="true">
          <img src="<?= base_url('admin/qrcode/' . $showroom['id']) ?>" alt="Showroom QR Code" class="qr-code-img" style="width: 90px; height: 90px; object-fit: contain;">
          </div>
        </div>
      </div>

    </div>
  </div>
</body>
</html>
