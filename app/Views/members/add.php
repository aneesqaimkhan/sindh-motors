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
        
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
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
        
        .member-form {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .member-entry {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }
        
        .member-entry:hover {
            border-color: #667eea;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .remove-member {
            background: #dc3545;
            border: none;
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .remove-member:hover {
            background: #c82333;
            transform: scale(1.1);
        }
        
        .add-member-btn {
            background: #28a745;
            border: none;
            color: white;
            border-radius: 10px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        
        .add-member-btn:hover {
            background: #218838;
            transform: translateY(-2px);
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
                    <a class="nav-link" href="<?= base_url('members') ?>">
                        <i class="fas fa-id-card"></i>Staff Members
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('members/add') ?>">
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
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Add New Staff Members</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('members/add') ?>" method="post" enctype="multipart/form-data" class="member-form">
                                <div id="members-container">
                                    <div class="member-entry" data-member="0">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="members[0][member_name]" class="form-label">Member Name *</label>
                                                        <input type="text" class="form-control" id="members[0][member_name]" name="members[0][member_name]" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="members[0][father_name]" class="form-label">Father Name *</label>
                                                        <input type="text" class="form-control" id="members[0][father_name]" name="members[0][father_name]" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                                                        <label for="members[0][cnic_no]" class="form-label">CNIC No *</label>
                                                        <input type="text" class="form-control" id="members[0][cnic_no]" name="members[0][cnic_no]" placeholder="1234567890123" required>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="members[0][cell_no]" class="form-label">Cell No *</label>
                                                        <input type="text" class="form-control" id="members[0][cell_no]" name="members[0][cell_no]" placeholder="03001234567" required>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="members[0][profile_picture]" class="form-label">Profile Picture</label>
                                                        <input type="file" class="form-control" id="members[0][profile_picture]" name="members[0][profile_picture]" accept="image/*">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                <button type="button" class="remove-member" onclick="removeMember(0)" style="display: none;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-center mb-4">
                                    <button type="button" class="add-member-btn" onclick="addMember()">
                                        <i class="fas fa-plus me-2"></i>Add Another Member
                                    </button>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="fas fa-save me-2"></i>Save Members
                                    </button>
                                    <a href="<?= base_url('members') ?>" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>Back to List
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let memberCount = 1;
        
        function addMember() {
            const container = document.getElementById('members-container');
            const newMember = document.createElement('div');
            newMember.className = 'member-entry';
            newMember.setAttribute('data-member', memberCount);
            
            newMember.innerHTML = `
                <div class="row">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="members[${memberCount}][member_name]" class="form-label">Member Name *</label>
                                <input type="text" class="form-control" id="members[${memberCount}][member_name]" name="members[${memberCount}][member_name]" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="members[${memberCount}][father_name]" class="form-label">Father Name *</label>
                                <input type="text" class="form-control" id="members[${memberCount}][father_name]" name="members[${memberCount}][father_name]" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="members[${memberCount}][cnic_no]" class="form-label">CNIC No *</label>
                                <input type="text" class="form-control" id="members[${memberCount}][cnic_no]" name="members[${memberCount}][cnic_no]" placeholder="1234567890123" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="members[${memberCount}][cell_no]" class="form-label">Cell No *</label>
                                <input type="text" class="form-control" id="members[${memberCount}][cell_no]" name="members[${memberCount}][cell_no]" placeholder="03001234567" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="members[${memberCount}][profile_picture]" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" id="members[${memberCount}][profile_picture]" name="members[${memberCount}][profile_picture]" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                        <button type="button" class="remove-member" onclick="removeMember(${memberCount})">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;
            
            container.appendChild(newMember);
            memberCount++;
            
            // Show remove button for first member if there are multiple members
            if (memberCount > 1) {
                document.querySelector('[data-member="0"] .remove-member').style.display = 'flex';
            }
        }
        
        function removeMember(index) {
            const member = document.querySelector(`[data-member="${index}"]`);
            member.remove();
            
            // Hide remove button for first member if only one member remains
            if (document.querySelectorAll('.member-entry').length === 1) {
                document.querySelector('[data-member="0"] .remove-member').style.display = 'none';
            }
        }
        
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
        });
    </script>
</body>
</html>


