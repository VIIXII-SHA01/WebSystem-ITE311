<?php
// This is the opening PHP tag, indicating the start of PHP code execution.

namespace App\Models;
// This declares the namespace for the model class, organizing it under App\Models for better code structure and autoloading.

use CodeIgniter\Model;
// This imports the base Model class from CodeIgniter, which this class extends to inherit model functionality for database interactions.

class courseModel extends Model
// This defines the courseModel class, which extends the base Model class, making it a model for handling course-related database operations.

{
// This is the opening brace for the class definition.

    protected $table = 'courses';
// This sets the database table name that this model will interact with to 'courses'.

    protected $primaryKey = 'id';
// This specifies the primary key column for the table as 'id'.

    protected $allowedFields = ['course_name', 'course_instructor', 'course_code', 'course_description',
        'credits'];
// This defines the fields that are allowed to be inserted or updated in the table, for security purposes.

    /**
     * Get all courses
     */
// This is a PHPDoc comment describing the purpose of the getAllCourses method.

    public function getAllCourses()
// This defines the getAllCourses method, which retrieves all courses from the database.

    {
// This is the opening brace for the getAllCourses method.

        return $this->findAll();
// This calls the findAll method from the base Model class to retrieve all records from the 'courses' table and returns them as an array.

    }

public function getCoursesByTeacher($teacherId)
{
    return $this->where('course_instructor', $teacherId)
                ->orderBy('course_name', 'ASC')
                ->findAll();
}


// This is the closing brace for the getAllCourses method.

}
// This is the closing brace for the courseModel class.
