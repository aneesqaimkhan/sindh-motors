<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table            = 'members';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'showroom_id', 'member_name', 'father_name', 'member_registration_number', 
        'blood_group', 'cnic_no', 'cell_no', 'profile_picture', 'status', 'created_at', 'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'member_name' => 'required|min_length[2]|max_length[100]',
        'father_name' => 'required|min_length[2]|max_length[100]',
        'cnic_no' => 'required|min_length[13]|max_length[15]|is_unique[members.cnic_no]',
        'cell_no' => 'required|min_length[11]|max_length[15]',
        'blood_group' => 'in_list[A+,A-,B+,B-,AB+,AB-,O+,O-]',
        'profile_picture' => 'permit_empty',
        'status' => 'in_list[active,inactive]',
    ];
    protected $validationMessages   = [
        'member_name' => [
            'required' => 'Member name is required',
            'min_length' => 'Member name must be at least 2 characters long',
            'max_length' => 'Member name cannot exceed 100 characters',
        ],
        'father_name' => [
            'required' => 'Father\'s name is required',
            'min_length' => 'Father\'s name must be at least 2 characters long',
            'max_length' => 'Father\'s name cannot exceed 100 characters',
        ],
        'cnic_no' => [
            'required' => 'CNIC number is required',
            'min_length' => 'CNIC number must be at least 13 characters long',
            'max_length' => 'CNIC number cannot exceed 15 characters',
            'is_unique' => 'CNIC number already exists',
        ],
        'cell_no' => [
            'required' => 'Cell number is required',
            'min_length' => 'Cell number must be at least 11 characters long',
            'max_length' => 'Cell number cannot exceed 15 characters',
        ],
        'blood_group' => [
            'in_list' => 'Please select a valid blood group',
        ],
        'status' => [
            'in_list' => 'Please select a valid status',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['generateRegistrationNumber'];

    /**
     * Generate auto-increment registration number starting from 10000
     */
    protected function generateRegistrationNumber(array $data)
    {
        if (!isset($data['data']['member_registration_number'])) {
            // Get the last registration number
            $lastMember = $this->orderBy('member_registration_number', 'DESC')->first();
            $nextNumber = $lastMember ? $lastMember['member_registration_number'] + 1 : 10000;
            
            $data['data']['member_registration_number'] = $nextNumber;
        }
        
        return $data;
    }

    public function getActiveMembers()
    {
        return $this->where('status', 'active')->findAll();
    }

    public function getMemberById($id)
    {
        return $this->find($id);
    }

    public function updateMemberStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }

    public function getTotalMembers()
    {
        return $this->countAll();
    }

    public function getActiveMembersCount()
    {
        return $this->where('status', 'active')->countAllResults();
    }

    public function getMembersByShowroomId($showroomId)
    {
        return $this->where('showroom_id', $showroomId)->findAll();
    }

    public function addMember($data)
    {
        // Remove any fields that shouldn't be set for new members
        unset($data['id']);
        unset($data['created_at']);
        unset($data['updated_at']);
        
        // Temporarily disable validation for new member
        $this->skipValidation(true);
        
        $result = $this->save($data);
        
        // Re-enable validation
        $this->skipValidation(false);
        
        return $result;
    }

    public function updateMember($id, $data)
    {
        // Remove any fields that shouldn't be updated
        unset($data['created_at']);
        unset($data['updated_at']);
        
        $data['id'] = $id;
        
        // Temporarily disable validation for update
        $this->skipValidation(true);
        
        $result = $this->save($data);
        
        // Re-enable validation
        $this->skipValidation(false);
        
        return $result;
    }

    public function saveMultipleMembers($members, $showroomId)
    {
        $savedMembers = [];
        foreach ($members as $member) {
            $member['showroom_id'] = $showroomId;
            if ($this->save($member)) {
                $savedMembers[] = $this->insertID;
            }
        }
        return $savedMembers;
    }
}


