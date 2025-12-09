<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVerificationTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ver_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
           'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'verification_code' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['used', 'unused'],
                'default' => 'unused',
            ],
        ]);
          $this->forge->addKey('ver_id', true);
          $this->forge->createTable('verifications');
    }

    public function down()
    {
        $this->forge->dropTable('quizzes', true);
    }
}
