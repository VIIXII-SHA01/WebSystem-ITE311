<?php
// This is the opening PHP tag, indicating the start of PHP code execution.

namespace App\Models;
// This declares the namespace for the model class, organizing it under App\Models for better code structure and autoloading.

use CodeIgniter\Model;
// This imports the base Model class from CodeIgniter, which this class extends to inherit model functionality for database interactions.

class EnrollmentModel extends Model
// This defines the EnrollmentModel class, which extends the base Model class, making it a model for handling enrollment-related database operations.

{
// This is the opening brace for the class definition.

    protected $table      = 'enrollments';
// This sets the database table name that this model will interact with to 'enrollments'.

    protected $primaryKey = 'id';
// This specifies the primary key column for the table as 'id'.

    protected $allowedFields = ['user_id', 'course_id', 'enrolled_date', 'academic_year', 
                                'Control_Number', 'Semester', 'term', 'Year_Level', 'enrollment_status'];
// This defines the fields that are allowed to be inserted or updated in the table, for security purposes.

    protected $useTimestamps = false; // We are handling enrolled_date manually
// This disables automatic timestamp handling by CodeIgniter, as the model manually manages the 'enrolled_date' field.

    /**
     * Enroll a user in a course
     *
     * @param array $data ['user_id' => ..., 'course_id' => ..., 'enrolled_date' => ...]
     * @return bool|int Insert ID on success, false on failure
     */
// This is a PHPDoc comment describing the enrollUser method: its purpose, parameters, and return type.

    public function enrollUser(array $data)
// This defines the enrollUser method, which takes an array of data to enroll a user in a course.

    {
// This is the opening brace for the enrollUser method.

        // Optional: prevent duplicate enrollment before inserting
// This is a comment explaining the optional check to prevent duplicate enrollments.

        if ($this->isAlreadyEnrolled($data['user_id'], $data['course_id'])) {
// This checks if the user is already enrolled in the course using the isAlreadyEnrolled method.

            return false;
// This returns false if already enrolled, preventing duplicate insertion.

        }
// This is the closing brace for the if statement.

        // If 'enrolled_date' is not set, use current timestamp
// This is a comment explaining the setting of the enrolled_date if not provided.

        if (!isset($data['enrolled_date'])) {
// This checks if 'enrolled_date' is not set in the data array.

            $data['enrolled_date'] = date('Y-m-d H:i:s');
// This sets the 'enrolled_date' to the current date and time if not provided.

        }
// This is the closing brace for the if statement.

        return $this->insert($data);
// This inserts the data into the database using the model's insert method and returns the insert ID or false on failure.

    }
// This is the closing brace for the enrollUser method.

    /**
     * Get all courses a user is enrolled in
     *
     * @param int $user_id
     * @return array
     */
// This is a PHPDoc comment describing the getUserEnrollments method: its purpose, parameter, and return type.

    public function getUserEnrollments(int $user_id)
// This defines the getUserEnrollments method, which takes a user ID and returns the user's enrollments.

    {
// This is the opening brace for the getUserEnrollments method.

        return $this->select('courses.id, courses.course_name,
                                courses.course_instructor')
// This starts a query to select specific fields from the courses table (id, course_name, course_instructor).

                ->join('courses', 'courses.id = enrollments.course_id')
// This joins the enrollments table with the courses table on the course_id.

                ->where('enrollments.user_id', $user_id)
// This filters the results to only include enrollments for the specified user_id.

                ->findAll();
// This executes the query and returns all matching records as an array.

    }
// This is the closing brace for the getUserEnrollments method.

    /**
     * Check if a user is already enrolled in a specific course
     *
     * @param int $user_id
     * @param int $course_id
     * @return bool
     */
// This is a PHPDoc comment describing the isAlreadyEnrolled method: its purpose, parameters, and return type.

    public function isAlreadyEnrolled(int $user_id, int $course_id)
// This defines the isAlreadyEnrolled method, which checks if a user is enrolled in a course.

    {
// This is the opening brace for the isAlreadyEnrolled method.

        $enrollment = $this->where([
// This starts a query to find an enrollment record matching the user_id and course_id.

            'user_id'   => $user_id,
// This specifies the user_id condition.

            'course_id' => $course_id,
// This specifies the course_id condition.

        ])->first();
// This executes the query and retrieves the first matching record, or null if none found.

        return $enrollment !== null;
// This returns true if an enrollment record exists (not null), otherwise false.

    }
// This is the closing brace for the isAlreadyEnrolled method.

}
// This is the closing brace for the EnrollmentModel class.
