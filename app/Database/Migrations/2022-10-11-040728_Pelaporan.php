<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelaporan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_laporan' => [
                'type'           => 'INT',
                'constraint'     => 255,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_akun' => [
                'type'       => 'INT',
                'constraint' => 255,
                'unsigned'   => true,
            ],
            'lat' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'long' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tanggal_pelaporan' => [
                'type' => 'DATE',
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'status_pelaporan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'auto_increment' => true,
            ]
        ]);
        $this->forge->addKey('id_laporan', true);
        $this->forge->addForeignKey('id_akun','akun','id','CASCADE', 'CASCADE');
        $this->forge->createTable('pelaporan');
    }

    public function down()
    {
        $this->forge->dropTable('Pelaporan');
    }
}
