<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateShowroomsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'fname' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'showroom_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'showroom_address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'qr_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'showroom_registration_number' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'cnic_no' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null'       => false,
            ],
            'cell_no' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null'       => false,
            ],
            'date_of_birth' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'category' => [
                'type'       => 'ENUM',
                'constraint' => ['golden', 'platinum', 'silver'],
                'default'    => 'golden',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive', 'pending'],
                'default'    => 'pending',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'is_admin' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'null'       => false,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('showrooms');
        
        // Add unique constraints separately
        $this->db->query('ALTER TABLE showrooms ADD UNIQUE KEY showroom_cnic_no (cnic_no)');
        $this->db->query('ALTER TABLE showrooms ADD UNIQUE KEY showroom_email (email)');
    }

    public function down()
    {
        $this->forge->dropTable('showrooms');
    }
}
