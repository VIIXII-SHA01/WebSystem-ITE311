<?php
// This is the opening PHP tag, indicating the start of PHP code execution.

namespace App\Controllers;
// This declares the namespace for the controller class, organizing it under App\Controllers for better code structure and autoloading.

use App\Models\EnrollmentModel;
// This imports the EnrollmentModel class from the App\Models namespace, allowing the controller to interact with enrollment data.

use App\Models\courseModel;
// This imports the courseModel class from the App\Models namespace, allowing the controller to interact with course data.

use CodeIgniter\Controller;
// This imports the base Controller class from CodeIgniter, which this class extends to inherit controller functionality.

class Course extends Controller
// This defines the Course class, which extends the base Controller class, making it a controller for handling course-related actions like enrollment.

{
// This is the opening brace for the class definition.

    /**
     * Handle AJAX enrollment request
     */
// This is a PHPDoc comment describing the purpose of the enroll method: to handle AJAX requests for course enrollment.

    public function enroll() {
// This defines the enroll method for processing course enrollment via AJAX.

        $session = session();
// This retrieves the current session instance.

        if (! $session->get('LoggedIn')) {
// This checks if the user is not logged in by verifying the 'LoggedIn' session variable.

            $session->setFlashdata('error', 'Please log in first!');
// This sets an error flash message in the session.

            return redirect()->to(base_url('login'));
// This redirects the user to the login page if not logged in.

        }
// This is the closing brace for the login check if statement.

        // ✅ Check if user_id exists
// This is a comment indicating the following check: to ensure the user_id is present in the session.

        if (!$session->has('user_id')) {
// This checks if the 'user_id' key exists in the session.

            return $this->response->setJSON([
// This returns a JSON response with an error status if user_id is missing.

                'status'  => 'error',
// This sets the status to 'error'.

                'message' => 'You must be logged in to enroll in a course.',
// This provides an error message.

                'csrfHash' => csrf_hash() // always return updated CSRF token
// This includes an updated CSRF token for security in AJAX requests.

            ]);
// This closes the JSON response array.

        }
// This is the closing brace for the user_id check if statement.

        // ✅ Get user_id and course_id
// This is a comment explaining the retrieval of user_id and course_id.

        $user_id   = $session->get('user_id');
// This retrieves the user_id from the session.

        $course_id = $this->request->getPost('course_id');
// This retrieves the course_id from the POST data in the request.

        if (!$course_id) {
// This checks if course_id is not provided or invalid.

            return $this->response->setJSON([
// This returns a JSON response with an error if course_id is missing.

                'status'  => 'error',
// Sets status to 'error'.

                'message' => 'Invalid course ID.',
// Provides an error message.

                'csrfHash' => csrf_hash()
// Includes updated CSRF token.

            ]);
// Closes the JSON response array.

        }
// Closes the course_id check if statement.

        // ✅ Load Enrollment Model
// This is a comment indicating the loading of the EnrollmentModel.

        $enrollmentModel = new \App\Models\EnrollmentModel();
// This instantiates a new EnrollmentModel object for database interactions related to enrollments.

        // ✅ Check if user already enrolled
// This is a comment explaining the check for existing enrollment.

        if ($enrollmentModel->isAlreadyEnrolled($user_id, $course_id)) {
// This calls the isAlreadyEnrolled method on the model to check if the user is already enrolled in the course.

            return $this->response->setJSON([
// This returns a JSON response with a warning if already enrolled.

                'status'  => 'warning',
// Sets status to 'warning'.

                'message' => 'You are already enrolled in this course.',
// Provides a warning message.

                'csrfHash' => csrf_hash()
// Includes updated CSRF token.

            ]);
// Closes the JSON response array.

        }
// Closes the already enrolled check if statement.

        // ✅ Insert new enrollment record
// This is a comment indicating the insertion of a new enrollment record.

        $data = [
// This starts the array for enrollment data to be inserted.

            'user_id'         => $user_id,
// Sets the user_id in the data array.

            'course_id'       => $course_id,
// Sets the course_id in the data array.

            'enrollment_date' => date('Y-m-d H:i:s'),
// Sets the enrollment date to the current timestamp.

        ];
// Closes the $data array.

        $inserted = $enrollmentModel->enrollUser($data);
// This calls the enrollUser method on the model to insert the enrollment data and stores the result (true/false) in $inserted.

        if ($inserted) {
// This checks if the insertion was successful.

            return $this->response->setJSON([
// This returns a JSON response with success status.

                'status'  => 'success',
// Sets status to 'success'.

                'message' => 'Enrolled successfully!',
// Provides a success message.

                'csrfHash' => csrf_hash() // updated token for next request
// Includes updated CSRF token.

            ]);
// Closes the JSON response array.

        }
// Closes the successful insertion if statement.

        // ✅ Handle insert failure
// This is a comment indicating handling of insertion failure.

        return $this->response->setJSON([
// This returns a JSON response with error status for failed insertion.

            'status'  => 'error',
// Sets status to 'error'.

            'message' => 'Enrollment failed. Please try again.',
// Provides an error message.

            'csrfHash' => csrf_hash()
// Includes updated CSRF token.

        ]);
// Closes the JSON response array.

    }
// This is the closing brace for the enroll method.

    public function studentCourses() {
// This defines the studentCourses method for displaying a student's enrolled and available courses.

       $session = session();
// This retrieves the current session instance.

        // ✅ 1. Check if user is logged in
// This is a comment indicating the first step: checking login status.

        if (!$session->has('user_id')) {
// This checks if 'user_id' exists in the session.

            return redirect()->to('/login')->with('error', 'Please log in first.');
// This redirects to the login page with an error message if not logged in.

        }
// Closes the login check if statement.

        $user_id = $session->get('user_id');
// This retrieves the user_id from the session.

        // ✅ 2. Load models
// This is a comment indicating the loading of models.

        $enrollmentModel = new EnrollmentModel();
// This instantiates a new EnrollmentModel.

        $courseModel     = new courseModel();
// This instantiates a new courseModel.

        // ✅ 3. Get enrolled courses (joined with course names)
// This is a comment explaining the retrieval of enrolled courses.

        $enrollments = $enrollmentModel->getUserEnrollments($user_id);
// This calls getUserEnrollments on the model to fetch the user's enrollments, presumably including course details.

        // ✅ 4. Get all available courses
// This is a comment indicating the retrieval of all courses.

        $allCourses = $courseModel->findAll();
// This retrieves all courses from the courseModel.

        // ✅ 5. Filter out already-enrolled courses
// This is a comment explaining the filtering of available courses.

        $enrolledIds = array_column($enrollments, 'course_id');
// This extracts the course_ids from the enrollments array.

        $availableCourses = array_filter($allCourses, function ($course) use ($enrolledIds) {
// This filters the allCourses array to exclude courses where the id is in enrolledIds.

            return !in_array($course['id'], $enrolledIds);
// This returns true if the course id is not in the enrolled ids, keeping it in availableCourses.

        });
// Closes the array_filter function.

        // ✅ 6. Load the view
// This is a comment indicating the loading of the view.

        return view('students/myCourses', [
// This loads the 'students/myCourses' view and passes data to it.

            'enrollments'      => $enrollments,
// Passes the enrollments array to the view.

            'availableCourses' => $availableCourses
// Passes the availableCourses array to the view.

        ]);
// Closes the view call.

    }

    public function update($id) {
        $response = [];

        $courseModel = new courseModel();
        
           

        // Validate input (basic server-side validation)
        $validation = \Config\Services::validation();
        $validation->setRules([
            'course_name'        => 'required|min_length[3]',
            'course_code'        => 'permit_empty',
            'course_instructor'  => 'required',
            'course_description' => 'required',
            'credits'            => 'required|alpha_numeric_space'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors()
            ]);
        }

        // Sanitize data coming from modal
        $data = [
            'course_name'        => $this->request->getPost('course_name'),
            'course_code'        => $this->request->getPost('course_code'),
            'course_instructor'  => $this->request->getPost('course_instructor'),
            'course_description' => $this->request->getPost('course_description'),
            'credits'            => $this->request->getPost('credits'),
        ];

        // Update course
        $courseModel->update($id, $data);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Course updated successfully.'
        ]);
        


    }

// This is the closing brace for the studentCourses method.

}
// This is the closing brace for the Course class.
