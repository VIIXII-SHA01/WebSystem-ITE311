<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ValidationTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'val_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
           'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'validation_link' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
          $this->forge->addKey('val_id', true);
          $this->forge->createTable('validations');
    }

    public function down()
    {
        $this->forge->dropTable('validations', true);
    }
}
