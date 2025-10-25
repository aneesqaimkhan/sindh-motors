<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Qasimabad Car Showrooms Association Card (Back)</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background:#e9ecef;
      display:flex;
      justify-content:center;
      align-items:center;
      height:100vh;
    }

    .id-card-back {
      width:450px;
      height:270px;
      border-radius:10px;
      background:linear-gradient(to bottom,#b78b29,#f0c75e);
      color:#000;
      position:relative;
      overflow:hidden;
      box-shadow:0 4px 10px rgba(0,0,0,0.3);
      padding:30px 18px;
      text-align:center;
    }

    /* --- Top & Bottom Strips --- */
    .top-strip,
    .bottom-strip {
      position:absolute;
      left:0;
      right:0;
      height:25px;
      background-repeat:no-repeat;
      background-position:center;
      background-size:cover;
      z-index:2;
    }
    .top-strip {
      top:0;
      background-image:url('<?= base_url('public/assets/card/ajrak1.jpg') ?>');
    }
    .bottom-strip {
      bottom:0;
      background-image:url('<?= base_url('public/assets/card/ajrak1.jpg') ?>');
    }

    /* --- Three Logos Row --- */
    .logo-row {
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-top:0px;
      padding:0 10px;
      position:relative;
      z-index:3;
    }
    .logo-row img {
      width:70px;
      height:auto;
      object-fit:contain;
    }

    /* --- Association Title --- */
    .association-text {
      font-weight:bold;
      font-size:16px;
      margin-top:12px;
      color:#000;
      letter-spacing:0.5px;
      z-index:3;
      position:relative;
    }

    /* --- QR Code and Validity Row --- */
    .bottom-row {
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-top:-4px;
      height: 86px;
      padding:0 20px;
      position:relative;
      z-index:3;
    }

    .barcode {
      width:80px;
      height:54px;
      margin-top: -33px;
      object-fit:contain;
    }

    .valid-text {
      font-size:13px;
      font-weight:500;
      color:#222;
      text-align:left;
    }

    /* Date Range Styles */
    .date-range {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .date-section {
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .date-arrow-left,
    .date-arrow-right {
      color: #000;
      font-size: 20px;
      font-weight: bold;
      background: transparent;
    }

    .date-info {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }

    .date-label {
      font-size: 8px;
      color: #888;
      line-height: 1.1;
      margin-bottom: 2px;
    }

    .date-value {
      font-size: 14px;
      font-weight: bold;
      color: #333;
    }
  </style>
</head>
<body>
  <div class="id-card-back">
    <!-- Decorative strips -->
    <div class="top-strip"></div>

    <!-- Three logos -->
    <div class="logo-row">
      <img src="<?= base_url('public/assets/card/sindh.png') ?>" alt="Left Logo">
      <img src="<?= base_url('public/assets/card/car-logo.png') ?>" alt="Center Logo">
      <img src="<?= base_url('public/assets/card/quaid-e-azam.png') ?>" alt="Right Logo">
    </div>

    <!-- Association Name -->
    <div class="association-text">
      QASIMABAD CAR SHOWROOMS ASSOCIATION HYDERABAD
    </div>

    <!-- QR Code and Validity in one row -->
    <div class="bottom-row">
          <img src="<?= base_url('admin/qrcode/' . ($showroom['id'] ?? '')) ?>" alt="QR Code" class="barcode">
      <div class="valid-text">
        <?php
        // Calculate valid from and valid until dates
        $validFrom = new DateTime($member['created_at']);
        $validUntil = clone $validFrom;
        $validUntil->add(new DateInterval('P2Y')); // Add 2 years
        
        $validFromFormatted = $validFrom->format('m/Y');
        $validUntilFormatted = $validUntil->format('m/Y');
        ?>
        
        <div class="date-range">
          <div class="date-section">
            <div class="date-arrow-left">←</div>
            <div class="date-info">
              <div class="date-label">Valid<br>From</div>
              <div class="date-value"><?= $validFromFormatted ?></div>
            </div>
          </div>
          
          <div class="date-section">
            <div class="date-arrow-right">→</div>
            <div class="date-info">
              <div class="date-label">Valid<br>Until</div>
              <div class="date-value"><?= $validUntilFormatted ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="bottom-strip"></div>
  </div>
</body>
</html>
