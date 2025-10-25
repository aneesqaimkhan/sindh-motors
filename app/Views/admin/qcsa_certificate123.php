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
    }

    html, body{
      height:100%;
      background:#f5f6f8;
      font-family:'Poppins', system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji";
      color:var(--ink);
    }

    /* Certificate Canvas */
    .cert-wrapper{
      max-width: 1080px; /* Desktop preview width */
      margin: 20px auto;
      padding: 12px;
    }

    .certificate{
      position: relative;
      background: url('<?= base_url('public/assets/certificate/border.jpeg') ?>') no-repeat center center;
      background-size: 100% 100%;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 20px 50px rgba(0,0,0,.08);
      min-height: 800px;
      width: 100%;
    }

    /* Frame */
    .frame{
      position:relative; 
      margin:16px; 
      border-radius:12px; 
      padding:40px 50px; 
      background: #fff;
      z-index: 2;
    }

    .brand-bar{
      display:flex; align-items:center; justify-content:space-between; gap:10px; margin-bottom:5px;
    }
    .logo-circle{
      width:50px; height:50px; border-radius:50%; display:grid; place-items:center; color:white; font-weight:700; font-size:14px;
      background: linear-gradient(145deg, var(--green-1), var(--green-2));
      border:2px solid var(--gold);
      box-shadow: 0 4px 12px rgba(0,0,0,.12);
    }

    .brand-title{
      font-family:'Playfair Display', serif; letter-spacing:.5px; color:var(--green-1);
    }

    .headline{ font-family:'Playfair Display', serif; color:var(--gold); font-weight:700; letter-spacing:1px; }
    .subhead{ font-weight:700; color:var(--green-1); }

    .divider{ height:2px; background:linear-gradient(to right, transparent, var(--gold), transparent); margin:12px 0 16px; opacity:.8; }

    .recipient{
      font-family:'Playfair Display', serif; font-size:32px; color:var(--ink); line-height:1.2;
    }

    .badge{
      position:relative; display:inline-flex; align-items:center; justify-content:center; gap:6px; padding:8px 12px; border-radius:999px;
      background: linear-gradient(145deg, var(--gold-2), var(--gold)); color:#1b1b1b; font-weight:700; letter-spacing:.4px;
      border:2px solid #b99639; box-shadow:0 6px 18px rgba(201,166,72,.35); font-size:14px;
    }
    .badge svg{ width:18px; height:18px; }

    .meta-row{ margin-top:24px; }
    .meta-label{ font-size:11px; letter-spacing:1px; opacity:.8; }
    .meta-line{ border-bottom:2px dotted #c9d2d6; padding-bottom:4px; }

    /* Watermark car icon */
    .watermark{
      position:absolute; inset:0; display:grid; place-items:center; pointer-events:none; opacity:.06;
    }
    .watermark svg{ width:55%; max-width:520px; }

    .print-button {
      position: fixed;
      top: 20px;
      right: 20px;
      background: var(--green-1);
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 25px;
      cursor: pointer;
      font-weight: bold;
      box-shadow: 0 4px 12px rgba(11, 93, 77, 0.3);
      z-index: 1000;
    }

    .print-button:hover {
      background: var(--green-2);
      transform: translateY(-2px);
    }

    /* Print */
    @media print{
      @page {
        size: A4 landscape;
        margin: 5mm;
      }
      body{ 
        background:white; 
        margin:0; 
        padding:0; 
        font-size: 12px;
      }
      .cert-wrapper{ 
        margin:0; 
        padding:0; 
        max-width:100%; 
        height: 100vh;
      }
      .print-button, .btn-toolbar{ display:none !important; }
      .certificate{ 
        box-shadow:none; 
        border-radius:0; 
        page-break-inside:avoid;
        height: 100vh;
        width: 100%;
        overflow: hidden;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        background-size: 100% 100% !important;
      }
    }
  </style>
</head>
<body>
  <div class="cert-wrapper">

    <!-- Toolbar -->
    <div class="btn-toolbar justify-content-end gap-2 mb-3">
      <button class="btn btn-success" onclick="window.print()">
        Print / Download PDF
      </button>
    </div>

    <div class="certificate">
      <!-- All content removed - showing only border background image -->
    </div>
  </div>

  <!-- Script removed since content is not present -->
  <!--
  <script>
    // Fill current date by default
    const dateLine = document.getElementById('issueDateLine');
    const today = new Date();
    const y = today.getFullYear();
    const m = String(today.getMonth()+1).padStart(2,'0');
    const d = String(today.getDate()).padStart(2,'0');
    dateLine.textContent = `${d}-${m}-${y}`;
  </script>
  -->
</body>
</html>
