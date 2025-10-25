<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MemberModel;
use App\Models\ShowroomModel;

class Auth extends BaseController
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
        // Redirect to landing page
        return redirect()->to('/');
    }

    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            log_message('debug', 'Login attempt for email: ' . $email);

            $user = $this->userModel->authenticate($email, $password);

            if ($user) {
                log_message('debug', 'User authenticated successfully: ' . json_encode($user));
                
                // Check if user account is approved
                if ($user['status'] === 'pending') {
                    log_message('debug', 'User account is pending approval');
                    return redirect()->back()->with('error', 'Your account is pending admin approval. Please wait for approval before logging in.');
                }

                if ($user['status'] === 'inactive') {
                    log_message('debug', 'User account is inactive');
                    return redirect()->back()->with('error', 'Your account has been deactivated. Please contact administrator.');
                }

                // Set session data
                session()->set([
                    'user_id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'is_admin' => $user['is_admin'],
                    'logged_in' => true
                ]);

                log_message('debug', 'Session data set: ' . json_encode(session()->get()));
                
                // Verify session was set correctly
                if (!session()->get('logged_in') || !session()->get('user_id')) {
                    log_message('error', 'Session data not set correctly after login');
                    return redirect()->back()->with('error', 'Session error. Please try again.');
                }

                // Redirect admin users to admin panel
                if ($user['is_admin'] == 1) {
                    log_message('debug', 'Redirecting admin user to admin panel');
                    return redirect()->to('admin/')->with('success', 'Admin login successful!');
                }

                log_message('debug', 'Redirecting regular user to dashboard');
                return redirect()->to('dashboard')->with('success', 'Login successful!');
            } else {
                log_message('debug', 'Authentication failed for email: ' . $email);
                return redirect()->back()->with('error', 'Invalid email or password');
            }
        }

        return view('auth/login');
    }

    public function adminLogin()
    {
        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            log_message('debug', 'Admin login attempt for username: ' . $username);

            $user = $this->userModel->authenticate($username, $password);

            if ($user) {
                log_message('debug', 'User authenticated successfully: ' . json_encode($user));
                
                // Check if user account is approved and active
                if ($user['status'] !== 'active') {
                    log_message('debug', 'User account is not active: ' . $user['status']);
                    return redirect()->back()->with('error', 'Your account is not active. Please contact administrator.');
                }

                // Check if user has admin privileges
                if ($user['is_admin'] != 1) {
                    log_message('debug', 'User does not have admin privileges');
                    return redirect()->back()->with('error', 'Access denied. Admin privileges required.');
                }

                // Set session data
                session()->set([
                    'user_id' => $user['id'],
                    'username' => $user['email'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'is_admin' => $user['is_admin'],
                    'logged_in' => true
                ]);

                log_message('debug', 'Admin session data set: ' . json_encode(session()->get()));
                
                // Verify session was set correctly
                if (!session()->get('logged_in') || !session()->get('is_admin')) {
                    log_message('error', 'Admin session data not set correctly after login');
                    return redirect()->back()->with('error', 'Session error. Please try again.');
                }

                log_message('debug', 'Redirecting admin user to admin panel');
                return redirect()->to('/admin/')->with('success', 'Admin login successful!');
            } else {
                log_message('debug', 'Admin authentication failed for username: ' . $username);
                return redirect()->back()->with('error', 'Invalid username or password');
            }
        }

        return view('auth/admin_login');
    }

    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            log_message('debug', 'Register POST request received');
            log_message('debug', 'POST data: ' . json_encode($this->request->getPost()));
            log_message('debug', 'FILES data: ' . json_encode($this->request->getFiles()));
            
            // Check database connection
            try {
                $db = \Config\Database::connect();
                $db->connect();
                log_message('debug', 'Database connection successful');
                
                // Test a simple query
                $testResult = $db->query('SELECT 1 as test');
                if (!$testResult) {
                    throw new \Exception('Database query test failed');
                }
                log_message('debug', 'Database query test successful');
                
            } catch (\Exception $e) {
                log_message('error', 'Database connection failed: ' . $e->getMessage());
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Database connection failed. Please try again later.');
            }
            
            // Prepare showroom data
            $showroomData = [
                'name' => $this->request->getPost('name'),
                'fname' => $this->request->getPost('fname'),
                'cnic_no' => $this->request->getPost('cnic_no'),
                'cell_no' => $this->request->getPost('cell_no'),
                'date_of_birth' => $this->request->getPost('date_of_birth'),
                'category' => $this->request->getPost('category_id') ?: 'golden',
                'status' => 'pending', // Set status to pending for admin approval
                'email' => $this->request->getPost('email'),
                'showroom_name' => $this->request->getPost('showroom_name'),
                'showroom_address' => $this->request->getPost('showroom_address'),
                'is_admin' => 0, // Regular users are not admins
            ];
            
            log_message('debug', 'Showroom data to save: ' . json_encode($showroomData));

            // Start database transaction
            $db = \Config\Database::connect();
            $db->transStart();

            try {
                // Save showroom
                log_message('debug', 'Attempting to save showroom with data: ' . json_encode($showroomData));
                
                if (!$this->showroomModel->save($showroomData)) {
                    $errors = $this->showroomModel->errors();
                    log_message('error', 'Showroom save errors: ' . json_encode($errors));
                    throw new \Exception('Failed to save showroom data: ' . implode(', ', $errors));
                }

                $showroomId = $this->showroomModel->insertID;
                log_message('debug', 'Showroom saved successfully with ID: ' . $showroomId);

                // Handle membership data
                $members = $this->request->getPost('members');
                log_message('debug', 'Members data received: ' . json_encode($members));
                if ($members && is_array($members)) {
                    foreach ($members as $index => $memberData) {
                        log_message('debug', 'Processing member ' . $index . ': ' . json_encode($memberData));
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
                                // Create uploads directory if it doesn't exist
                                $uploadPath = ROOTPATH . 'public/uploads/members';
                                if (!is_dir($uploadPath)) {
                                    mkdir($uploadPath, 0777, true);
                                }
                                
                                $newName = $profilePicture->getRandomName();
                                if ($profilePicture->move($uploadPath, $newName)) {
                                    $member['profile_picture'] = $newName;
                                }
                            }

                            log_message('debug', 'Saving member: ' . json_encode($member));
                            if (!$this->memberModel->save($member)) {
                                $errors = $this->memberModel->errors();
                                log_message('error', 'Member save errors: ' . json_encode($errors));
                                throw new \Exception('Failed to save member data: ' . implode(', ', $errors));
                            }
                        }
                    }
                }

                $db->transComplete();

                if ($db->transStatus() === false) {
                    log_message('error', 'Database transaction failed');
                    throw new \Exception('Database transaction failed');
                }
                
                log_message('debug', 'Database transaction completed successfully');

                return redirect()->to('/')->with('success', 'Showroom Registration Successful! Your registration is pending admin approval.');

            } catch (\Exception $e) {
                $db->transRollback();
                log_message('error', 'Registration failed: ' . $e->getMessage());
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Registration failed: ' . $e->getMessage());
            }
        }

        return view('auth/register');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Logout successful!');
    }

    public function dashboard()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('admin/login');
        }

        $data = [
            'title' => 'Dashboard',
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email')
            ]
        ];

        return view('dashboard/index', $data);
    }
}
