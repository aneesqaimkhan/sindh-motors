<?php

namespace App\Controllers;

use App\Models\ShowroomModel;
use App\Models\MemberModel;

class Showrooms extends BaseController
{
    protected $showroomModel;
    protected $memberModel;

    public function __construct()
    {
        $this->showroomModel = new ShowroomModel();
        $this->memberModel = new MemberModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $category = $this->request->getGet('category');
        $status = $this->request->getGet('status');
        
        // Debug: Log the search parameters
        log_message('debug', 'Search: ' . $search);
        log_message('debug', 'Category: ' . $category);
        log_message('debug', 'Status: ' . $status);
        
        // Build query for all showrooms (including inactive)
        $builder = $this->showroomModel->builder();
        // Removed status filter to show all showrooms including inactive ones
        
        // Apply search filter
        if (!empty($search)) {
            $builder->groupStart()
                    ->like('showroom_name', $search)
                    ->orLike('name', $search)
                    ->orLike('fname', $search)
                    ->orLike('showroom_address', $search)
                    ->orLike('category', $search)
                    ->orLike('cell_no', $search)
                    ->orLike('email', $search)
                    ->groupEnd();
        }
        
        // Apply category filter
        if (!empty($category) && $category !== 'all') {
            $builder->where('category', $category);
        }
        
        // Apply status filter
        if (!empty($status) && $status !== 'all') {
            $builder->where('status', $status);
        }
        
        $showrooms = $builder->orderBy('showroom_name', 'ASC')->get()->getResultArray();
        
        // Add member count to each showroom
        foreach ($showrooms as &$showroom) {
            $memberCount = $this->memberModel->where('showroom_id', $showroom['id'])
                                           ->where('status', 'active')
                                           ->countAllResults();
            $showroom['member_count'] = $memberCount;
        }
        
        // Get unique categories for filter dropdown
        $categories = $this->showroomModel->select('category')
                                         ->groupBy('category')
                                         ->findAll();
        
        // Debug: Log the results
        log_message('debug', 'Found ' . count($showrooms) . ' showrooms');
        
        // Debug: Log showroom statuses
        foreach ($showrooms as $showroom) {
            log_message('debug', 'Showroom: ' . $showroom['showroom_name'] . ' - Status: ' . $showroom['status']);
        }
        
        $data = [
            'title' => 'Our Showrooms - Qasimabad Car Showroom Association',
            'showrooms' => $showrooms,
            'categories' => $categories,
            'search' => $search,
            'selected_category' => $category,
            'selected_status' => $status
        ];
        
        return view('showrooms/index', $data);
    }

    public function members($showroomId)
    {
        // Get showroom details
        $showroom = $this->showroomModel->find($showroomId);
        
        if (!$showroom) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Showroom not found');
        }
        
        // Get members for this showroom
        $members = $this->memberModel->where('showroom_id', $showroomId)
                                   ->where('status', 'active')
                                   ->orderBy('member_name', 'ASC')
                                   ->findAll();
        
        $data = [
            'title' => $showroom['showroom_name'] . ' - Members',
            'showroom' => $showroom,
            'members' => $members
        ];
        
        return view('showrooms/members', $data);
    }
}
