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
        }
        
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
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
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Edit Showroom Form -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Showroom</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/editShowroom/' . $showroom['id']) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="<?= old('name', $showroom['name']) ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="fname" class="form-label">Father's Name *</label>
                                <input type="text" class="form-control" id="fname" name="fname" 
                                       value="<?= old('fname', $showroom['fname']) ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="cnic_no" class="form-label">CNIC Number *</label>
                                <input type="text" class="form-control" id="cnic_no" name="cnic_no" 
                                       value="<?= old('cnic_no', $showroom['cnic_no']) ?>" placeholder="0000000000000" maxlength="13" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="cell_no" class="form-label">Cell Number *</label>
                                <input type="text" class="form-control" id="cell_no" name="cell_no" 
                                       value="<?= old('cell_no', $showroom['cell_no']) ?>" placeholder="03000000000" maxlength="11" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth *</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" 
                                       value="<?= old('date_of_birth', $showroom['date_of_birth']) ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Category *</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="golden" <?= old('category', $showroom['category']) == 'golden' ? 'selected' : '' ?>>Golden</option>
                                    <option value="platinum" <?= old('category', $showroom['category']) == 'platinum' ? 'selected' : '' ?>>Platinum</option>
                                    <option value="silver" <?= old('category', $showroom['category']) == 'silver' ? 'selected' : '' ?>>Silver</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?= old('email', $showroom['email']) ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status *</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="active" <?= old('status', $showroom['status']) == 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= old('status', $showroom['status']) == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                    <option value="pending" <?= old('status', $showroom['status']) == 'pending' ? 'selected' : '' ?>>Pending</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="showroom_name" class="form-label">Showroom Name *</label>
                                <input type="text" class="form-control" id="showroom_name" name="showroom_name" 
                                       value="<?= old('showroom_name', $showroom['showroom_name']) ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="showroom_address" class="form-label">Showroom Address *</label>
                                <textarea class="form-control" id="showroom_address" name="showroom_address" 
                                          rows="3" required><?= old('showroom_address', $showroom['showroom_address']) ?></textarea>
                            </div>
                        </div>

                        <!-- Read-only fields -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Registration Number</label>
                                <input type="text" class="form-control" value="<?= $showroom['showroom_registration_number'] ?>" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">QR Code</label>
                                <input type="text" class="form-control" value="<?= $showroom['qr_code'] ?>" readonly>
                            </div>
                        </div>
                        <!-- Members Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0"><i class="fas fa-users me-2"></i>Members Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="members-container">
                                            <?php 
                                            $existingMembers = $members ?? [];
                                            $memberIndex = 0;
                                            foreach ($existingMembers as $member): 
                                            ?>
                                                <div class="member-entry" data-member="<?= $memberIndex ?>">
                                                    <div class="row">
                                                        <div class="col-md-11">
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="members[<?= $memberIndex ?>][member_name]" class="form-label">Member Name *</label>
                                                                    <input type="text" class="form-control" id="members[<?= $memberIndex ?>][member_name]" name="members[<?= $memberIndex ?>][member_name]" 
                                                                           value="<?= old('members.' . $memberIndex . '.member_name', $member['member_name']) ?>" required>
                                                                    <input type="hidden" name="members[<?= $memberIndex ?>][member_id]" value="<?= $member['id'] ?>">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="members[<?= $memberIndex ?>][father_name]" class="form-label">Father Name *</label>
                                                                    <input type="text" class="form-control" id="members[<?= $memberIndex ?>][father_name]" name="members[<?= $memberIndex ?>][father_name]" 
                                                                           value="<?= old('members.' . $memberIndex . '.father_name', $member['father_name']) ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4 mb-3">
                                                                    <label for="members[<?= $memberIndex ?>][cnic_no]" class="form-label">CNIC No *</label>
                                                                    <input type="text" class="form-control" id="members[<?= $memberIndex ?>][cnic_no]" name="members[<?= $memberIndex ?>][cnic_no]" 
                                                                           value="<?= old('members.' . $memberIndex . '.cnic_no', $member['cnic_no']) ?>" placeholder="0000000000000" maxlength="13" required>
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <label for="members[<?= $memberIndex ?>][cell_no]" class="form-label">Cell No *</label>
                                                                    <input type="text" class="form-control" id="members[<?= $memberIndex ?>][cell_no]" name="members[<?= $memberIndex ?>][cell_no]" 
                                                                           value="<?= old('members.' . $memberIndex . '.cell_no', $member['cell_no']) ?>" placeholder="03000000000" maxlength="11" required>
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <label for="members[<?= $memberIndex ?>][blood_group]" class="form-label">Blood Group</label>
                                                                    <select class="form-control" id="members[<?= $memberIndex ?>][blood_group]" name="members[<?= $memberIndex ?>][blood_group]">
                                                                        <option value="A+" <?= old('members.' . $memberIndex . '.blood_group', $member['blood_group']) == 'A+' ? 'selected' : '' ?>>A+</option>
                                                                        <option value="A-" <?= old('members.' . $memberIndex . '.blood_group', $member['blood_group']) == 'A-' ? 'selected' : '' ?>>A-</option>
                                                                        <option value="B+" <?= old('members.' . $memberIndex . '.blood_group', $member['blood_group']) == 'B+' ? 'selected' : '' ?>>B+</option>
                                                                        <option value="B-" <?= old('members.' . $memberIndex . '.blood_group', $member['blood_group']) == 'B-' ? 'selected' : '' ?>>B-</option>
                                                                        <option value="AB+" <?= old('members.' . $memberIndex . '.blood_group', $member['blood_group']) == 'AB+' ? 'selected' : '' ?>>AB+</option>
                                                                        <option value="AB-" <?= old('members.' . $memberIndex . '.blood_group', $member['blood_group']) == 'AB-' ? 'selected' : '' ?>>AB-</option>
                                                                        <option value="O+" <?= old('members.' . $memberIndex . '.blood_group', $member['blood_group']) == 'O+' ? 'selected' : '' ?>>O+</option>
                                                                        <option value="O-" <?= old('members.' . $memberIndex . '.blood_group', $member['blood_group']) == 'O-' ? 'selected' : '' ?>>O-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="members[<?= $memberIndex ?>][profile_picture]" class="form-label">Profile Picture</label>
                                                                    <input type="file" class="form-control" id="members[<?= $memberIndex ?>][profile_picture]" name="members[<?= $memberIndex ?>][profile_picture]" accept="image/*">
                                                                    <?php if ($member['profile_picture']): ?>
                                                                        <small class="text-muted">Current: <?= $member['profile_picture'] ?></small>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="members[<?= $memberIndex ?>][status]" class="form-label">Status</label>
                                                                    <select class="form-control" id="members[<?= $memberIndex ?>][status]" name="members[<?= $memberIndex ?>][status]">
                                                                        <option value="active" <?= old('members.' . $memberIndex . '.status', $member['status']) == 'active' ? 'selected' : '' ?>>Active</option>
                                                                        <option value="inactive" <?= old('members.' . $memberIndex . '.status', $member['status']) == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 mb-3">
                                                                    <label class="form-label">Registration Number</label>
                                                                    <input type="text" class="form-control" value="<?= $member['member_registration_number'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                            <button type="button" class="btn btn-danger btn-sm remove-member" onclick="removeMember(<?= $memberIndex ?>)">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php 
                                            $memberIndex++;
                                            endforeach; 
                                            ?>
                                        </div>
                                        
                                        <div class="text-center mb-3">
                                            <button type="button" class="btn btn-success" onclick="addMember()">
                                                <i class="fas fa-plus me-2"></i>Add Another Member
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary me-md-2">
                                <i class="fas fa-arrow-left me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Showroom & Members
                            </button>
                        </div>
                    </form>
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

        // Member management functionality
        let memberCount = <?= $memberIndex ?? 0 ?>;
        
        function addMember() {
            const container = document.getElementById('members-container');
            const memberEntry = document.createElement('div');
            memberEntry.className = 'member-entry';
            memberEntry.setAttribute('data-member', memberCount);
            
            memberEntry.innerHTML = `
                <div class="row mt-3">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="members[${memberCount}][member_name]" class="form-label">Member Name *</label>
                                <input type="text" class="form-control" id="members[${memberCount}][member_name]" name="members[${memberCount}][member_name]" required>
                                <input type="hidden" name="members[${memberCount}][member_id]" value="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="members[${memberCount}][father_name]" class="form-label">Father Name *</label>
                                <input type="text" class="form-control" id="members[${memberCount}][father_name]" name="members[${memberCount}][father_name]" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="members[${memberCount}][cnic_no]" class="form-label">CNIC No *</label>
                                <input type="text" class="form-control" id="members[${memberCount}][cnic_no]" name="members[${memberCount}][cnic_no]" placeholder="0000000000000" maxlength="13" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="members[${memberCount}][cell_no]" class="form-label">Cell No *</label>
                                <input type="text" class="form-control" id="members[${memberCount}][cell_no]" name="members[${memberCount}][cell_no]" placeholder="03000000000" maxlength="11" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="members[${memberCount}][blood_group]" class="form-label">Blood Group</label>
                                <select class="form-control" id="members[${memberCount}][blood_group]" name="members[${memberCount}][blood_group]">
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="members[${memberCount}][profile_picture]" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" id="members[${memberCount}][profile_picture]" name="members[${memberCount}][profile_picture]" accept="image/*">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="members[${memberCount}][status]" class="form-label">Status</label>
                                <select class="form-control" id="members[${memberCount}][status]" name="members[${memberCount}][status]">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Registration Number</label>
                                <input type="text" class="form-control" value="Auto-generated" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                        <button type="button" class="btn btn-danger btn-sm remove-member" onclick="removeMember(${memberCount})">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;
            
            container.appendChild(memberEntry);
            memberCount++;
            
            // Show remove buttons for all members
            document.querySelectorAll('.remove-member').forEach(btn => {
                btn.style.display = 'block';
            });
        }
        
        function removeMember(memberIndex) {
            const memberEntry = document.querySelector(`[data-member="${memberIndex}"]`);
            if (memberEntry) {
                memberEntry.remove();
                
                // Hide remove buttons if only one member left
                const remainingMembers = document.querySelectorAll('.member-entry');
                if (remainingMembers.length <= 1) {
                    document.querySelectorAll('.remove-member').forEach(btn => {
                        btn.style.display = 'none';
                    });
                }
            }
        }
    </script>
</body>
</html>
