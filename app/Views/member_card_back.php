<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Qasimabad Car Showrooms Association Card</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background:#e9ecef;
      display:flex;
      justify-content:center;
      align-items:center;
      height:100vh;
    }
    .id-card {
      width:450px;
      height:270px; /* reduced height */
      border-radius:10px;
      background:linear-gradient(to bottom,#b78b29,#f0c75e);
      color:#000;
      position:relative;
      overflow:hidden;
      box-shadow:0 4px 10px rgba(0,0,0,0.3);
      padding:25px 18px 35px 18px; /* reduced top space */
    }

    /* --- Top & Bottom Strips --- */
    .top-strip,
    .bottom-strip {
      position:absolute;
      left:0;
      right:0;
      height:10px;
      background-repeat:no-repeat;
      background-position:center;
      background-size:cover;
      z-index:2;
    }
    .top-strip {
      top:0;
      height: 25px;
      background-image:url('<?= base_url('public/assets/card/ajrak1.jpg') ?>');
    }
    .bottom-strip {
      bottom:0;
      height: 25px;
      background-image:url('<?= base_url('public/assets/card/ajrak1.jpg') ?>');
    }

    /* --- Header --- */
    .header {
      text-align:center;
      background:maroon;
      color:#b78b29;
      padding:0px 0px;
      font-weight:bold;
      border-radius:5px;
      font-size:13px;
      letter-spacing:0.3px;
      overflow:hidden;
      text-overflow:ellipsis;
      margin-bottom:2px;
      position:relative;
      margin-top:4px;
      z-index:3;
    }

    /* --- Membership Card Heading --- */
    .membership-heading {
      text-align:center;
      color:#000;
      padding:2px 5px;
      font-weight:bold;
      font-size:12px;
      letter-spacing:0.5px;
      margin-bottom:4px;
      position:relative;
      z-index:3;
      text-transform:uppercase;
    }

    /* --- Background Car --- */
    .car-bg {
      position:absolute;
      top:50%;
      left:50%;
      transform:translate(-50%,-50%);
      width:500px;
      opacity:0.1;
      z-index:0;
    }

    /* --- Info Section --- */
    .details {
      position:relative;
      z-index:3;
      font-size:13px;
      line-height:1.2;
      min-height: 150px;
    }

    .photo {
      width:80px;
      height:90px;
      border:2px solid #000;
      border-radius:5px;
      object-fit:cover;
      background:#fff;
    }

    .info-row {
      display:flex;
      margin-bottom:1px;
      width: 100%;
      max-width: 100%;
      align-items: flex-start;
    }
    .label {
      width:95px;
      font-weight:bold;
      flex-shrink:0;
      text-align: left;
      padding-right: 5px;
    }
    .value {
      flex:1;
      word-break:break-word;
      font-weight: bold;
      max-width: 280px;
      padding-left: 5px;
      color: #000 !important;
    }
    
    .address-value {
      overflow: visible;
      max-width: 280px;
      display: block;
      word-wrap: break-word;
      line-height: 1.1;
      font-weight: bold;
      padding-left: 5px;
    }
  </style>
</head>
<body>
  <div class="id-card">
    <!-- Top decorative image strip -->
    <div class="top-strip"></div>

    <!-- Header -->
    <div class="header">QASIMABAD CAR SHOWROOMS ASSOCIATION HYD</div>
    
    <!-- Membership Card Heading -->
    <div class="membership-heading">Membership Card</div>

    <!-- Centered transparent car background -->
    <img src="<?= base_url('public/assets/card/car.png') ?>" class="car-bg" alt="Car Background">

    <div class="row align-items-start">
      <div class="col-9 details">
        <div class="info-row"><div class="label">Name</div><span style="color: #000;">:</span><div class="value"><?= esc($member['member_name']) ?></div></div>
        <div class="info-row"><div class="label">Father Name</div><span style="color: #000;">:</span><div class="value"><?= esc($member['father_name'] ?? '') ?></div></div>
        <div class="info-row"><div class="label">Membership #</div><span style="color: #000;">:</span><div class="value"><?= esc($showroom['showroom_registration_number'] ?? '') ?></div></div>
        <div class="info-row"><div class="label">CNIC #</div><span style="color: #000;">:</span><div class="value"><?= 
          preg_replace('/(\d{5})(\d{7})(\d{1})/', '$1-$2-$3', esc($member['cnic_no'])) 
        ?></div></div>
        <div class="info-row"><div class="label">Showroom</div><span style="color: #000;">:</span><div class="value"><?= esc($showroom['showroom_name'] ?? '') ?></div></div>
        <div class="info-row"><div class="label">Blood Group</div><span style="color: #000;">:</span><div class="value"><?= esc($member['blood_group']) ?></div></div>
        <div class="info-row"><div class="label">Mobile #</div><span style="color: #000;">:</span><div class="value"><?= esc($member['cell_no']) ?></div></div>
        <div class="info-row"><div class="label">Address</div><span style="color: #000;">:</span><div class="address-value"><?= esc($showroom['showroom_address'] ?? '') ?></div></div>
      </div>

      <div class="col-3 text-center">
        <?php if (!empty($member['profile_picture'])): ?>
          <img src="<?= base_url('public/uploads/members/' . esc($member['profile_picture'])) ?>" alt="User Photo" class="photo mt-1">
        <?php else: ?>
          <img src="<?= base_url('public/assets/images/default-user.png') ?>" alt="User Photo" class="photo mt-1">
        <?php endif; ?>
      </div>
    </div>

    <!-- Bottom decorative image strip -->
    <div class="bottom-strip"></div>
  </div>
</body>
</html>
