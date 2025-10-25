<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Card - <?= $member['member_name'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #e9ecef;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        
        .cards-wrapper {
            display: flex;
            gap: 40px;
            align-items: flex-start;
            justify-content: center;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .card-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .card-label {
            text-align: center;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
            background: #fff;
            padding: 10px 20px;
            border-radius: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border: 2px solid #007bff;
        }
        
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #007bff;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0,123,255,0.3);
        }
        
        .print-button:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }
        
        @media print {
            .print-button, .card-label {
                display: none !important;
            }
            body {
                background: white;
                padding: 0;
            }
            .cards-wrapper {
                gap: 20px;
                flex-direction: row;
            }
        }
        
        @media (max-width: 768px) {
            .cards-wrapper {
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Print Button -->
    <button class="print-button" onclick="window.print()">
        Print Both Cards
    </button>

    <div class="cards-wrapper">
        <!-- Front Card -->
        <div class="card-container">
            <div class="card-label">FRONT SIDE</div>
            
            <!-- Include Front Card Content -->
            <div style="width:450px; height:270px; border-radius:10px; background:linear-gradient(to bottom,#b78b29,#f0c75e); color:#000; position:relative; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.3); padding:30px 18px;">
                <!-- Top decorative strips -->
                <div style="position:absolute; top:0; left:0; right:0; height:25px; background-image:url('<?= base_url('public/assets/card/ajrak1.jpg') ?>'); background-repeat:no-repeat; background-position:center; background-size:cover; z-index:2;"></div>
                
                <!-- Three logos -->
                <div style="display:flex; justify-content:space-between; align-items:center; margin-top:0px; padding:0 10px; position:relative; z-index:3;">
                    <img src="<?= base_url('public/assets/card/sindh.png') ?>" alt="Left Logo" style="width:70px; height:auto; object-fit:contain;">
                    <img src="<?= base_url('public/assets/card/car-logo.png') ?>" alt="Center Logo" style="width:70px; height:auto; object-fit:contain;">
                    <img src="<?= base_url('public/assets/card/quaid-e-azam.png') ?>" alt="Right Logo" style="width:70px; height:auto; object-fit:contain;">
                </div>
                
                <!-- Association Name -->
                <div style="font-weight:bold; font-size:16px; margin-top:12px; color:#000; letter-spacing:0.5px; z-index:3; position:relative; text-align:center;">
                    QASIMABAD CAR SHOWROOMS ASSOCIATION HYDERABAD
                </div>
                
                <!-- QR Code and Validity in one row -->
                <div style="display:flex; justify-content:space-between; align-items:center; margin-top:0px; height: 86px; padding:0 20px; position:relative; z-index:3;">
                    <img src="<?= base_url('admin/qrcode/' . ($showroom['id'] ?? '')) ?>" alt="QR Code" style="width:80px; height:54px; margin-top: -33px; object-fit:contain;">
                    <div style="font-size:13px; font-weight:500; color:#222; text-align:left;">
                        <?php
                        // Calculate valid from and valid until dates
                        $validFrom = new DateTime($member['created_at']);
                        $validUntil = clone $validFrom;
                        $validUntil->add(new DateInterval('P2Y')); // Add 2 years
                        
                        $validFromFormatted = $validFrom->format('m/Y');
                        $validUntilFormatted = $validUntil->format('m/Y');
                        ?>
                        
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <div style="display: flex; align-items: center; gap: 4px;">
                                <div style="color: #000; font-size: 20px; font-weight: bold; background: transparent;">←</div>
                                <div style="display: flex; flex-direction: column; align-items: flex-start;">
                                    <div style="font-size: 8px; color: #888; line-height: 1.1; margin-bottom: 2px;">Valid<br>From</div>
                                    <div style="font-size: 14px; font-weight: bold; color: #333;"><?= $validFromFormatted ?></div>
                                </div>
                            </div>
                            
                            <div style="display: flex; align-items: center; gap: 4px;">
                                <div style="color: #000; font-size: 20px; font-weight: bold; background: transparent;">→</div>
                                <div style="display: flex; flex-direction: column; align-items: flex-start;">
                                    <div style="font-size: 8px; color: #888; line-height: 1.1; margin-bottom: 2px;">Valid<br>Until</div>
                                    <div style="font-size: 14px; font-weight: bold; color: #333;"><?= $validUntilFormatted ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Bottom decorative strip -->
                <div style="position:absolute; bottom:0; left:0; right:0; height:25px; background-image:url('<?= base_url('public/assets/card/ajrak1.jpg') ?>'); background-repeat:no-repeat; background-position:center; background-size:cover; z-index:2;"></div>
            </div>
        </div>
        
        <!-- Back Card -->
        <div class="card-container">
            <div class="card-label">BACK SIDE</div>
            
            <!-- Include Back Card Content -->
            <div style="width:450px; height:270px; border-radius:10px; background:linear-gradient(to bottom,#b78b29,#f0c75e); color:#000; position:relative; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.3); padding:25px 18px 35px 18px;">
                <!-- Top decorative image strip -->
                <div style="position:absolute; top:0; left:0; right:0; height:25px; background-image:url('<?= base_url('public/assets/card/ajrak1.jpg') ?>'); background-repeat:no-repeat; background-position:center; background-size:cover; z-index:2;"></div>
                
                <!-- Header -->
                <div style="text-align:center; background:maroon; color:#b78b29; padding:0px 0px; font-weight:bold; border-radius:5px; font-size:13px; letter-spacing:0.3px; overflow:hidden; text-overflow:ellipsis; margin-bottom:2px; position:relative; margin-top:4px; z-index:3;">
                    QASIMABAD CAR SHOWROOMS ASSOCIATION HYD
                </div>
                
                <!-- Membership Card Heading -->
                <div style="text-align:center; color:#000; padding:2px 5px; font-weight:bold; font-size:12px; letter-spacing:0.5px; margin-bottom:4px; position:relative; z-index:3; text-transform:uppercase;">
                    Membership Card
                </div>
                
                <!-- Centered transparent car background -->
                <img src="<?= base_url('public/assets/card/car.png') ?>" style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); width:500px; opacity:0.1; z-index:0;" alt="Car Background">
                
                <div style="display:flex; align-items:flex-start;">
                    <div style="flex: 1; position:relative; z-index:3; font-size:13px; line-height:1.2; min-height: 150px;">
                        <div style="display:flex; margin-bottom:1px; width: 100%; max-width: 100%; align-items: flex-start;">
                            <div style="width:95px; font-weight:bold; flex-shrink:0; text-align: left; padding-right: 5px;">Name</div>
                            <span style="color: #000;">:</span>
                            <div style="flex:1; word-break:break-word; font-weight: bold; max-width: 280px; padding-left: 5px; color: #000 !important;"><?= esc($member['member_name']) ?></div>
                        </div>
                        <div style="display:flex; margin-bottom:1px; width: 100%; max-width: 100%; align-items: flex-start;">
                            <div style="width:95px; font-weight:bold; flex-shrink:0; text-align: left; padding-right: 5px;">Father Name</div>
                            <span style="color: #000;">:</span>
                            <div style="flex:1; word-break:break-word; font-weight: bold; max-width: 280px; padding-left: 5px; color: #000 !important;"><?= esc($member['father_name'] ?? '') ?></div>
                        </div>
                        <div style="display:flex; margin-bottom:1px; width: 100%; max-width: 100%; align-items: flex-start;">
                            <div style="width:95px; font-weight:bold; flex-shrink:0; text-align: left; padding-right: 5px;">Membership #</div>
                            <span style="color: #000;">:</span>
                            <div style="flex:1; word-break:break-word; font-weight: bold; max-width: 280px; padding-left: 5px; color: #000 !important;"><?= esc($showroom['showroom_registration_number'] ?? '') ?></div>
                        </div>
                        <div style="display:flex; margin-bottom:1px; width: 100%; max-width: 100%; align-items: flex-start;">
                            <div style="width:95px; font-weight:bold; flex-shrink:0; text-align: left; padding-right: 5px;">CNIC #</div>
                            <span style="color: #000;">:</span>
                            <div style="flex:1; word-break:break-word; font-weight: bold; max-width: 280px; padding-left: 5px; color: #000 !important;"><?= 
                                preg_replace('/(\d{5})(\d{7})(\d{1})/', '$1-$2-$3', esc($member['cnic_no'])) 
                            ?></div>
                        </div>
                        <div style="display:flex; margin-bottom:1px; width: 100%; max-width: 100%; align-items: flex-start;">
                            <div style="width:95px; font-weight:bold; flex-shrink:0; text-align: left; padding-right: 5px;">Showroom</div>
                            <span style="color: #000;">:</span>
                            <div style="flex:1; word-break:break-word; font-weight: bold; max-width: 280px; padding-left: 5px; color: #000 !important;"><?= esc($showroom['showroom_name'] ?? '') ?></div>
                        </div>
                        <div style="display:flex; margin-bottom:1px; width: 100%; max-width: 100%; align-items: flex-start;">
                            <div style="width:95px; font-weight:bold; flex-shrink:0; text-align: left; padding-right: 5px;">Blood Group</div>
                            <span style="color: #000;">:</span>
                            <div style="flex:1; word-break:break-word; font-weight: bold; max-width: 280px; padding-left: 5px; color: #000 !important;"><?= esc($member['blood_group']) ?></div>
                        </div>
                        <div style="display:flex; margin-bottom:1px; width: 100%; max-width: 100%; align-items: flex-start;">
                            <div style="width:95px; font-weight:bold; flex-shrink:0; text-align: left; padding-right: 5px;">Mobile #</div>
                            <span style="color: #000;">:</span>
                            <div style="flex:1; word-break:break-word; font-weight: bold; max-width: 280px; padding-left: 5px; color: #000 !important;"><?= esc($member['cell_no']) ?></div>
                        </div>
                        <div style="display:flex; margin-bottom:1px; width: 100%; max-width: 100%; align-items: flex-start;">
                            <div style="width:95px; font-weight:bold; flex-shrink:0; text-align: left; padding-right: 5px;">Address</div>
                            <span style="color: #000;">:</span>
                            <div style="overflow: visible; max-width: 280px; display: block; word-wrap: break-word; line-height: 1.1; font-weight: bold; padding-left: 5px; color: #000 !important;"><?= esc($showroom['showroom_address'] ?? '') ?></div>
                        </div>
                    </div>
                    
                    <div style="flex: 0 0 25%; text-align:center; position:relative; z-index:3;">
                        <div style="display:flex; flex-direction:column; align-items:center;">
                            <?php if (!empty($member['profile_picture'])): ?>
                                <img src="<?= base_url('public/uploads/members/' . esc($member['profile_picture'])) ?>" alt="User Photo" style="width:80px; height:90px; border:2px solid #000; border-radius:5px; object-fit:cover; background:#fff; margin-top: 5px; display:block;">
                            <?php else: ?>
                                <img src="<?= base_url('public/assets/images/default-user.png') ?>" alt="User Photo" style="width:80px; height:90px; border:2px solid #000; border-radius:5px; object-fit:cover; background:#fff; margin-top: 5px; display:block;">
                            <?php endif; ?>
                            <img src="<?= base_url('public/assets/signature/signature.png') ?>" alt="Signature" style="width:80px; height:auto; margin-top:-10px; object-fit:contain; display:block; background:transparent;">
                            <div style="font-weight:bold; font-size:9px; margin-top:-10px; color:#000;">M.Yaseen (President)</div>
                        </div>
                    </div>
                </div>
                
                <!-- Bottom decorative image strip -->
                <div style="position:absolute; bottom:0; left:0; right:0; height:25px; background-image:url('<?= base_url('public/assets/card/ajrak1.jpg') ?>'); background-repeat:no-repeat; background-position:center; background-size:cover; z-index:2;"></div>
            </div>
        </div>
    </div>
    
    <script>
        function printCard() {
            window.print();
        }
    </script>
</body>
</html>