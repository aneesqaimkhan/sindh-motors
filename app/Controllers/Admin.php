<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MemberModel;
use App\Models\ShowroomModel;
use Exception;

class Admin extends BaseController
{
    protected $userModel;
    protected $memberModel;
    protected $showroomModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->memberModel = new MemberModel();
        $this->showroomModel = new ShowroomModel();
    }

    public function index()
    {
        try {
            // Check if user is logged in
            if (!session()->get('logged_in')) {
                return redirect()->to('/admin/login')->with('error', 'Please login to access admin panel');
            }
            
            // Check if user is admin
            if (!session()->get('is_admin')) {
                return redirect()->to('/admin/login')->with('error', 'Access denied. Admin privileges required.');
            }

            // Verify user still exists in database and has admin privileges
            $userId = session()->get('user_id');
            $currentUser = $this->userModel->find($userId);
            
            if (!$currentUser || $currentUser['is_admin'] != 1 || $currentUser['status'] !== 'active') {
                session()->destroy();
                return redirect()->to('/admin/login')->with('error', 'Access denied. Please login again.');
            }

            // Get dashboard data
            $total_users = $this->userModel->countAll();
            $total_showrooms = $this->showroomModel->countAll();
            $total_members = $this->memberModel->countAll();
            
            // Reset query builder before each query
            $active_users = $this->userModel->where('status', 'active')->countAllResults(false);
            $this->userModel->builder()->resetQuery();
            
            $active_showrooms = $this->showroomModel->where('status', 'active')->countAllResults(false);
            $this->showroomModel->builder()->resetQuery();
            
            $pending_showrooms = $this->showroomModel->where('status', 'pending')->countAllResults(false);
            $this->showroomModel->builder()->resetQuery();
            
            $recent_showrooms = $this->showroomModel->orderBy('created_at', 'DESC')->findAll(5);

            $data = [
                'title' => 'Admin Dashboard',
                'total_users' => $total_users,
                'total_showrooms' => $total_showrooms,
                'total_members' => $total_members,
                'active_users' => $active_users,
                'active_showrooms' => $active_showrooms,
                'pending_showrooms' => $pending_showrooms,
                'recent_showrooms' => $recent_showrooms,
            ];

            return view('admin/dashboard', $data);
        } catch (\Exception $e) {
            log_message('error', 'Error loading admin dashboard: ' . $e->getMessage());
            return redirect()->to('/admin/login')->with('error', 'Error loading dashboard: ' . $e->getMessage());
        }
    }

    public function users()
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'title' => 'Showroom Management',
            'showrooms' => $this->showroomModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('admin/showrooms', $data);
    }

    public function addShowroom()
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        if ($this->request->getMethod() === 'post') {
            // Check database connection
            try {
                $db = \Config\Database::connect();
                $db->query('SELECT 1');
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Database connection failed. Please check your database configuration.');
            }

            // Prepare showroom data
            $showroomData = [
                'name' => $this->request->getPost('name'),
                'fname' => $this->request->getPost('fname'),
                'showroom_name' => $this->request->getPost('showroom_name'),
                'showroom_address' => $this->request->getPost('showroom_address'),
                'email' => $this->request->getPost('email'),
                'cnic_no' => $this->request->getPost('cnic_no'),
                'cell_no' => $this->request->getPost('cell_no'),
                'date_of_birth' => $this->request->getPost('date_of_birth'),
                'category' => $this->request->getPost('category') ?: 'golden',
                'status' => $this->request->getPost('status') ?: 'active',
                'is_admin' => 0,
            ];
            
            $db = \Config\Database::connect();
            $db->transStart();

            try {
                if (!$this->showroomModel->save($showroomData)) {
                    throw new \Exception('Failed to save showroom data: ' . implode(', ', $this->showroomModel->errors()));
                }
                $showroomId = $this->showroomModel->insertID;

                // Process members data
                $members = $this->request->getPost('members');
                if ($members && is_array($members)) {
                    foreach ($members as $index => $memberData) {
                        if (!empty($memberData['member_name']) && !empty($memberData['father_name'])) {
                            $member = [
                                'member_name' => $memberData['member_name'],
                                'father_name' => $memberData['father_name'],
                                'cnic_no' => $memberData['cnic_no'],
                                'cell_no' => $memberData['cell_no'],
                                'blood_group' => $memberData['blood_group'] ?? 'A+',
                                'showroom_id' => $showroomId,
                                'status' => 'active'
                            ];

                            // Handle profile picture upload
                            $profilePicture = $this->request->getFile("members.{$index}.profile_picture");
                            if ($profilePicture && $profilePicture->isValid() && !$profilePicture->hasMoved()) {
                                $uploadPath = ROOTPATH . 'public/uploads/members';
                                if (!is_dir($uploadPath)) { 
                                    mkdir($uploadPath, 0777, true); 
                                }
                                $newName = $profilePicture->getRandomName();
                                if ($profilePicture->move($uploadPath, $newName)) {
                                    $member['profile_picture'] = $newName;
                                }
                            }

                            if (!$this->memberModel->save($member)) {
                                throw new \Exception('Failed to save member data: ' . implode(', ', $this->memberModel->errors()));
                            }
                        }
                    }
                }

                $db->transComplete();
                if ($db->transStatus() === false) { 
                    throw new \Exception('Database transaction failed'); 
                }
                
                return redirect()->to('admin/users')->with('success', 'Showroom and members added successfully!');
            } catch (\Exception $e) {
                $db->transRollback();
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Failed to add showroom: ' . $e->getMessage());
            }
        }

        $data = [
            'title' => 'Add New Showroom',
        ];

        return view('admin/add_showroom', $data);
    }

    public function editShowroom($id = null)
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        if (!$id) {
            return redirect()->to('admin/users')->with('error', 'Showroom ID is required');
        }

        $showroom = $this->showroomModel->find($id);
        if (!$showroom) {
            return redirect()->to('admin/users')->with('error', 'Showroom not found');
        }

        // Fetch members for this showroom
        $members = $this->memberModel->getMembersByShowroomId($id);

        if ($this->request->getMethod() === 'post') {
            $showroomData = [
                'name' => $this->request->getPost('name'),
                'fname' => $this->request->getPost('fname'),
                'showroom_name' => $this->request->getPost('showroom_name'),
                'showroom_address' => $this->request->getPost('showroom_address'),
                'email' => $this->request->getPost('email'),
                'cnic_no' => $this->request->getPost('cnic_no'),
                'cell_no' => $this->request->getPost('cell_no'),
                'date_of_birth' => $this->request->getPost('date_of_birth'),
                'category' => $this->request->getPost('category'),
                'status' => $this->request->getPost('status'),
            ];

            // Start transaction
            $db = \Config\Database::connect();
            $db->transStart();

            try {
                // Update showroom
                if (!$this->showroomModel->updateShowroom($id, $showroomData)) {
                    throw new \Exception('Failed to update showroom');
                }

                // Handle members update
                $membersData = $this->request->getPost('members');
                log_message('debug', 'Members data received: ' . json_encode($membersData));
                
                if ($membersData && is_array($membersData)) {
                    // Get existing member IDs for this showroom
                    $existingMemberIds = array_column($members, 'id');
                    $updatedMemberIds = [];
                    
                    foreach ($membersData as $memberIndex => $memberData) {
                        log_message('debug', 'Processing member ' . $memberIndex . ': ' . json_encode($memberData));
                        
                        // Check if member has required data
                        if (empty($memberData['member_name']) || empty($memberData['father_name'])) {
                            continue; // Skip empty member entries
                        }
                        
                        if (isset($memberData['member_id']) && !empty($memberData['member_id'])) {
                            // Update existing member
                            $updateData = [
                                'member_name' => $memberData['member_name'],
                                'father_name' => $memberData['father_name'],
                                'cnic_no' => $memberData['cnic_no'],
                                'cell_no' => $memberData['cell_no'],
                                'blood_group' => $memberData['blood_group'] ?? 'A+',
                                'status' => $memberData['status'] ?? 'active',
                            ];
                            
                            $updatedMemberIds[] = $memberData['member_id'];
                            log_message('debug', 'Updating existing member: ' . json_encode($updateData));
                            
                            // Handle profile picture upload for existing member
                            $profilePicture = $this->request->getFile('members.' . $memberIndex . '.profile_picture');
                            if ($profilePicture && $profilePicture->isValid() && !$profilePicture->hasMoved()) {
                                $uploadPath = ROOTPATH . 'public/uploads/members';
                                if (!is_dir($uploadPath)) {
                                    mkdir($uploadPath, 0777, true);
                                }
                                
                                $newName = $profilePicture->getRandomName();
                                if ($profilePicture->move($uploadPath, $newName)) {
                                    $updateData['profile_picture'] = $newName;
                                    log_message('debug', 'Profile picture uploaded: ' . $newName);
                                }
                            }
                            
                            if (!$this->memberModel->updateMember($memberData['member_id'], $updateData)) {
                                log_message('error', 'Failed to update member: ' . json_encode($this->memberModel->errors()));
                            }
            } else {
                            // Add new member
                            $newMemberData = [
                                'member_name' => $memberData['member_name'],
                                'father_name' => $memberData['father_name'],
                                'cnic_no' => $memberData['cnic_no'],
                                'cell_no' => $memberData['cell_no'],
                                'blood_group' => $memberData['blood_group'] ?? 'A+',
                                'status' => $memberData['status'] ?? 'active',
                                'showroom_id' => $id,
                            ];
                            
                            log_message('debug', 'Adding new member: ' . json_encode($newMemberData));
                            
                            // Handle profile picture upload for new member
                            $profilePicture = $this->request->getFile('members.' . $memberIndex . '.profile_picture');
                            if ($profilePicture && $profilePicture->isValid() && !$profilePicture->hasMoved()) {
                                $uploadPath = ROOTPATH . 'public/uploads/members';
                                if (!is_dir($uploadPath)) {
                                    mkdir($uploadPath, 0777, true);
                                }
                                
                                $newName = $profilePicture->getRandomName();
                                if ($profilePicture->move($uploadPath, $newName)) {
                                    $newMemberData['profile_picture'] = $newName;
                                    log_message('debug', 'New member profile picture uploaded: ' . $newName);
                                }
                            }
                            
                            if (!$this->memberModel->addMember($newMemberData)) {
                                log_message('error', 'Failed to add new member: ' . json_encode($this->memberModel->errors()));
                            }
                        }
                    }
                    
                    // Delete members that were removed from the form
                    $membersToDelete = array_diff($existingMemberIds, $updatedMemberIds);
                    foreach ($membersToDelete as $memberId) {
                        if ($this->memberModel->delete($memberId)) {
                            log_message('debug', 'Member deleted successfully: ' . $memberId);
                        } else {
                            log_message('error', 'Failed to delete member: ' . $memberId);
                        }
                    }
                }

                $db->transComplete();
                
                if ($db->transStatus() === false) {
                    throw new \Exception('Database transaction failed');
                }
                
                return redirect()->to('admin/users')->with('success', 'Showroom and members updated successfully!');
            } catch (\Exception $e) {
                $db->transRollback();
                log_message('error', 'Error updating showroom: ' . $e->getMessage());
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Failed to update showroom: ' . $e->getMessage());
            }
        }

        $data = [
            'title' => 'Edit Showroom',
            'showroom' => $showroom,
            'members' => $members,
        ];

        return view('admin/edit_showroom', $data);
    }

    public function viewShowroomDetails($id = null)
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        if (!$id) {
            return redirect()->to('admin/users')->with('error', 'Showroom ID is required');
        }

        $showroom = $this->showroomModel->find($id);
        if (!$showroom) {
            return redirect()->to('admin/users')->with('error', 'Showroom not found');
        }

        $members = $this->memberModel->getMembersByShowroomId($id);

        $data = [
            'title' => 'Showroom Details',
            'showroom' => $showroom,
            'members' => $members,
        ];

        return view('admin/showroom_details', $data);
    }

    public function generateCertificate($id = null)
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        if (!$id) {
            return redirect()->to('admin/users')->with('error', 'Showroom ID is required');
        }

        $showroom = $this->showroomModel->find($id);
        if (!$showroom) {
            return redirect()->to('admin/users')->with('error', 'Showroom not found');
        }

        $members = $this->memberModel->getMembersByShowroomId($id);

        $data = [
            'title' => 'QCSA Certificate',
            'showroom' => $showroom,
            'members' => $members,
        ];

        // Check if showroom category is Platinum to use Platinum certificate
        if (strtolower($showroom['category']) === 'platinum') {
            return view('admin/qcsa_certificate_platinum_new', $data);
        } else {
            return view('admin/qcsa_certificate', $data);
        }
    }

    public function approveShowroom($id = null)
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        if (!$id) {
            return redirect()->to('admin/users')->with('error', 'Showroom ID is required');
        }

        if ($this->showroomModel->approveShowroom($id)) {
            return redirect()->to('admin/users')->with('success', 'Showroom approved successfully!');
        } else {
            return redirect()->to('admin/users')->with('error', 'Failed to approve showroom');
        }
    }

    public function toggleShowroomStatus($id = null)
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        if (!$id) {
            return redirect()->to('admin/users')->with('error', 'Showroom ID is required');
        }

        $showroom = $this->showroomModel->find($id);
        if (!$showroom) {
            return redirect()->to('admin/users')->with('error', 'Showroom not found');
        }

        $newStatus = $showroom['status'] === 'active' ? 'inactive' : 'active';
        
        if ($this->showroomModel->updateShowroomStatus($id, $newStatus)) {
            $message = $newStatus === 'active' ? 'Showroom activated successfully!' : 'Showroom deactivated successfully!';
            return redirect()->to('admin/users')->with('success', $message);
        } else {
            return redirect()->to('admin/users')->with('error', 'Failed to update showroom status');
        }
    }

    public function deleteShowroom($id = null)
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        if (!$id) {
            return redirect()->to('admin/users')->with('error', 'Showroom ID is required');
        }

        if ($this->showroomModel->delete($id)) {
            return redirect()->to('admin/users')->with('success', 'Showroom deleted successfully!');
        } else {
            return redirect()->to('admin/users')->with('error', 'Failed to delete showroom');
        }
    }

    public function addUser()
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        if ($this->request->getMethod() === 'post') {
            $data = [
                'name' => $this->request->getPost('name'),
                'fname' => $this->request->getPost('fname'),
                'cnic_no' => $this->request->getPost('cnic_no'),
                'cell_no' => $this->request->getPost('cell_no'),
                'date_of_birth' => $this->request->getPost('date_of_birth'),
                'category_id' => $this->request->getPost('category_id') ?: null,
                'status' => $this->request->getPost('status') ?: 'active',
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'showroom_name' => $this->request->getPost('showroom_name'),
                'showroom_address' => $this->request->getPost('showroom_address'),
                'is_admin' => 0,
            ];

            if ($this->userModel->save($data)) {
                return redirect()->to('admin/users')->with('success', 'User added successfully!');
            } else {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->userModel->errors());
            }
        }

        $data = [
            'title' => 'Add New User',
        ];

        return view('admin/add_user', $data);
    }



    public function testEdit($id = null)
    {
        log_message('debug', 'TestEdit method called with ID: ' . $id);
        
        $data = [
            'title' => 'Test Edit',
            'user' => [
                'id' => $id,
                'name' => 'Test User',
                'email' => 'test@example.com'
            ],
        ];

        log_message('debug', 'Test data: ' . json_encode($data));

        return view('admin/edit_user', $data);
    }

    public function testUpdate($id = null)
    {
        log_message('debug', 'TestUpdate method called with ID: ' . $id);
        
        if ($this->request->getMethod() === 'post') {
            $postData = $this->request->getPost();
            log_message('debug', 'Test POST data: ' . json_encode($postData));
            
            // Simple test update
            $testData = [
                'id' => $id,
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
            ];
            
            log_message('debug', 'Test update data: ' . json_encode($testData));
            
            if ($this->userModel->updateUser($id, $testData)) {
                log_message('debug', 'Test update successful');
                return redirect()->to('admin/users')->with('success', 'Test update successful!');
            } else {
                log_message('error', 'Test update failed: ' . json_encode($this->userModel->errors()));
                return redirect()->back()->with('error', 'Test update failed');
            }
        }
        
        return redirect()->to('admin/users');
    }

    public function testDatabase()
    {
        log_message('debug', 'Testing database connection...');
        
        try {
            $db = \Config\Database::connect();
            $result = $db->query('SELECT 1 as test')->getRow();
            log_message('debug', 'Database test result: ' . json_encode($result));
            
            // Test user table
            $userResult = $db->query('SELECT COUNT(*) as count FROM users')->getRow();
            log_message('debug', 'Users table count: ' . json_encode($userResult));
            
            // Test members table
            $memberResult = $db->query('SELECT COUNT(*) as count FROM members')->getRow();
            log_message('debug', 'Members table count: ' . json_encode($memberResult));
            
            return $this->response->setJSON([
                'success' => true,
                'database' => 'Connected',
                'users_count' => $userResult->count,
                'members_count' => $memberResult->count
            ]);
        } catch (Exception $e) {
            log_message('error', 'Database test failed: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function editUser($id = null)
    {
        
        log_message('debug', 'EditUser method called with ID: ' . $id);
        
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            log_message('debug', 'User not logged in or not admin');
            return redirect()->to('/admin/login');
        }

        if (!$id) {
            log_message('debug', 'No user ID provided');
            return redirect()->to('admin/users')->with('error', 'User ID is required');
        }

        // Validate that ID is a number
        if (!is_numeric($id)) {
            log_message('debug', 'Invalid user ID format: ' . $id);
            return redirect()->to('admin/users')->with('error', 'Invalid user ID format');
        }

        log_message('debug', 'Attempting to find user with ID: ' . $id);
        
        try {
            $user = $this->userModel->find($id);
            // Also fetch members for this showroom
            $members = $this->memberModel->getMembersByShowroomId($id);
        } catch (Exception $e) {
            log_message('error', 'Database error finding user: ' . $e->getMessage());
            return redirect()->to('admin/users')->with('error', 'Database error: ' . $e->getMessage());
        }
        
        if (!$user) {
            log_message('debug', 'User not found in database');
            return redirect()->to('admin/users')->with('error', 'User not found');
        }

        log_message('debug', 'Edit user data: ' . json_encode($user));
        log_message('debug', 'Edit members data: ' . json_encode($members));

        if ($this->request->getMethod() === 'post') {
            log_message('debug', 'Processing POST request for user edit');
            
            // Get all POST data for debugging
            $postData = $this->request->getPost();
            log_message('debug', 'POST data received: ' . json_encode($postData));
            
            // Update user data - only include fields that exist in the database
            $userData = [
                'id' => $id,
                'name' => $this->request->getPost('name'),
                'fname' => $this->request->getPost('fname'),
                'cnic_no' => $this->request->getPost('cnic_no'),
                'cell_no' => $this->request->getPost('cell_no'),
                'date_of_birth' => $this->request->getPost('date_of_birth'),
                'category_id' => $this->request->getPost('category_id') ?: null,
                'status' => $this->request->getPost('status'),
                'email' => $this->request->getPost('email'),
                'showroom_name' => $this->request->getPost('showroom_name'),
                'showroom_address' => $this->request->getPost('showroom_address'),
            ];

            log_message('debug', 'User data to update: ' . json_encode($userData));

            // Update user
            try {
                // Use the safer update method
                if ($this->userModel->updateUser($id, $userData)) {
                    log_message('debug', 'User updated successfully');
                    
                    // Handle members update
                    $membersData = $this->request->getPost('members');
                    log_message('debug', 'Members data received: ' . json_encode($membersData));
                    
                    if ($membersData && is_array($membersData)) {
                        // Filter out empty member entries
                        $membersData = array_filter($membersData, function($member) {
                            return !empty($member['member_name']) && !empty($member['father_name']) && 
                                   !empty($member['cnic_no']) && !empty($member['cell_no']);
                        });
                        
                        // Get existing member IDs for this user
                        $existingMemberIds = array_column($members, 'id');
                        $updatedMemberIds = [];
                        
                        foreach ($membersData as $memberIndex => $memberData) {
                            log_message('debug', 'Processing member ' . $memberIndex . ': ' . json_encode($memberData));
                            
                            if (isset($memberData['id']) && !empty($memberData['id'])) {
                                // Update existing member
                                $updateData = [
                                    'member_name' => $memberData['member_name'],
                                    'father_name' => $memberData['father_name'],
                                    'cnic_no' => $memberData['cnic_no'],
                                    'cell_no' => $memberData['cell_no'],
                                    'status' => $memberData['status'] ?? 'active',
                                ];
                                
                                $updatedMemberIds[] = $memberData['id'];
                                log_message('debug', 'Updating existing member: ' . json_encode($updateData));
                                
                                // Handle profile picture upload for existing member
                                $profilePicture = $this->request->getFile('members.' . $memberIndex . '.profile_picture');
                                if ($profilePicture && $profilePicture->isValid() && !$profilePicture->hasMoved()) {
                                    $uploadPath = ROOTPATH . 'public/uploads/members';
                                    if (!is_dir($uploadPath)) {
                                        mkdir($uploadPath, 0777, true);
                                    }
                                    
                                    $newName = $profilePicture->getRandomName();
                                    if ($profilePicture->move($uploadPath, $newName)) {
                                        $updateData['profile_picture'] = $newName;
                                        log_message('debug', 'Profile picture uploaded: ' . $newName);
                                    }
                                }
                                
                                // Temporarily disable validation for member update
                                $this->memberModel->skipValidation(true);
                                if ($this->memberModel->updateMember($memberData['id'], $updateData)) {
                                    log_message('debug', 'Member updated successfully: ' . $memberData['id']);
                                } else {
                                    log_message('error', 'Failed to update member: ' . json_encode($this->memberModel->errors()));
                                }
                                $this->memberModel->skipValidation(false);
                            } else {
                                // Add new member
                                $newMemberData = [
                                    'member_name' => $memberData['member_name'],
                                    'father_name' => $memberData['father_name'],
                                    'cnic_no' => $memberData['cnic_no'],
                                    'cell_no' => $memberData['cell_no'],
                                    'status' => $memberData['status'] ?? 'active',
                                    'user_id' => $id,
                                ];
                                
                                log_message('debug', 'Adding new member: ' . json_encode($newMemberData));
                                
                                // Handle profile picture upload for new member
                                $profilePicture = $this->request->getFile('members.' . $memberIndex . '.profile_picture');
                                if ($profilePicture && $profilePicture->isValid() && !$profilePicture->hasMoved()) {
                                    $uploadPath = ROOTPATH . 'public/uploads/members';
                                    if (!is_dir($uploadPath)) {
                                        mkdir($uploadPath, 0777, true);
                                    }
                                    
                                    $newName = $profilePicture->getRandomName();
                                    if ($profilePicture->move($uploadPath, $newName)) {
                                        $newMemberData['profile_picture'] = $newName;
                                        log_message('debug', 'New member profile picture uploaded: ' . $newName);
                                    }
                                }
                                
                                // Temporarily disable validation for new member
                                $this->memberModel->skipValidation(true);
                                if ($this->memberModel->addMember($newMemberData)) {
                                    log_message('debug', 'New member added successfully');
                                } else {
                                    log_message('error', 'Failed to add new member: ' . json_encode($this->memberModel->errors()));
                                }
                                $this->memberModel->skipValidation(false);
                            }
                        }
                        
                        // Delete members that were removed from the form
                        $membersToDelete = array_diff($existingMemberIds, $updatedMemberIds);
                        foreach ($membersToDelete as $memberId) {
                            if ($this->memberModel->delete($memberId)) {
                                log_message('debug', 'Member deleted successfully: ' . $memberId);
                            } else {
                                log_message('error', 'Failed to delete member: ' . $memberId);
                            }
                        }
                    } else {
                        // If no members submitted, delete all existing members for this user
                        if (!empty($members)) {
                            foreach ($members as $member) {
                                if ($this->memberModel->delete($member['id'])) {
                                    log_message('debug', 'Member deleted (no members submitted): ' . $member['id']);
                                } else {
                                    log_message('error', 'Failed to delete member: ' . $member['id']);
                                }
                            }
                        }
                    }
                    
                    return redirect()->to('admin/users')->with('success', 'User and members updated successfully!');
                } else {
                    log_message('error', 'Failed to update user: ' . json_encode($this->userModel->errors()));
                    return redirect()->back()
                        ->withInput()
                        ->with('errors', $this->userModel->errors());
                }
            } catch (Exception $e) {
                log_message('error', 'Exception during user update: ' . $e->getMessage());
                log_message('error', 'Exception trace: ' . $e->getTraceAsString());
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Error updating user: ' . $e->getMessage());
            }
        }

        $data = [
            'title' => 'Edit User',
            'user' => $user,
            'members' => $members,
        ];

        log_message('debug', 'Rendering edit user view with data: ' . json_encode($data));

        return view('admin/edit_user', $data);
    }

    public function deleteUser($id = null)
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        if (!$id) {
            return redirect()->to('admin/users')->with('error', 'User ID is required');
        }

        if ($this->userModel->delete($id)) {
            return redirect()->to('admin/users')->with('success', 'User deleted successfully!');
        } else {
            return redirect()->to('admin/users')->with('error', 'Failed to delete user');
        }
    }

    public function toggleStatus($id = null)
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        if (!$id) {
            return redirect()->to('admin/users')->with('error', 'User ID is required');
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User not found');
        }

        $newStatus = $user['status'] === 'active' ? 'inactive' : 'active';
        
        if ($this->userModel->updateUserStatus($id, $newStatus)) {
            return redirect()->to('admin/users')->with('success', 'User status updated successfully!');
        } else {
            return redirect()->to('admin/users')->with('error', 'Failed to update user status');
        }
    }

    public function approveUser($id = null)
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        if (!$id) {
            return redirect()->to('admin/users')->with('error', 'User ID is required');
        }

        if ($this->userModel->approveUser($id)) {
            return redirect()->to('admin/users')->with('success', 'User approved successfully!');
        } else {
            return redirect()->to('admin/users')->with('error', 'Failed to approve user');
        }
    }

    public function rejectUser($id = null)
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        if (!$id) {
            return redirect()->to('admin/users')->with('error', 'User ID is required');
        }

        if ($this->userModel->rejectUser($id)) {
            return redirect()->to('admin/users')->with('success', 'User rejected successfully!');
        } else {
            return redirect()->to('admin/users')->with('error', 'Failed to reject user');
        }
    }

    public function viewUserDetails($id = null)
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        if (!$id) {
            return redirect()->to('admin/users')->with('error', 'User ID is required');
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User not found');
        }

        $members = $this->memberModel->getMembersByUserId($id);

        $data = [
            'title' => 'User Details',
            'user' => $user,
            'members' => $members,
        ];

        return view('admin/user_details', $data);
    }

    public function pendingUsers()
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'title' => 'Pending Approvals',
            'users' => $this->userModel->getPendingUsers(),
        ];

        return view('admin/pending_users', $data);
    }

    // Membership Management Methods
    public function getMember($id = null)
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized access']);
        }

        if (!$id) {
            return $this->response->setJSON(['success' => false, 'message' => 'Member ID is required']);
        }

        $member = $this->memberModel->find($id);
        if (!$member) {
            return $this->response->setJSON(['success' => false, 'message' => 'Member not found']);
        }

        return $this->response->setJSON(['success' => true, 'member' => $member]);
    }

    public function addMember()
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized access']);
        }

        if ($this->request->getMethod() !== 'post') {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request method']);
        }

        $data = [
            'member_name' => $this->request->getPost('member_name'),
            'father_name' => $this->request->getPost('father_name'),
            'cnic_no' => $this->request->getPost('cnic_no'),
            'cell_no' => $this->request->getPost('cell_no'),
            'user_id' => $this->request->getPost('user_id'),
            'status' => $this->request->getPost('status'),
        ];

        // Handle profile picture upload
        $profilePicture = $this->request->getFile('profile_picture');
        if ($profilePicture && $profilePicture->isValid() && !$profilePicture->hasMoved()) {
            $uploadPath = ROOTPATH . 'public/uploads/members';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            $newName = $profilePicture->getRandomName();
            if ($profilePicture->move($uploadPath, $newName)) {
                $data['profile_picture'] = $newName;
            }
        }

        if ($this->memberModel->save($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Member added successfully']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to add member']);
        }
    }

    public function updateMember($id = null)
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized access']);
        }

        if (!$id || $this->request->getMethod() !== 'post') {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        $data = [
            'id' => $id,
            'member_name' => $this->request->getPost('member_name'),
            'father_name' => $this->request->getPost('father_name'),
            'cnic_no' => $this->request->getPost('cnic_no'),
            'cell_no' => $this->request->getPost('cell_no'),
            'status' => $this->request->getPost('status'),
        ];

        // Handle profile picture upload
        $profilePicture = $this->request->getFile('profile_picture');
        if ($profilePicture && $profilePicture->isValid() && !$profilePicture->hasMoved()) {
            $uploadPath = ROOTPATH . 'public/uploads/members';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            $newName = $profilePicture->getRandomName();
            if ($profilePicture->move($uploadPath, $newName)) {
                $data['profile_picture'] = $newName;
            }
        }

        if ($this->memberModel->save($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Member updated successfully']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to update member']);
        }
    }

    public function toggleMemberStatus($id = null, $status = null)
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized access']);
        }

        if (!$id || !$status) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid parameters']);
        }

        if ($this->memberModel->updateMemberStatus($id, $status)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Member status updated successfully']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to update member status']);
        }
    }

    public function deleteMember($id = null)
    {
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized access']);
        }

        if (!$id) {
            return $this->response->setJSON(['success' => false, 'message' => 'Member ID is required']);
        }

        if ($this->memberModel->delete($id)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Member deleted successfully']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete member']);
        }
    }

    public function generateMemberCard($memberId = null)
    {
        // Check if user is logged in and is admin
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login')->with('error', 'Please login to access this feature');
        }

        if (!$memberId) {
            return redirect()->to('/admin/users')->with('error', 'Member ID is required');
        }

        // Get member details
        $member = $this->memberModel->find($memberId);
        
        if (!$member) {
            return redirect()->to('/admin/users')->with('error', 'Member not found');
        }

        // Get showroom details for this member
        $showroom = $this->showroomModel->find($member['showroom_id']);
        
        if (!$showroom) {
            return redirect()->to('/admin/users')->with('error', 'Showroom not found for this member');
        }

        $data = [
            'title' => 'Member Card - ' . $member['member_name'],
            'member' => $member,
            'showroom' => $showroom
        ];

        // Check if showroom category is Platinum to use Platinum membership card
        if (strtolower($showroom['category']) === 'platinum') {
            return view('admin/membership_card_platinum', $data);
        } else {
            return view('member_card', $data);
        }
    }

    public function generateMemberCardFront($memberId = null)
    {
        // Check if user is logged in and is admin
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login')->with('error', 'Please login to access this feature');
        }

        if (!$memberId) {
            return redirect()->to('/admin/users')->with('error', 'Member ID is required');
        }

        // Get member details
        $member = $this->memberModel->find($memberId);
        
        if (!$member) {
            return redirect()->to('/admin/users')->with('error', 'Member not found');
        }

        // Get showroom details for this member
        $showroom = $this->showroomModel->find($member['showroom_id']);
        
        if (!$showroom) {
            return redirect()->to('/admin/users')->with('error', 'Showroom not found for this member');
        }

        $data = [
            'title' => 'Member Card Front - ' . $member['member_name'],
            'member' => $member,
            'showroom' => $showroom
        ];

        return view('member_card_front', $data);
    }

    public function generateMemberCardBack($memberId = null)
    {
        // Check if user is logged in and is admin
        if (!session()->get('logged_in') || !session()->get('is_admin')) {
            return redirect()->to('/admin/login')->with('error', 'Please login to access this feature');
        }

        if (!$memberId) {
            return redirect()->to('/admin/users')->with('error', 'Member ID is required');
        }

        // Get member details
        $member = $this->memberModel->find($memberId);
        
        if (!$member) {
            return redirect()->to('/admin/users')->with('error', 'Member not found');
        }

        // Get showroom details for this member
        $showroom = $this->showroomModel->find($member['showroom_id']);
        
        if (!$showroom) {
            return redirect()->to('/admin/users')->with('error', 'Showroom not found for this member');
        }

        $data = [
            'title' => 'Member Card Back - ' . $member['member_name'],
            'member' => $member,
            'showroom' => $showroom
        ];

        return view('member_card_back', $data);
    }

    /**
     * Generate QR Code image from URL using QR Server API
     * 
     * @param int $showroomId The showroom ID
     * @return Response Image response
     */
    public function generateQrCodeImage($showroomId = null)
    {
        if (!$showroomId) {
            return $this->response->setStatusCode(400)->setBody('Showroom ID is required');
        }

        // Get showroom details
        $showroom = $this->showroomModel->find($showroomId);
        
        if (!$showroom) {
            return $this->response->setStatusCode(404)->setBody('Showroom not found');
        }

        // Get the QR code URL from showroom record
        $qrCodeUrl = $showroom['qr_code'] ?? '';
        
        if (empty($qrCodeUrl) || $qrCodeUrl === 'PENDING_QR_CODE') {
            return $this->response->setStatusCode(400)->setBody('QR code URL not available');
        }

        try {
            // Use QR Server API to generate QR code
            $apiUrl = 'https://api.qrserver.com/v1/create-qr-code/';
            $params = [
                'data' => $qrCodeUrl,
                'size' => '200x200',
                'margin' => '10'
            ];
            
            $qrImageUrl = $apiUrl . '?' . http_build_query($params);
            
            // Fetch the QR code image
            $qrImage = file_get_contents($qrImageUrl);
            
            if ($qrImage === false) {
                throw new \Exception('Failed to generate QR code from API');
            }

            // Return image response
            return $this->response
                ->setHeader('Content-Type', 'image/png')
                ->setHeader('Cache-Control', 'public, max-age=86400') // Cache for 24 hours
                ->setBody($qrImage);
                
        } catch (\Exception $e) {
            log_message('error', 'Error generating QR code: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setBody('Error generating QR code');
        }
    }
}
