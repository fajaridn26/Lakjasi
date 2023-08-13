<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusPelaporan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 255,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_pelaporan' => [
                'type'       => 'INT',
                'constraint' => 255,
                'unsigned'   => true,
            ],
            'status_pelaporan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'auto_increment' => true,
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null'             => TRUE
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null'             => TRUE
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_pelaporan','pelaporan','id_laporan','CASCADE', 'CASCADE');
        $this->forge->createTable('status_pelaporan');
    }
    
    public function down()
    {
        $this->forge->dropTable('status_pelaporan');
    }
}
