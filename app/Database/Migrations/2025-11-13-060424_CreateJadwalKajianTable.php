<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJadwalKajianTable extends Migration
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
            'pengurus_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tema' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'penceramah' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'lokasi' => [ // Sesuai Class Diagram
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tanggal_waktu' => [
                'type' => 'DATETIME',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Akan Datang', 'Selesai', 'Dibatalkan'],
                'default'    => 'Akan Datang',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('pengurus_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('jadwal_kajian');
    }

    public function down()
    {
        $this->forge->dropTable('jadwal_kajian');
    }
}