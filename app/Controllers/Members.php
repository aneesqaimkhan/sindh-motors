<?php

namespace App\Controllers;

use App\Models\MemberModel;

class Members extends BaseController
{
    protected $memberModel;

    public function __construct()
    {
        $this->memberModel = new MemberModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('login');
        }

        $data = [
            'title' => 'Staff Members',
            'members' => $this->memberModel->findAll(),
            'total_members' => $this->memberModel->getTotalMembers(),
            'active_members' => $this->memberModel->getActiveMembersCount(),
        ];

        return view('members/index', $data);
    }

    public function add()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('login');
        }

        if ($this->request->getMethod() === 'post') {
            $members = $this->request->getPost('members');
            $successCount = 0;
            $errorCount = 0;

            foreach ($members as $index => $memberData) {
                // Handle file upload for each member
                $profilePicture = null;
                $file = $this->request->getFile("members.{$index}.profile_picture");
                if ($file && $file->isValid()) {
                    $newName = $file->getRandomName();
                    $file->move(ROOTPATH . 'public/uploads/members', $newName);
                    $profilePicture = $newName;
                }

                $data = [
                    'member_name' => $memberData['member_name'],
                    'father_name' => $memberData['father_name'],
                    'cnic_no' => $memberData['cnic_no'],
                    'cell_no' => $memberData['cell_no'],
                    'profile_picture' => $profilePicture,
                    'status' => 'active',
                ];

                if ($this->memberModel->save($data)) {
                    $successCount++;
                } else {
                    $errorCount++;
                }
            }

            if ($successCount > 0) {
                $message = "Successfully added {$successCount} member(s)";
                if ($errorCount > 0) {
                    $message .= ". {$errorCount} member(s) failed to add.";
                }
                return redirect()->to('members')->with('success', $message);
            } else {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Failed to add members. Please check your input.');
            }
        }

        $data = [
            'title' => 'Add Staff Members',
        ];

        return view('members/add', $data);
    }

    public function edit($id = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('login');
        }

        if (!$id) {
            return redirect()->to('members')->with('error', 'Member ID is required');
        }

        $member = $this->memberModel->find($id);
        if (!$member) {
            return redirect()->to('members')->with('error', 'Member not found');
        }

        if ($this->request->getMethod() === 'post') {
            $data = [
                'id' => $id,
                'member_name' => $this->request->getPost('member_name'),
                'father_name' => $this->request->getPost('father_name'),
                'cnic_no' => $this->request->getPost('cnic_no'),
                'cell_no' => $this->request->getPost('cell_no'),
                'status' => $this->request->getPost('status'),
            ];

            // Handle file upload
            $file = $this->request->getFile('profile_picture');
            if ($file && $file->isValid()) {
                // Delete old file if exists
                if ($member['profile_picture'] && file_exists(ROOTPATH . 'public/uploads/members/' . $member['profile_picture'])) {
                    unlink(ROOTPATH . 'public/uploads/members/' . $member['profile_picture']);
                }
                
                $newName = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads/members', $newName);
                $data['profile_picture'] = $newName;
            }

            if ($this->memberModel->save($data)) {
                return redirect()->to('members')->with('success', 'Member updated successfully!');
            } else {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->memberModel->errors());
            }
        }

        $data = [
            'title' => 'Edit Staff Member',
            'member' => $member,
        ];

        return view('members/edit', $data);
    }

    public function delete($id = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('login');
        }

        if (!$id) {
            return redirect()->to('members')->with('error', 'Member ID is required');
        }

        $member = $this->memberModel->find($id);
        if (!$member) {
            return redirect()->to('members')->with('error', 'Member not found');
        }

        // Delete profile picture if exists
        if ($member['profile_picture'] && file_exists(ROOTPATH . 'public/uploads/members/' . $member['profile_picture'])) {
            unlink(ROOTPATH . 'public/uploads/members/' . $member['profile_picture']);
        }

        if ($this->memberModel->delete($id)) {
            return redirect()->to('members')->with('success', 'Member deleted successfully!');
        } else {
            return redirect()->to('members')->with('error', 'Failed to delete member');
        }
    }

    public function toggleStatus($id = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('login');
        }

        if (!$id) {
            return redirect()->to('members')->with('error', 'Member ID is required');
        }

        $member = $this->memberModel->find($id);
        if (!$member) {
            return redirect()->to('members')->with('error', 'Member not found');
        }

        $newStatus = $member['status'] === 'active' ? 'inactive' : 'active';
        
        if ($this->memberModel->updateMemberStatus($id, $newStatus)) {
            return redirect()->to('members')->with('success', 'Member status updated successfully!');
        } else {
            return redirect()->to('members')->with('error', 'Failed to update member status');
        }
    }

    public function view($id = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('login');
        }

        if (!$id) {
            return redirect()->to('members')->with('error', 'Member ID is required');
        }

        $member = $this->memberModel->find($id);
        if (!$member) {
            return redirect()->to('members')->with('error', 'Member not found');
        }

        $data = [
            'title' => 'View Staff Member',
            'member' => $member,
        ];

        return view('members/view', $data);
    }
}


