<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - QCSA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 250px;
            --header-height: 60px;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .sidebar-menu .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .sidebar-menu .nav-link:hover,
        .sidebar-menu .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: white;
        }
        
        .sidebar-menu .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }
        
        .header {
            background: white;
            height: var(--header-height);
            border-bottom: 1px solid #e9ecef;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .content {
            padding: 20px;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }
        
        .user-dropdown .dropdown-toggle::after {
            display: none;
        }
        
        .user-dropdown .dropdown-toggle {
            background: none;
            border: none;
            color: #495057;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .status-active {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .member-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <h5><i class="fas fa-car me-2"></i>QCSA</h5>
        </div>
        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin') ?>">
                        <i class="fas fa-tachometer-alt"></i>Admin Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/users') ?>">
                        <i class="fas fa-car"></i>All Showrooms
                    </a>
                </li>
                <li class="nav-item mt-4">
                    <a class="nav-link" href="<?= base_url('logout') ?>">
                        <i class="fas fa-sign-out-alt"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="header">
            <div class="d-flex align-items-center">
                <button class="btn btn-link d-md-none" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h4 class="mb-0 ms-3"><?= $title ?></h4>
            </div>
            
            <div class="user-dropdown">
                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <div class="user-avatar">
                        A
                    </div>
                    <span>Admin</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                </ul>
            </div>
        </header>

        <!-- Content -->
        <div class="content">
            <!-- Showroom Information -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-store me-2"></i>Showroom Information</h5>
                    <div>
                        <a href="<?= base_url('admin/editShowroom/' . $showroom['id']) ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Full Name</label>
                                <p class="form-control-plaintext"><?= $showroom['name'] ?></p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Father's Name</label>
                                <p class="form-control-plaintext"><?= $showroom['fname'] ?></p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">CNIC Number</label>
                                <p class="form-control-plaintext"><?= $showroom['cnic_no'] ?></p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Cell Number</label>
                                <p class="form-control-plaintext"><?= $showroom['cell_no'] ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email Address</label>
                                <p class="form-control-plaintext"><?= $showroom['email'] ?></p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Date of Birth</label>
                                <p class="form-control-plaintext"><?= date('M d, Y', strtotime($showroom['date_of_birth'])) ?></p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Category</label>
                                <p>
                                    <span class="badge bg-<?= $showroom['category'] === 'golden' ? 'warning' : ($showroom['category'] === 'platinum' ? 'primary' : 'secondary') ?>">
                                        <?= ucfirst($showroom['category']) ?>
                                    </span>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <p>
                                    <span class="status-badge <?= $showroom['status'] === 'active' ? 'status-active' : ($showroom['status'] === 'pending' ? 'status-pending' : 'status-inactive') ?>">
                                        <?= ucfirst($showroom['status']) ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Showroom Name</label>
                                <p class="form-control-plaintext"><?= $showroom['showroom_name'] ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Registration Number</label>
                                <p class="form-control-plaintext">
                                    <span class="badge bg-info fs-6"><?= $showroom['showroom_registration_number'] ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Showroom Address</label>
                        <p class="form-control-plaintext"><?= $showroom['showroom_address'] ?></p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">QR Code</label>
                        <p class="form-control-plaintext">
                            <code class="bg-light px-2 py-1 rounded"><?= $showroom['qr_code'] ?></code>
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Created At</label>
                        <p class="form-control-plaintext"><?= date('M d, Y H:i:s', strtotime($showroom['created_at'])) ?></p>
                    </div>
                </div>
            </div>

            <!-- Members Information -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-users me-2"></i>Members (<?= count($members) ?>)</h5>
                    <?php if (!empty($members)): ?>
                        <div>
                            <button type="button" class="btn btn-primary btn-sm" onclick="generateAllCards()">
                                <i class="fas fa-id-card me-1"></i>Generate All Cards
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <?php if (empty($members)): ?>
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No members found for this showroom.</p>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach ($members as $member): ?>
                                <div class="col-md-6 mb-4">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="member-avatar me-3">
                                                    <?php if ($member['profile_picture']): ?>
                                                        <img src="<?= base_url('uploads/members/' . $member['profile_picture']) ?>" 
                                                             alt="Profile" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                                                    <?php else: ?>
                                                        <?= strtoupper(substr($member['member_name'], 0, 1)) ?>
                                                    <?php endif; ?>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1"><?= $member['member_name'] ?></h6>
                                                    <small class="text-muted"><?= $member['father_name'] ?></small>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-6">
                                                    <small class="text-muted">CNIC:</small><br>
                                                    <span class="fw-bold"><?= $member['cnic_no'] ?></span>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted">Cell:</small><br>
                                                    <span class="fw-bold"><?= $member['cell_no'] ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <small class="text-muted">Blood Group:</small><br>
                                                    <span class="badge bg-danger"><?= $member['blood_group'] ?></span>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted">Status:</small><br>
                                                    <span class="status-badge <?= $member['status'] === 'active' ? 'status-active' : 'status-inactive' ?>">
                                                        <?= ucfirst($member['status']) ?>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-2">
                                                <small class="text-muted">Registration #:</small><br>
                                                <span class="badge bg-info"><?= $member['member_registration_number'] ?></span>
                                            </div>
                                            
                                            <div class="mt-3">
                                                <a href="<?= base_url('admin/generateMemberCard/' . $member['id']) ?>" 
                                                   class="btn btn-success btn-sm" 
                                                   target="_blank"
                                                   title="Generate Member Card">
                                                    <i class="fas fa-id-card me-1"></i>Generate Card
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
        });
        
        // Generate all member cards
        function generateAllCards() {
            <?php if (!empty($members)): ?>
                const memberIds = [
                    <?php foreach ($members as $member): ?>
                        <?= $member['id'] ?>,
                    <?php endforeach; ?>
                ];
                
                // Open each card in a new tab
                memberIds.forEach((memberId, index) => {
                    setTimeout(() => {
                        window.open('<?= base_url('admin/generateMemberCard/') ?>' + memberId, '_blank');
                    }, index * 500); // Delay each card by 500ms to avoid browser blocking
                });
            <?php endif; ?>
        }
    </script>
</body>
</html>
