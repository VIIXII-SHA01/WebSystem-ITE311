<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Example seed data
        $data = [
            [
                'name'       => 'Admin User',
                'email'      => 'admin@example.com',
                'password'   => password_hash('admin123', PASSWORD_DEFAULT),
                'role'       => 'admin',
                'status'     => 'granted',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Teacher User',
                'email'      => 'teacher@example.com',
                'password'   => password_hash('teacher123', PASSWORD_DEFAULT),
                'role'       => 'teacher',
                'status'     => 'granted',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Student User',
                'email'      => 'student@example.com',
                'password'   => password_hash('student123', PASSWORD_DEFAULT),
                'role'       => 'student',
                'status'     => 'granted',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
              [
                'name'       => 'Kim Fernando',
                'email'      => 'keithyvheaiv@gmail.com',
                'password'   => password_hash('vea123', PASSWORD_DEFAULT),
                'role'       => 'admin',
                'status'     => 'granted',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data into the 'users' table
        $this->db->table('users')->insertBatch($data);
    }
}
