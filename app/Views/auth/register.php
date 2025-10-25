<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - User Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        .register-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 800px;
            width: 100%;
            margin: 0 auto;
        }
        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .register-body {
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
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
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
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="register-card">
                    <div class="register-header">
                        <h3><i class="fas fa-user-plus me-2"></i>User Registration</h3>
                        <p class="mb-0">Please fill in all the required information to create your account.</p>
                    </div>
                    <div class="register-body">
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

                        <form action="<?= base_url('register') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control" id="name" name="name" 
                                               value="<?= old('name') ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="fname" class="form-label">Father's Name *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user-friends"></i>
                                        </span>
                                        <input type="text" class="form-control" id="fname" name="fname" 
                                               value="<?= old('fname') ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="cnic_no" class="form-label">CNIC Number *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                        <input type="text" class="form-control" id="cnic_no" name="cnic_no" 
                                               value="<?= old('cnic_no') ?>" placeholder="00000-0000000-0" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="cell_no" class="form-label">Cell Number *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                        <input type="text" class="form-control" id="cell_no" name="cell_no" 
                                               value="<?= old('cell_no') ?>" placeholder="0300-0000000" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </span>
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" 
                                               value="<?= old('date_of_birth') ?>" required>
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
                                            <option value="golden" <?= old('category_id') == 'golden' ? 'selected' : '' ?>>Golden</option>
                                            <option value="platinum" <?= old('category_id') == 'platinum' ? 'selected' : '' ?>>Platinum</option>
                                            <option value="silver" <?= old('category_id') == 'silver' ? 'selected' : '' ?>>Silver</option>
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
                                               value="<?= old('email') ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="showroom_name" class="form-label">Showroom Name *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-store"></i>
                                        </span>
                                        <input type="text" class="form-control" id="showroom_name" name="showroom_name" 
                                               value="<?= old('showroom_name') ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="showroom_address" class="form-label">Showroom Address *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        <textarea class="form-control" id="showroom_address" name="showroom_address" 
                                                  rows="3" required><?= old('showroom_address') ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Membership Section -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="mb-0"><i class="fas fa-users me-2"></i>Membership Information</h5>
                                        </div>
                                        <div class="card-body">
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
                                                                    <label for="members[0][blood_group]" class="form-label">Blood Group</label>
                                                                    <select class="form-control" id="members[0][blood_group]" name="members[0][blood_group]">
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
                                                                <div class="col-md-12 mb-3">
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
                                <button type="submit" class="btn btn-primary btn-register">
                                    <i class="fas fa-user-plus me-2"></i>Register
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
        let memberCount = 1;
        
        // Debug form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            console.log('Form submitted');
            const formData = new FormData(this);
            for (let [key, value] of formData.entries()) {
                console.log(key + ': ' + value);
            }
        });
        
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
                            <div class="col-md-12 mb-3">
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
    </script>
</body>
</html>
