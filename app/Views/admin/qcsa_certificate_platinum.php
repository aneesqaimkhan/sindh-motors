<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $title ?> - Qasimabad Car Showrooms Association - Platinum</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Crimson+Text:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root{
      --green-1:#0b5d4d;   /* primary */
      --green-2:#0e7460;   /* dark accent */
      --mint:#e9f7f3;      /* light */
      --gold:#D3AF37;      /* rich gold - primary */
      --gold-2:#f4e4bc;    /* light gold - secondary */
      --gold-dark:#b8860b; /* dark gold for contrast */
      --silver:#E5F4E3;    /* light green color */
      --silver-dark:#C8E6C9; /* dark green */
      --ink:#1c1f24;
      --blue-1:#1e5ba8;    /* primary blue */
      --blue-2:#164a8c;    /* dark blue accent */
      --light-blue:#e8f2fb; /* light blue background */
      --platinum:#e5e4e2;  /* platinum color */
      --platinum-dark:#b8b6b3; /* dark platinum */
      --platinum-light:#f7f6f4; /* light platinum */
    }

    html, body{
      height:100%;
      background:#f5f6f8;
      font-family: serif;
      color:var(--ink);
    }

    /* Certificate Canvas */
    .cert-wrapper{
      max-width: 1123px; /* A4 landscape width: 297mm */
      margin: 20px auto;
      padding: 12px;
    }

    .certificate{
      position: relative;
      background: url('<?= base_url('public/assets/certificate/border-gold.jpeg') ?>') no-repeat center center;
      background-size: 100% 100%;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 20px 50px rgba(0,0,0,.08);
      width: 100%;
      height: 794px; /* A4 landscape height: 210mm */
      aspect-ratio: 297 / 210;
    }

    /* Frame */
    .frame{
      position:relative; 
      margin: 40px 50px; 
      border-radius: 8px; 
      padding: 25px 35px; 
      background: transparent;
      z-index: 2;
      height: calc(100% - 80px);
      overflow: hidden;
    }

    .brand-bar{
      display:flex; align-items:center; justify-content:space-between; gap:10px; margin-bottom:5px;
    }
    .logo-circle{
      width:50px; height:50px; border-radius:50%; display:grid; place-items:center; color:white; font-weight:700; font-size:14px;
      background: linear-gradient(145deg, var(--platinum-dark), var(--platinum));
      border:2px solid var(--gold);
      box-shadow: 0 4px 12px rgba(0,0,0,.12);
    }

    .brand-title{
      font-family: serif; 
      letter-spacing:.8px; 
      color:#ffffff; 
      font-weight:600;
    }

    .headline{ 
      font-family: serif; 
      color:#ffffff; 
      font-weight:700; 
    }
    .subhead{ 
      font-family: serif; 
      font-weight:600; 
      color:#ffffff; 
      letter-spacing:1px;
    }

    .divider{ 
      height:3px; 
      background:linear-gradient(to right, transparent, var(--gold-dark), var(--gold), var(--gold-dark), transparent); 
      margin:15px 0 20px; 
      opacity:.9; 
      border-radius:2px;
    }

    .recipient{
      font-family: serif; 
      font-size:32px; 
      color:#D3AF37; 
      line-height:1.2; 
      font-weight:600;
    }

    .badge{
      position:relative; display:inline-flex; align-items:center; justify-content:center; gap:6px; padding:8px 14px; border-radius:999px;
      background: #f8f8f8; color:var(--gold-dark); font-weight:700; letter-spacing:.4px;
      border:2px solid var(--silver-dark); box-shadow:0 6px 18px rgba(181,181,181,.35); font-size:14px;
    }
    .badge svg{ width:18px; height:18px; color:var(--gold-dark); fill:var(--gold-dark); }

    .meta-row{ margin-top:18px; }
    .meta-label{ font-size:11px; letter-spacing:1px; opacity:.8; }
    .meta-line{ border-bottom:2px dotted #c9d2d6; padding-bottom:4px; }

    .print-button {
      position: fixed;
      top: 20px;
      right: 20px;
      background: var(--platinum-dark);
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 25px;
      cursor: pointer;
      font-weight: bold;
      box-shadow: 0 4px 12px rgba(184, 182, 179, 0.3);
      z-index: 1000;
    }

    .print-button:hover {
      background: var(--platinum);
      transform: translateY(-2px);
    }

    /* Print - A4 Landscape (297mm × 210mm) - Match Browser Display */
    @media print{
      @page {
        size: A4 landscape;
        margin: 0;
      }
      html, body{ 
        background:white; 
        margin:0 !important; 
        padding:0 !important; 
        width: 297mm !important;
        height: 210mm !important;
        overflow: hidden !important;
      }
      .cert-wrapper{ 
        margin:0 auto !important; 
        padding:0 !important; 
        max-width:297mm !important;
        width: 297mm !important;
        height: 210mm !important;
        overflow: hidden !important;
      }
      .print-button, .btn-toolbar{ display:none !important; }
      .certificate{ 
        box-shadow:none !important; 
        border-radius: 12px !important;
        page-break-inside:avoid !important;
        page-break-after: avoid !important;
        page-break-before: avoid !important;
        width: 297mm !important;
        height: 210mm !important;
        max-height: 210mm !important;
        max-width: 297mm !important;
        margin: 0 !important;
        padding: 0 !important;
        overflow: hidden !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        color-adjust: exact;
        background-size: cover !important;
        background-position: center center !important;
        background-repeat: no-repeat !important;
        position: relative !important;
      }
      .frame{ 
        margin: 30px 40px !important; 
        padding: 20px 25px 60px 35px !important; 
        height: calc(100% - 60px) !important;
        border-radius: 8px !important;
        display: flex;
        flex-direction: column;
        justify-content: space-between !important;
        background: transparent !important;
        overflow: hidden !important;
      }
      /* Professional font sizes for print */
      .recipient{ 
        font-size: 28px !important; 
        line-height: 1.2 !important;
        color: #D3AF37 !important;
      }
      .headline{ 
        font-size: 42px !important;
        font-weight: 700 !important;
        letter-spacing: 1.5px !important;
        color: #ffffff !important;
      }
      .headline.display-6 {
        font-size: 42px !important;
        font-weight: 700 !important;
        letter-spacing: 1.5px !important;
        color: #ffffff !important;
      }
      .d-flex.align-items-center.justify-content-center.mb-3 {
        margin-top: 35px !important;
        margin-bottom: 10px !important;
      }
      .registration-number {
        font-size: 13px !important;
        padding-left: 10px !important;
        color: #ffffff !important;
      }
      .position-relative > div:last-child {
        padding-right: 10px !important;
      }
      .subhead{ 
        font-size: 17px !important;
        color: #ffffff !important;
      }
      .divider{ 
        margin: 8px 0 10px !important;
        height: 2px !important;
      }
      .meta-row{ 
        margin-top: 45px !important; 
      }
      .qr-code-img {
        width: 80px !important;
        height: 80px !important;
        object-fit: contain !important;
      }
      .meta-row .col-1 {
        flex: 0 0 auto !important;
        width: 8.33333333% !important;
      }
      .meta-row .col-3 {
        flex: 0 0 auto !important;
        width: 25% !important;
      }
      .meta-row .col-4 {
        flex: 0 0 auto !important;
        width: 33.33333333% !important;
      }
      .showroom-info-section {
        margin-top: 10px !important;
        margin-left: 35px !important;
        margin-right: 35px !important;
        padding: 15px 20px !important;
        background: linear-gradient(135deg, var(--gold-2), #f7f6f4) !important;
        border: 2px solid var(--gold) !important;
        border-radius: 8px !important;
      }
      .showroom-info-section h6 {
        color: var(--gold-dark) !important;
        font-family: serif !important;
        font-weight: 600 !important;
      }
      .showroom-info-section strong {
        color: var(--gold-dark) !important;
        font-family: serif !important;
        font-weight: 600 !important;
        letter-spacing: 0.5px !important;
      }
      .showroom-info-section span {
        color: var(--gold-dark) !important;
        font-family: serif !important;
        font-weight: 600 !important;
      }
      .showroom-info-section h6 {
        margin-bottom: 8px !important;
        font-size: 15px !important;
      }
      .showroom-info-section .row {
        margin: 0 !important;
      }
      .showroom-info-section .col-md-6 {
        margin-bottom: 4px !important;
        font-size: 13px !important;
        padding: 0 5px !important;
      }
      .showroom-info-section strong {
        min-width: 140px !important;
        font-size: 13px !important;
      }
      .showroom-info-section span {
        font-size: 13px !important;
      }
      p {
        font-size: 14px !important;
        margin-bottom: 5px !important;
      }
      .mb-1 {
        margin-bottom: 5px !important;
      }
      .badge {
        font-size: 14px !important;
        padding: 7px 13px !important;
        margin-top: 5px !important;
        background: #f8f8f8 !important;
        color: var(--gold-dark) !important;
        border: 2px solid var(--silver-dark) !important;
      }
      .badge svg {
        width: 16px !important;
        height: 16px !important;
        color: var(--gold-dark) !important;
        fill: var(--gold-dark) !important;
      }
      .position-relative {
        margin-bottom: 8px !important;
      }
      .position-relative > div {
        font-size: 16px !important;
      }
      .position-relative img {
        width: 260px !important;
        height: 130px !important;
      }
      .mb-2 {
        margin-bottom: 5px !important;
      }
      .mb-3 {
        margin-bottom: 8px !important;
      }
      .mt-1 {
        margin-top: 5px !important;
      }
      .mt-2 {
        margin-top: 6px !important;
      }
      .mt-3 {
        margin-top: 8px !important;
      }
      .h3 {
        font-size: 19px !important;
      }
      /* Brand title needs larger font - override .h3 */
      .brand-title{ 
        font-size: 26px !important;
        font-weight: 700 !important;
        color: #ffffff !important;
      }
      .brand-title.h3 {
        font-size: 26px !important;
        font-weight: 700 !important;
        color: #ffffff !important;
      }
      .h3.brand-title {
        font-size: 26px !important;
        font-weight: 700 !important;
        color: #ffffff !important;
      }
      .d-flex.align-items-center.justify-content-center.mb-3 .brand-title {
        font-size: 26px !important;
        font-weight: 700 !important;
        color: #ffffff !important;
      }
      .display-6 {
        font-size: 42px !important;
        font-weight: 700 !important;
        color: #ffffff !important;
      }
      .text-center .headline {
        font-size: 42px !important;
        font-weight: 700 !important;
        color: #ffffff !important;
      }
      .text-center .display-6 {
        font-size: 42px !important;
        font-weight: 700 !important;
        color: #ffffff !important;
      }
      div.headline {
        font-size: 42px !important;
        color: #ffffff !important;
      }
      .position-relative .headline.display-6 {
        font-size: 42px !important;
        font-weight: 700 !important;
        letter-spacing: 1.5px !important;
        color: #ffffff !important;
      }
      .fs-5 {
        font-size: 17px !important;
      }
      .g-2 {
        --bs-gutter-x: 0.6rem !important;
        --bs-gutter-y: 0.4rem !important;
      }
      .meta-label {
        font-size: 12px !important;
      }
      .small {
        font-size: 13px !important;
      }
      .text-muted {
        font-size: 13px !important;
        margin-bottom: 5px !important;
      }
      .d-flex.justify-content-between {
        font-size: 13px !important;
      }
      .p-2 {
        padding: 10px 12px !important;
      }
      
      /* Force CERTIFICATE heading to be large - Final Override */
      .headline,
      .headline.display-6,
      div.headline,
      .text-center .headline,
      .position-relative .headline {
        font-size: 42px !important;
        font-weight: 700 !important;
        letter-spacing: 1.5px !important;
        line-height: 1.2 !important;
        color: #ffffff !important;
      }
    }
  </style>
</head>
<body>
  <div class="cert-wrapper">

    <!-- Toolbar -->
    <div class="btn-toolbar justify-content-end gap-2 mb-3">
      <button class="btn btn-success" onclick="window.print()">
        Print / Download PDF 12
      </button>
    </div>

    <div class="certificate">
      <div class="frame">
        <div class="d-flex align-items-center justify-content-center">
          <div style="margin-top: 30px;" class="brand-title h4">Qasimabad Car Showrooms Association</div>
        </div>

        <div class="text-center mt-1">
          <div class="position-relative mb-2">
            <!-- Registration Number - Float Left -->
            <div class="registration-number" style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); font-size: 16px; font-weight: bold; color: #ffffff; font-family: serif; letter-spacing: 0.5px; padding-left: 10px;">
              Registration #: <?= esc($showroom['showroom_registration_number'] ?? '') ?>
            </div>
            
            <!-- Certificate Headline - Center -->
            <div style="font-size: 2.0rem !important; font-weight: 700 !important;  !important; line-height: 1.2 !important;" class="headline display-6 m-0">PLATINUM CERTIFICATE</div>
            
            <!-- Award Logo - Float Right -->

            <div style="position: absolute; right: 50px; top: 60%; transform: translateY(-50%);">
              <img src="<?= base_url('public/assets/certificate/award-gold.png') ?>" alt="Award Badge" style="width: 300px; height: 150px; object-fit: contain;">
            </div>
            
          </div>
          <div class="subhead fs-5" style="margin-top: 20px; margin-bottom: 20px;">OF PLATINUM REGISTRATION</div>
          <div class="divider"></div>
          <p class="mb-2" style="color: #ffffff; font-family: serif; font-weight: 500; letter-spacing: 0.5px;">This certificate is proudly presented to</p>
          <p class="mb-2" style="color: #ffffff; font-family: serif; font-weight: 500; letter-spacing: 0.5px;">Platinum Showroom Registration Awarded To</p>
          <div class="recipient" id="recipientName"><?= esc($showroom['name']) ?></div>
          <p class="mt-2 mb-1" style="color: #ffffff; font-family: serif; font-weight: 500; letter-spacing: 0.3px; line-height: 1.4;">In recognition of their exceptional commitment to excellence in the automotive community and adherence to QCSA Platinum standards.</p>
          <span class="badge mt-1">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l2.39 4.84 5.34.78-3.86 3.77.91 5.31L12 14.77 7.22 16.7l.91-5.31L4.27 7.62l5.34-.78L12 2z" stroke="currentColor" stroke-width="2"/></svg>
            QCSA - Platinum Member
          </span>
        </div>

        <!-- Showroom Details Section -->
        <div class="mt-3 p-3 showroom-info-section" style="background: linear-gradient(135deg, var(--gold-2), #f7f6f4); border-radius: 8px; border: 2px solid var(--gold); margin: 0 35px;">
          <h6 class="text-center mb-2" style="color: var(--gold-dark); font-weight: 600; font-family: serif; letter-spacing: 0.5px;">Platinum Showroom Information</h6>
          <div class="row g-2">
            <div class="col-md-6">
              <div class="d-flex align-items-center">
                <strong style="color: var(--gold-dark); min-width: 140px; font-family: serif; font-weight: 600; letter-spacing: 0.5px;">CNIC No:</strong>
                <span style="color: var(--gold-dark); font-family: serif; font-weight: 600;"><?= esc($showroom['cnic_no'] ?? '') ?></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-flex align-items-center">
                <strong style="color: var(--gold-dark); min-width: 140px; font-family: serif; font-weight: 600; letter-spacing: 0.5px;">Mobile Number:</strong>
                <span style="color: var(--gold-dark); font-family: serif; font-weight: 600;"><?= esc($showroom['cell_no'] ?? $showroom['phone'] ?? '') ?></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-flex align-items-center">
                <strong style="color: var(--gold-dark); min-width: 140px; font-family: serif; font-weight: 600; letter-spacing: 0.5px;">Showroom Name:</strong>
                <span style="color: var(--gold-dark); font-family: serif; font-weight: 600;"><?= esc($showroom['showroom_name'] ?? '') ?></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-flex align-items-center">
                <strong style="color: var(--gold-dark); min-width: 140px; font-family: serif; font-weight: 600; letter-spacing: 0.5px;">Address:</strong>
                <span style="color: var(--gold-dark); font-family: serif; font-weight: 600;"><?= esc($showroom['showroom_address'] ?? '') ?></span>
              </div>
            </div>
          </div>
        </div>

        <div style="margin-top: 5px;" class="row g-3 align-items-end">
          <div class="col-1"></div>
          <div class="col-4">
            <div class="text-center mb-2">
              <img src="<?= base_url('public/assets/signature/signature-white.png') ?>" alt="Signature" style="width: 80px;/* height: auto; */object-fit: contain;display: block;margin-top: -20px;">
            </div>
            <div class="meta-line"></div>
            <div class="meta-label" style="color: #ffffff; font-family: serif; font-weight: 600; letter-spacing: 0.5px;">Signature</div>
            <div class="small mt-2" style="color: var(--silver); font-family: serif; font-weight: 500;">Muhammad Yaseen Beharn (PRESIDENT)</div>
          </div>
          <div class="col-3 ps-3">
            
            <div class="small mt-2" id="issueDateLine" style="color: var(--silver); font-family: 'Crimson Text', serif; font-weight: 500;"></div>
            <div class="meta-line"></div>
            <div class="meta-label" style="color: #ffffff; font-family: serif; font-weight: 600; letter-spacing: 0.5px;">Date</div>
             <div class="small mt-2" id="" style="visibility: hidden;">      -</div>
          </div>
          <div class="col-4 text-center">
            <img src="<?= base_url('admin/qrcode/' . $showroom['id']) ?>" alt="Showroom QR Code" class="qr-code-img" style="width: 90px; height: 90px; object-fit: contain;">
            <!-- <div class="meta-label mt-1">QR Code</div> -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Fill current date by default
    const dateLine = document.getElementById('issueDateLine');
    const today = new Date();
    const y = today.getFullYear();
    const m = String(today.getMonth()+1).padStart(2,'0');
    const d = String(today.getDate()).padStart(2,'0');
    dateLine.textContent = `${d}-${m}-${y}`;
  </script>
</body>
</html>
