<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $title ?> - Qasimabad Car Showrooms Association</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root{
      --green-1:#0b5d4d;   /* primary */
      --green-2:#0e7460;   /* dark accent */
      --mint:#e9f7f3;      /* light */
      --gold:#c9a648;      /* gold */
      --gold-2:#e6c879;    /* soft gold */
      --ink:#1c1f24;
      --blue-1:#1e5ba8;    /* primary blue */
      --blue-2:#164a8c;    /* dark blue accent */
      --light-blue:#e8f2fb; /* light blue background */
    }

    html, body{
      height:100%;
      background:#f5f6f8;
      font-family:'Poppins', system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji";
      color:var(--ink);
    }

    /* Membership Card Canvas */
    .card-wrapper{
      max-width: 400px; /* Standard card width */
      margin: 20px auto;
      padding: 12px;
    }

    .membership-card{
      position: relative;
      background: url('<?= base_url('public/assets/certificate/border.jpeg') ?>') no-repeat center center;
      background-size: 100% 100%;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 20px 50px rgba(0,0,0,.08);
      width: 100%;
      height: 250px; /* Standard card height */
      aspect-ratio: 1.6 / 1;
    }

    /* Frame */
    .frame{
      position:relative; 
      margin: 20px 25px; 
      border-radius: 8px; 
      padding: 15px 20px; 
      background: transparent;
      z-index: 2;
      height: calc(100% - 40px);
      overflow: hidden;
    }

    .brand-bar{
      display:flex; align-items:center; justify-content:space-between; gap:10px; margin-bottom:5px;
    }
    .logo-circle{
      width:40px; height:40px; border-radius:50%; display:grid; place-items:center; color:white; font-weight:700; font-size:12px;
      background: linear-gradient(145deg, var(--blue-1), var(--blue-2));
      border:2px solid var(--gold);
      box-shadow: 0 4px 12px rgba(0,0,0,.12);
    }

    .brand-title{
      font-family:'Playfair Display', serif; letter-spacing:.5px; color:var(--blue-1); font-size:14px;
    }

    .headline{ font-family:'Playfair Display', serif; color:var(--gold); font-weight:700; letter-spacing:1px; font-size:18px; }
    .subhead{ font-weight:700; color:var(--blue-1); font-size:12px; }

    .divider{ height:2px; background:linear-gradient(to right, transparent, var(--gold), transparent); margin:8px 0 10px; opacity:.8; }

    .member-name{
      font-family:'Playfair Display', serif; font-size:20px; color:var(--ink); line-height:1.3; font-weight:600;
    }

    .badge{
      position:relative; display:inline-flex; align-items:center; justify-content:center; gap:4px; padding:6px 10px; border-radius:999px;
      background: linear-gradient(145deg, var(--gold-2), var(--gold)); color:#1b1b1b; font-weight:700; letter-spacing:.4px;
      border:2px solid #b99639; box-shadow:0 4px 12px rgba(201,166,72,.35); font-size:11px;
    }
    .badge svg{ width:14px; height:14px; }

    .meta-row{ margin-top:12px; }
    .meta-label{ font-size:9px; letter-spacing:1px; opacity:.8; }
    .meta-line{ border-bottom:2px dotted #c9d2d6; padding-bottom:2px; }

    .print-button {
      position: fixed;
      top: 20px;
      right: 20px;
      background: var(--blue-1);
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 25px;
      cursor: pointer;
      font-weight: bold;
      box-shadow: 0 4px 12px rgba(30, 91, 168, 0.3);
      z-index: 1000;
    }

    .print-button:hover {
      background: var(--blue-2);
      transform: translateY(-2px);
    }

    /* Print - Card Size */
    @media print{
      @page {
        size: A6;
        margin: 0;
      }
      html, body{ 
        background:white; 
        margin:0 !important; 
        padding:0 !important; 
        width: 105mm !important;
        height: 148mm !important;
        overflow: hidden !important;
      }
      .card-wrapper{ 
        margin:0 auto !important; 
        padding:0 !important; 
        max-width:105mm !important;
        width: 105mm !important;
        height: 148mm !important;
        overflow: hidden !important;
      }
      .print-button, .btn-toolbar{ display:none !important; }
      .membership-card{ 
        box-shadow:none !important; 
        border-radius: 12px !important;
        page-break-inside:avoid !important;
        page-break-after: avoid !important;
        page-break-before: avoid !important;
        width: 105mm !important;
        height: 148mm !important;
        max-height: 148mm !important;
        max-width: 105mm !important;
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
        margin: 15px 20px !important; 
        padding: 12px 15px 30px 20px !important; 
        height: calc(100% - 30px) !important;
        border-radius: 8px !important;
        display: flex;
        flex-direction: column;
        justify-content: space-between !important;
        background: transparent !important;
        overflow: hidden !important;
      }
      /* Professional font sizes for print */
      .member-name{ 
        font-size: 18px !important; 
        line-height: 1.2 !important;
      }
      .headline{ 
        font-size: 16px !important;
        font-weight: 700 !important;
        letter-spacing: 1px !important;
      }
      .subhead{ 
        font-size: 10px !important;
      }
      .divider{ 
        margin: 6px 0 8px !important;
        height: 2px !important;
      }
      .meta-row{ 
        margin-top: 20px !important; 
      }
      .qr-code-img {
        width: 50px !important;
        height: 50px !important;
        object-fit: contain !important;
      }
      .badge {
        font-size: 10px !important;
        padding: 4px 8px !important;
        margin-top: 3px !important;
      }
      .badge svg {
        width: 12px !important;
        height: 12px !important;
      }
      .brand-title{ 
        font-size: 12px !important;
        font-weight: 700 !important;
      }
      .meta-label {
        font-size: 8px !important;
      }
      .small {
        font-size: 9px !important;
      }
    }
  </style>
</head>
<body>
  <div class="card-wrapper">

    <!-- Toolbar -->
    <div class="btn-toolbar justify-content-end gap-2 mb-3">
      <button class="btn btn-success" onclick="window.print()">
        Print / Download PDF
      </button>
    </div>

    <div class="membership-card">
      <div class="frame">
        <div class="d-flex align-items-center justify-content-center mb-2">
          <div class="brand-title h6 m-0">Qasimabad Car Showrooms Association</div>
        </div>

        <div class="text-center mt-1">
          <div class="position-relative mb-2">
            <!-- Registration Number - Float Left -->
            <div class="registration-number" style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); font-size: 10px; font-weight: bold; color: var(--blue-1); padding-left: 5px;">
              Reg #: <?= esc($member['member_registration_number'] ?? '') ?>
            </div>
            
            <!-- Membership Card Headline - Center -->
            <div class="headline m-0">MEMBERSHIP CARD</div>
            
            <!-- Award Logo - Float Right -->
            <div style="position: absolute; right: 0; top: 50%; transform: translateY(-50%);">
              <img src="<?= base_url('public/assets/certificate/award.png') ?>" alt="Award Badge" style="width: 80px; height: 40px; object-fit: contain;">
            </div>
          </div>
          <div class="subhead">MEMBER ID</div>
          <div class="divider"></div>
          <p class="mb-1" style="font-size: 11px;">This card is issued to</p>
          <div class="member-name" id="memberName"><?= esc($member['member_name']) ?></div>
          <p class="mt-1 mb-1 text-muted" style="font-size: 10px;">Son of <?= esc($member['father_name']) ?></p>
          <span class="badge mt-1">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l2.39 4.84 5.34.78-3.86 3.77.91 5.31L12 14.77 7.22 16.7l.91-5.31L4.27 7.62l5.34-.78L12 2z" stroke="currentColor" stroke-width="2"/></svg>
            QCSA Member
          </span>
        </div>

        <div class="row meta-row g-2 align-items-end">
          <div class="col-6">
            <div class="text-center mb-1">
              <img src="<?= base_url('public/assets/signature/signature.png') ?>" alt="Signature" style="width: 40px; object-fit: contain; display: block; margin-top: -10px;">
            </div>
            <div class="meta-line"></div>
            <div class="meta-label">Signature</div>
            <div class="small mt-1">Muhammad Yaseen Beharn (PRESIDENT)</div>
          </div>
          <div class="col-6 text-center">
            <img src="<?= base_url('admin/qrcode/' . $member['id']) ?>" alt="Member QR Code" class="qr-code-img" style="width: 45px; height: 45px; object-fit: contain;">
            <div class="meta-label mt-1">QR Code</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Fill current date by default
    const today = new Date();
    const y = today.getFullYear();
    const m = String(today.getMonth()+1).padStart(2,'0');
    const d = String(today.getDate()).padStart(2,'0');
    // Date can be added to the card if needed
  </script>
</body>
</html>
