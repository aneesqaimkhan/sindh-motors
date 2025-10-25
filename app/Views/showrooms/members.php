<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f8f9fa;
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 3rem;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Showroom Info Card */
         .showroom-info-card {
             background: white;
             border-radius: 15px;
             padding: 2rem;
             margin-bottom: 3rem;
             box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
         }

         /* Inactive showroom highlighting */
         .showroom-info-card.inactive {
             border: 3px solid #dc3545;
             background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%);
             box-shadow: 0 10px 30px rgba(220, 53, 69, 0.2);
             position: relative;
         }

         .showroom-info-card.inactive::before {
             content: '';
             position: absolute;
             top: 0;
             left: 0;
             right: 0;
             height: 4px;
             background: linear-gradient(90deg, #dc3545, #c82333);
             border-radius: 15px 15px 0 0;
         }

        .showroom-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .showroom-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.5rem;
        }

        .showroom-icon i {
            color: white;
            font-size: 2rem;
        }

        .showroom-title h2 {
            color: #333;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .showroom-category {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .category-golden {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            color: #8b6914;
        }

        .category-platinum {
            background: linear-gradient(135deg, #e5e4e2 0%, #f8f8f8 100%);
            color: #666;
        }

         .category-silver {
             background: linear-gradient(135deg, #c0c0c0 0%, #e8e8e8 100%);
             color: #555;
         }

         /* Inactive status badge */
         .status-inactive {
             background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
             color: white;
             font-weight: 700;
             text-transform: uppercase;
             letter-spacing: 0.5px;
             padding: 0.25rem 0.75rem;
             border-radius: 15px;
             font-size: 0.8rem;
             display: inline-flex;
             align-items: center;
             gap: 0.25rem;
         }

         .status-inactive i {
             font-size: 0.9rem;
         }

        .showroom-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .detail-item {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .detail-item i {
            color: #667eea;
            margin-right: 0.75rem;
            width: 20px;
        }

        /* Members Section */
        .members-section {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }

        .section-title h3 {
            color: #333;
            font-weight: 700;
            margin-bottom: 0;
            margin-right: 1rem;
        }

        .member-count {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* Member Cards */
        .member-card {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .member-card:hover {
            border-color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.1);
        }

        .member-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .member-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .member-info h4 {
            color: #333;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .member-reg {
            color: #667eea;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .member-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 0.75rem;
        }

        .member-detail {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }

        .member-detail i {
            color: #667eea;
            margin-right: 0.5rem;
            width: 16px;
        }

        /* No Members */
        .no-members {
            text-align: center;
            padding: 4rem 2rem;
            color: #666;
        }

        .no-members i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 1rem;
        }

        .no-members h4 {
            margin-bottom: 1rem;
        }

        /* Back Button */
        .back-section {
            margin-bottom: 2rem;
        }

        .btn-back {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }
            
            .showroom-header {
                flex-direction: column;
                text-align: center;
            }
            
            .showroom-icon {
                margin-right: 0;
                margin-bottom: 1rem;
            }
            
            .showroom-details {
                grid-template-columns: 1fr;
            }
            
            .member-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1><i class="fas fa-users me-3"></i><?= esc($showroom['showroom_name']) ?></h1>
                    <p>Members of <?= esc($showroom['showroom_name']) ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Back Button -->
        <div class="back-section">
            <a href="<?= base_url('showrooms') ?>" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>Back to Showrooms
            </a>
        </div>

         <!-- Showroom Information -->
         <div class="showroom-info-card <?= ($showroom['status'] === 'inactive') ? 'inactive' : '' ?>">
            <div class="showroom-header">
                <div class="showroom-icon">
                    <i class="fas fa-store"></i>
                </div>
                 <div class="showroom-title">
                     <h2><?= esc($showroom['showroom_name']) ?></h2>
                     <div class="d-flex align-items-center gap-2 flex-wrap">
                         <span class="showroom-category category-<?= esc($showroom['category']) ?>">
                             <?= ucfirst(esc($showroom['category'])) ?>
                         </span>
                         <?php if ($showroom['status'] === 'inactive'): ?>
                             <span class="status-inactive">
                                 <i class="fas fa-exclamation-triangle"></i>
                                 INACTIVE
                             </span>
                         <?php endif; ?>
                     </div>
                 </div>
            </div>
            
            <div class="showroom-details">
                <div class="detail-item">
                    <i class="fas fa-user"></i>
                    <span><strong>Owner:</strong> <?= esc($showroom['name']) ?> <?= esc($showroom['fname']) ?></span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span><?= esc($showroom['showroom_address']) ?></span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-phone"></i>
                    <span><?= esc($showroom['cell_no']) ?></span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-envelope"></i>
                    <span><?= esc($showroom['email']) ?></span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-id-card"></i>
                    <span><strong>Reg. No:</strong> <?= esc($showroom['showroom_registration_number']) ?></span>
                </div>
            </div>
        </div>

        <!-- Members Section -->
        <div class="members-section">
            <div class="section-title">
                <h3>Members</h3>
                <span class="member-count"><?= count($members) ?> Members</span>
            </div>

            <?php if (!empty($members)): ?>
                <div class="row">
                    <?php foreach ($members as $member): ?>
                        <div class="col-lg-6 col-xl-4">
                            <div class="member-card">
                                <div class="member-header">
                                    <div class="member-avatar">
                                        <?= strtoupper(substr($member['member_name'], 0, 1)) ?>
                                    </div>
                                    <div class="member-info">
                                        <h4><?= esc($member['member_name']) ?></h4>
                                        <div class="member-reg">Reg. #<?= esc($member['member_registration_number']) ?></div>
                                    </div>
                                </div>
                                
                                <div class="member-details">
                                    <div class="member-detail">
                                        <i class="fas fa-user"></i>
                                        <span><strong>Father:</strong> <?= esc($member['father_name']) ?></span>
                                    </div>
                                <div class="member-detail">
                                    <i class="fas fa-id-card"></i>
                                    <span><?php 
                                        $cnic = $member['cnic_no'];
                                        $cnicDigits = preg_replace('/[^0-9]/', '', $cnic);
                                        if (strlen($cnicDigits) >= 7) {
                                            $masked = substr($cnicDigits, 0, 4) . '*******' . substr($cnicDigits, -3);
                                        } else {
                                            $masked = $cnic;
                                        }
                                        echo esc($masked);
                                    ?></span>
                                </div>
                                    <div class="member-detail">
                                        <i class="fas fa-phone"></i>
                                        <span><?= esc($member['cell_no']) ?></span>
                                    </div>
                                    <div class="member-detail">
                                        <i class="fas fa-tint"></i>
                                        <span><strong>Blood Group:</strong> <?= esc($member['blood_group']) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-members">
                    <i class="fas fa-users"></i>
                    <h4>No Members Found</h4>
                    <p>This showroom doesn't have any registered members yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>