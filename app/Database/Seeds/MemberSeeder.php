<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'member_name' => 'Ahmed Khan',
                'father_name' => 'Muhammad Khan',
                'cnic_no' => '1234567890123',
                'cell_no' => '03001234567',
                'profile_picture' => null,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'member_name' => 'Fatima Ali',
                'father_name' => 'Hassan Ali',
                'cnic_no' => '2345678901234',
                'cell_no' => '03012345678',
                'profile_picture' => null,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'member_name' => 'Usman Ahmed',
                'father_name' => 'Ahmed Raza',
                'cnic_no' => '3456789012345',
                'cell_no' => '03023456789',
                'profile_picture' => null,
                'status' => 'inactive',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'member_name' => 'Ayesha Khan',
                'father_name' => 'Khalid Khan',
                'cnic_no' => '4567890123456',
                'cell_no' => '03034567890',
                'profile_picture' => null,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'member_name' => 'Muhammad Hassan',
                'father_name' => 'Abdul Hassan',
                'cnic_no' => '5678901234567',
                'cell_no' => '03045678901',
                'profile_picture' => null,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('members')->insertBatch($data);
    }
}


