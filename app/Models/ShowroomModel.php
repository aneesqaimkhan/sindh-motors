<?php

namespace App\Models;

use CodeIgniter\Model;

class ShowroomModel extends Model
{
    protected $table            = 'showrooms';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name', 'fname', 'showroom_name', 'showroom_address', 'qr_code', 
        'showroom_registration_number', 'email', 'cnic_no', 'cell_no', 
        'date_of_birth', 'category', 'status', 'is_admin', 'created_at', 'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required|min_length[2]|max_length[100]',
        'fname' => 'required|min_length[2]|max_length[100]',
        'showroom_name' => 'required|min_length[2]|max_length[255]',
        'showroom_address' => 'required|min_length[10]',
        'cnic_no' => 'required|min_length[13]|max_length[15]|is_unique[showrooms.cnic_no]',
        'cell_no' => 'required|min_length[11]|max_length[15]',
        'date_of_birth' => 'required|valid_date',
        'category' => 'in_list[golden,platinum,silver]',
        'status' => 'in_list[active,inactive,pending]',
    ];
    protected $validationMessages   = [
        'name' => [
            'required' => 'Name is required',
            'min_length' => 'Name must be at least 2 characters long',
            'max_length' => 'Name cannot exceed 100 characters',
        ],
        'fname' => [
            'required' => 'Father\'s name is required',
            'min_length' => 'Father\'s name must be at least 2 characters long',
            'max_length' => 'Father\'s name cannot exceed 100 characters',
        ],
        'showroom_name' => [
            'required' => 'Showroom name is required',
            'min_length' => 'Showroom name must be at least 2 characters long',
            'max_length' => 'Showroom name cannot exceed 255 characters',
        ],
        'showroom_address' => [
            'required' => 'Showroom address is required',
            'min_length' => 'Showroom address must be at least 10 characters long',
        ],
        'cnic_no' => [
            'required' => 'CNIC number is required',
            'min_length' => 'CNIC number must be at least 13 characters long',
            'max_length' => 'CNIC number cannot exceed 15 characters',
            'is_unique' => 'This CNIC number is already registered',
        ],
        'cell_no' => [
            'required' => 'Cell number is required',
            'min_length' => 'Cell number must be at least 11 characters long',
            'max_length' => 'Cell number cannot exceed 15 characters',
        ],
        'date_of_birth' => [
            'required' => 'Date of birth is required',
            'valid_date' => 'Please enter a valid date',
        ],
        'category' => [
            'in_list' => 'Please select a valid category',
        ],
        'status' => [
            'in_list' => 'Please select a valid status',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['generateRegistrationNumber', 'generateQrCode'];
    protected $afterInsert    = ['updateQrCodeUrl'];

    /**
     * Generate auto-increment registration number starting from 1000
     */
    protected function generateRegistrationNumber(array $data)
    {
        log_message('debug', 'generateRegistrationNumber callback called');
        if (!isset($data['data']['showroom_registration_number'])) {
            $lastShowroom = $this->orderBy('showroom_registration_number', 'DESC')->first();
            $nextNumber = $lastShowroom ? $lastShowroom['showroom_registration_number'] + 1 : 1000;
            $data['data']['showroom_registration_number'] = $nextNumber;
            log_message('debug', 'Generated registration number: ' . $nextNumber);
        }
        return $data;
    }

    /**
     * Generate QR code URL for showroom members page
     * This will be called after generateRegistrationNumber so we need to get the last ID
     */
    protected function generateQrCode(array $data)
    {
        log_message('debug', 'generateQrCode callback called');
        if (!isset($data['data']['qr_code'])) {
            // We need to generate the URL after insert, so we'll use a flag here
            // The actual URL will be updated after insert using afterInsert callback
            $data['data']['qr_code'] = 'PENDING_QR_CODE';
            log_message('debug', 'Set QR code placeholder');
        }
        return $data;
    }

    /**
     * Update QR code URL after showroom is inserted
     */
    protected function updateQrCodeUrl(array $data)
    {
        log_message('debug', 'updateQrCodeUrl callback called');
        
        if (isset($data['id']) && isset($data['data']['qr_code'])) {
            $showroomId = $data['id'];
            
            // Get base URL from config
            $baseUrl = rtrim(base_url(), '/');
            
            // Generate the URL for this showroom's members page
            $qrCodeUrl = $baseUrl . '/showrooms/members/' . $showroomId;
            
            log_message('debug', 'Generated QR code URL: ' . $qrCodeUrl);
            
            // Update the showroom record with the actual URL using query builder to avoid triggering callbacks
            $this->builder()->where('id', $showroomId)->update(['qr_code' => $qrCodeUrl]);
            
            log_message('debug', 'Updated showroom ' . $showroomId . ' with QR code URL');
        }
        
        return $data;
    }

    public function getShowroomById($id)
    {
        return $this->find($id);
    }

    public function getPendingShowrooms()
    {
        return $this->where('status', 'pending')->findAll();
    }

    public function approveShowroom($id)
    {
        return $this->update($id, ['status' => 'active']);
    }

    public function rejectShowroom($id)
    {
        return $this->update($id, ['status' => 'inactive']);
    }

    public function updateShowroomStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }

    public function updateShowroom($id, $data)
    {
        // Remove any fields that shouldn't be updated
        unset($data['created_at']);
        unset($data['updated_at']);
        unset($data['showroom_registration_number']); // Don't allow updating registration number
        unset($data['qr_code']); // Don't allow updating QR code
        
        $data['id'] = $id;
        
        // Temporarily disable validation for update
        $this->skipValidation(true);
        
        $result = $this->save($data);
        
        // Re-enable validation
        $this->skipValidation(false);
        
        return $result;
    }
}
