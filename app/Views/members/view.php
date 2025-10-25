<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Staff Management System</title>
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
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
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
        
        .btn {
            border-radius: 10px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .member-profile {
            max-width: 1000px;
            margin: 0 auto;
        }
        
        .profile-image {
            width: 200px;
            height: 200px;
            border-radius: 20px;
            object-fit: cover;
            border: 4px solid #e9ecef;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .profile-placeholder {
            width: 200px;
            height: 200px;
            border-radius: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 4rem;
            font-weight: bold;
            border: 4px solid #e9ecef;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .status-badge {
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.875rem;
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
        
        .info-item {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            border-left: 4px solid #667eea;
        }
        
        .info-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 5px;
        }
        
        .info-value {
            color: #212529;
            font-size: 1.1rem;
        }
        
        .member-stats {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 0.875rem;
            opacity: 0.9;
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
            <h5><i class="fas fa-users me-2"></i>Staff Management</h5>
        </div>
        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('dashboard') ?>">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin') ?>">
                        <i class="fas fa-user-shield"></i>Admin Panel
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/users') ?>">
                        <i class="fas fa-users"></i>Manage Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('members') ?>">
                        <i class="fas fa-id-card"></i>Staff Members
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('members/add') ?>">
                        <i class="fas fa-user-plus"></i>Add Members
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
            <div class="member-profile">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-user me-2"></i>Member Profile</h5>
                        <div>
                            <a href="<?= base_url('members/edit/' . $member['id']) ?>" class="btn btn-primary me-2">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a>
                            <a href="<?= base_url('members') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <?php if ($member['profile_picture']): ?>
                                    <img src="<?= base_url('uploads/members/' . $member['profile_picture']) ?>" 
                                         alt="Profile" class="profile-image">
                                <?php else: ?>
                                    <div class="profile-placeholder">
                                        <?= strtoupper(substr($member['member_name'], 0, 1)) ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="mt-3">
                                    <span class="status-badge <?= $member['status'] === 'active' ? 'status-active' : 'status-inactive' ?>">
                                        <?= ucfirst($member['status']) ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="info-item">
                                    <div class="info-label">Member Name</div>
                                    <div class="info-value"><?= $member['member_name'] ?></div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-label">Father's Name</div>
                                    <div class="info-value"><?= $member['father_name'] ?></div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-label">CNIC Number</div>
                                    <div class="info-value"><?= $member['cnic_no'] ?></div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-label">Cell Number</div>
                                    <div class="info-value"><?= $member['cell_no'] ?></div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-label">Member Since</div>
                                    <div class="info-value"><?= date('F d, Y', strtotime($member['created_at'])) ?></div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-label">Last Updated</div>
                                    <div class="info-value"><?= date('F d, Y \a\t h:i A', strtotime($member['updated_at'])) ?></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="member-stats">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stat-item">
                                                <div class="stat-number"><?= $member['id'] ?></div>
                                                <div class="stat-label">Member ID</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="stat-item">
                                                <div class="stat-number"><?= $member['status'] === 'active' ? 'Active' : 'Inactive' ?></div>
                                                <div class="stat-label">Current Status</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="stat-item">
                                                <div class="stat-number"><?= $member['profile_picture'] ? 'Yes' : 'No' ?></div>
                                                <div class="stat-label">Profile Picture</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <div class="btn-group" role="group">
                                    <a href="<?= base_url('members/edit/' . $member['id']) ?>" class="btn btn-primary">
                                        <i class="fas fa-edit me-2"></i>Edit Member
                                    </a>
                                    <a href="<?= base_url('members/toggleStatus/' . $member['id']) ?>" 
                                       class="btn btn-warning"
                                       onclick="return confirm('Are you sure you want to change the status?')">
                                        <i class="fas fa-toggle-on me-2"></i>Toggle Status
                                    </a>
                                    <a href="<?= base_url('members/delete/' . $member['id']) ?>" 
                                       class="btn btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this member? This action cannot be undone.')">
                                        <i class="fas fa-trash me-2"></i>Delete Member
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
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
    </script>
</body>
</html>


