<?php

namespace App\Models;

use CodeIgniter\Model;

class courseModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['course_name', 'course_instructor'];

    /**
     * Get all courses
     */
    public function getAllCourses()
    {
        return $this->findAll();
    }
}
