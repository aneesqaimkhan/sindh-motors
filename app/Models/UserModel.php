<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name', 'status', 'email', 'password', 'is_admin', 'created_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required|min_length[2]|max_length[100]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'status' => 'in_list[active,inactive,pending]',
    ];
    protected $validationMessages   = [
        'name' => [
            'required' => 'Name is required',
            'min_length' => 'Name must be at least 2 characters long',
            'max_length' => 'Name cannot exceed 100 characters',
        ],
        'email' => [
            'required' => 'Email is required',
            'valid_email' => 'Please enter a valid email address',
            'is_unique' => 'Email already exists',
        ],
        'password' => [
            'required' => 'Password is required',
            'min_length' => 'Password must be at least 6 characters long',
        ],
        'status' => [
            'in_list' => 'Please select a valid status',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }

    public function authenticate($email, $password)
    {
        $user = $this->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public function getActiveUsers()
    {
        return $this->where('status', 'active')->findAll();
    }

    public function getUserById($id)
    {
        return $this->find($id);
    }

    public function updateUserStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }

    public function getPendingUsers()
    {
        return $this->where('status', 'pending')->findAll();
    }

    public function getAdminUsers()
    {
        return $this->where('is_admin', 1)->findAll();
    }

    public function isAdmin($userId)
    {
        $user = $this->find($userId);
        return $user && $user['is_admin'] == 1;
    }

    public function approveUser($id)
    {
        return $this->update($id, ['status' => 'active']);
    }

    public function rejectUser($id)
    {
        return $this->update($id, ['status' => 'inactive']);
    }

    public function getUsersWithMembers()
    {
        try {
            $result = $this->select('users.*, COALESCE(COUNT(members.id), 0) as member_count')
                        ->join('members', 'members.user_id = users.id', 'left')
                        ->groupBy('users.id')
                        ->orderBy('users.created_at', 'DESC')
                        ->findAll();
            
            log_message('debug', 'getUsersWithMembers result: ' . json_encode($result));
            return $result;
        } catch (Exception $e) {
            log_message('error', 'Error in getUsersWithMembers: ' . $e->getMessage());
            // Fallback to simple user list if join fails
            return $this->orderBy('created_at', 'DESC')->findAll();
        }
    }

    public function updateUser($id, $data)
    {
        // Remove any fields that shouldn't be updated
        unset($data['created_at']);
        unset($data['updated_at']);
        
        // If password is empty, don't update it
        if (empty($data['password'])) {
            unset($data['password']);
        }
        
        
        $data['id'] = $id;
        
        // Temporarily disable validation for update
        $this->skipValidation(true);
        
        $result = $this->save($data);
        
        // Re-enable validation
        $this->skipValidation(false);
        
        return $result;
    }

    public function getAllUsersWithMembers()
    {
        try {
            $result = $this->select('users.*, COALESCE(COUNT(members.id), 0) as member_count')
                        ->join('members', 'members.user_id = users.id', 'left')
                        ->groupBy('users.id')
                        ->orderBy('users.created_at', 'DESC')
                        ->findAll();
            
            log_message('debug', 'getAllUsersWithMembers result: ' . json_encode($result));
            return $result;
        } catch (Exception $e) {
            log_message('error', 'Error in getAllUsersWithMembers: ' . $e->getMessage());
            // Fallback to simple user list if join fails
            return $this->orderBy('created_at', 'DESC')->findAll();
        }
    }
}
