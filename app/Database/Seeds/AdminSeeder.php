<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name' => 'Admin User',
            'fname' => 'System Administrator',
            'cnic_no' => '9999999999999',
            'cell_no' => '03001234567',
            'date_of_birth' => '1990-01-01',
            'category_id' => null,
            'status' => 'active',
            'email' => 'admin@admin.com',
            'username' => 'superadmin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'showroom_name' => 'System Administration',
            'showroom_address' => 'System Address',
            'is_admin' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('users')->insert($data);
    }
}
