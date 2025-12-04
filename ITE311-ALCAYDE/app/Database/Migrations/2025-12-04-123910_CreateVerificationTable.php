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
           'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'verification_code' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false
            ],
        ]);
          $this->forge->addKey('ver_id', true);
          $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE'); 
          $this->forge->createTable('verifications');
    }

    public function down()
    {
        $this->forge->dropTable('quizzes', true);
    }
}
