<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name', 'email', 'role', 'status'];

    /**
     * Get all users where role = 'teacher' AND status = 'granted'
     */
    public function getAllTeachers()
    {
        return $this->where('role', 'teacher')
                    ->where('status', 'granted')
                    ->findAll();
    }
}
