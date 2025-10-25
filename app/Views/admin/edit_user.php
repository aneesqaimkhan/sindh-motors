<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - User Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        .edit-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
            margin: 0 auto;
        }
        .edit-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .edit-body {
            padding: 40px 30px;
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
        .btn-edit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .input-group-text {
            background: transparent;
            border: 2px solid #e9ecef;
            border-right: none;
            border-radius: 10px 0 0 10px;
        }
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        .invalid-feedback {
            font-size: 0.875em;
        }
        .member-entry {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f8f9fa;
        }
        .member-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="edit-card">
                    <div class="edit-header">
                        <h3><i class="fas fa-user-edit me-2"></i>Edit User Information</h3>
                        <p class="mb-0">Update user and member information. All fields are editable by admin.</p>
                    </div>
                    <div class="edit-body">
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

                        <form action="<?= base_url('admin/editUser/' . $user['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            
                           
                            
                            <!-- User Information Section -->
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>User Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Full Name *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                                <input type="text" class="form-control" id="name" name="name" 
                                                       value="<?= $user['name'] ?? '' ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="fname" class="form-label">Father's Name *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-user-friends"></i>
                                                </span>
                                                <input type="text" class="form-control" id="fname" name="fname" 
                                                       value="<?= $user['fname'] ?? '' ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="cnic_no" class="form-label">CNIC Number *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-id-card"></i>
                                                </span>
                                                <input type="text" class="form-control" id="cnic_no" name="cnic_no" 
                                                       value="<?= $user['cnic_no'] ?? '' ?>" placeholder="00000-0000000-0" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="cell_no" class="form-label">Cell Number *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-phone"></i>
                                                </span>
                                                <input type="text" class="form-control" id="cell_no" name="cell_no" 
                                                       value="<?= $user['cell_no'] ?? '' ?>" placeholder="0300-0000000" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="date_of_birth" class="form-label">Date of Birth *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-calendar"></i>
                                                </span>
                                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" 
                                                       value="<?= $user['date_of_birth'] ?? '' ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="category_id" class="form-label">Category</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-tag"></i>
                                                </span>
                                                <select class="form-control" id="category_id" name="category_id">
                                                    <option value="">Select Category</option>
                                                    <option value="golden" <?= ($user['category_id'] ?? '') == 'golden' ? 'selected' : '' ?>>Golden</option>
                                                    <option value="platinum" <?= ($user['category_id'] ?? '') == 'platinum' ? 'selected' : '' ?>>Platinum</option>
                                                    <option value="silver" <?= ($user['category_id'] ?? '') == 'silver' ? 'selected' : '' ?>>Silver</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email Address *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                                <input type="email" class="form-control" id="email" name="email" 
                                                       value="<?= $user['email'] ?? '' ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="status" class="form-label">Status *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-toggle-on"></i>
                                                </span>
                                                <select class="form-control" id="status" name="status" required>
                                                    <option value="active" <?= ($user['status'] ?? '') == 'active' ? 'selected' : '' ?>>Active</option>
                                                    <option value="pending" <?= ($user['status'] ?? '') == 'pending' ? 'selected' : '' ?>>Pending</option>
                                                    <option value="inactive" <?= ($user['status'] ?? '') == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="showroom_name" class="form-label">Showroom Name *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-store"></i>
                                                </span>
                                                <input type="text" class="form-control" id="showroom_name" name="showroom_name" 
                                                       value="<?= $user['showroom_name'] ?? '' ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="showroom_address" class="form-label">Showroom Address *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                </span>
                                                <textarea class="form-control" id="showroom_address" name="showroom_address" 
                                                          rows="3" required><?= $user['showroom_address'] ?? '' ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Membership Section -->
                            <div class="card mb-4">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0"><i class="fas fa-users me-2"></i>Membership Information</h5>
                                </div>
                                <div class="card-body">
                                    <div id="members-container">
                                        <?php if (!empty($members)): ?>
                                            <?php foreach ($members as $index => $member): ?>
                                                <div class="member-entry" data-member="<?= $index ?>">
                                                    <div class="member-header">
                                                        <h6 class="mb-0">Member <?= $index + 1 ?></h6>
                                                    </div>
                                                    <input type="hidden" name="members[<?= $index ?>][id]" value="<?= $member['id'] ?? '' ?>">
                                                    <div class="row">
                                                        <div class="col-md-11">
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="members[<?= $index ?>][member_name]" class="form-label">Member Name *</label>
                                                                    <input type="text" class="form-control" id="members[<?= $index ?>][member_name]" 
                                                                           name="members[<?= $index ?>][member_name]" 
                                                                           value="<?= $member['member_name'] ?? '' ?>" required>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="members[<?= $index ?>][father_name]" class="form-label">Father Name *</label>
                                                                    <input type="text" class="form-control" id="members[<?= $index ?>][father_name]" 
                                                                           name="members[<?= $index ?>][father_name]" 
                                                                           value="<?= $member['father_name'] ?? '' ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4 mb-3">
                                                                    <label for="members[<?= $index ?>][cnic_no]" class="form-label">CNIC No *</label>
                                                                    <input type="text" class="form-control" id="members[<?= $index ?>][cnic_no]" 
                                                                           name="members[<?= $index ?>][cnic_no]" 
                                                                           value="<?= $member['cnic_no'] ?? '' ?>" placeholder="1234567890123" required>
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <label for="members[<?= $index ?>][cell_no]" class="form-label">Cell No *</label>
                                                                    <input type="text" class="form-control" id="members[<?= $index ?>][cell_no]" 
                                                                           name="members[<?= $index ?>][cell_no]" 
                                                                           value="<?= $member['cell_no'] ?? '' ?>" placeholder="03001234567" required>
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <label for="members[<?= $index ?>][status]" class="form-label">Status</label>
                                                                    <select class="form-control" id="members[<?= $index ?>][status]" name="members[<?= $index ?>][status]">
                                                                        <option value="active" <?= ($member['status'] ?? '') == 'active' ? 'selected' : '' ?>>Active</option>
                                                                        <option value="inactive" <?= ($member['status'] ?? '') == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="members[<?= $index ?>][profile_picture]" class="form-label">Profile Picture</label>
                                                                    <input type="file" class="form-control" id="members[<?= $index ?>][profile_picture]" 
                                                                           name="members[<?= $index ?>][profile_picture]" accept="image/*">
                                                                    <?php if (!empty($member['profile_picture'])): ?>
                                                                        <small class="form-text text-muted">Current: <?= $member['profile_picture'] ?></small>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">Current Picture</label>
                                                                    <?php if (!empty($member['profile_picture'])): ?>
                                                                        <div>
                                                                            <img src="<?= base_url('uploads/members/' . $member['profile_picture']) ?>" 
                                                                                 alt="Profile Picture" class="img-thumbnail" style="max-width: 100px;">
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <p class="text-muted">No profile picture</p>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                            <button type="button" class="btn btn-danger btn-sm remove-member" onclick="removeMember(<?= $index ?>)">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <!-- Default member entry if no members exist -->
                                            <div class="member-entry" data-member="0">
                                                <div class="member-header">
                                                    <h6 class="mb-0">Member 1</h6>
                                                </div>
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
                                                                <label for="members[0][status]" class="form-label">Status</label>
                                                                <select class="form-control" id="members[0][status]" name="members[0][status]">
                                                                    <option value="active">Active</option>
                                                                    <option value="inactive">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="members[0][profile_picture]" class="form-label">Profile Picture</label>
                                                                <input type="file" class="form-control" id="members[0][profile_picture]" name="members[0][profile_picture]" accept="image/*">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                        <button type="button" class="btn btn-danger btn-sm remove-member" onclick="removeMember(0)" style="display: none;">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="text-center mb-3">
                                        <button type="button" class="btn btn-success" onclick="addMember()">
                                            <i class="fas fa-plus me-2"></i>Add Another Member
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary me-2">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Users
                                </a>
                                <button type="submit" class="btn btn-primary btn-edit">
                                    <i class="fas fa-save me-2"></i>Update User & Members
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let memberCount = <?= !empty($members) ? count($members) : 1 ?>;
        
        function addMember() {
            const container = document.getElementById('members-container');
            const newMember = document.createElement('div');
            newMember.className = 'member-entry';
            newMember.setAttribute('data-member', memberCount);
            
            newMember.innerHTML = `
                <div class="member-header">
                    <h6 class="mb-0">Member ${memberCount + 1}</h6>
                </div>
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
                                <label for="members[${memberCount}][status]" class="form-label">Status</label>
                                <select class="form-control" id="members[${memberCount}][status]" name="members[${memberCount}][status]">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="members[${memberCount}][profile_picture]" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" id="members[${memberCount}][profile_picture]" name="members[${memberCount}][profile_picture]" accept="image/*">
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
            
            container.appendChild(newMember);
            memberCount++;
            
            // Show remove button for first member if there are multiple members
            if (memberCount > 1) {
                document.querySelector('[data-member="0"] .remove-member').style.display = 'block';
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
        
        // Show remove button for first member if there are multiple members on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (document.querySelectorAll('.member-entry').length > 1) {
                document.querySelector('[data-member="0"] .remove-member').style.display = 'block';
            }
        });
        
        // Test database connection
        function testDatabase() {
            fetch('<?= base_url('admin/testDatabase') ?>')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Database Test: SUCCESS\nUsers: ' + data.users_count + '\nMembers: ' + data.members_count);
                    } else {
                        alert('Database Test: FAILED\nError: ' + data.error);
                    }
                })
                .catch(error => {
                    alert('Database Test: ERROR\n' + error.message);
                });
        }
    </script>
</body>
</html>
