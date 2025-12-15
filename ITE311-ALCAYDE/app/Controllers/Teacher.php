<?php

namespace App\Controllers;

use App\Models\courseModel;

class Teacher extends BaseController
{
    public function myClasses()
    {
        $session = session();
        $teacherId = $session->get('user_id'); // <-- use this from login session

        $courseModel = new courseModel();
        $courses = $courseModel->getCoursesByTeacher($teacherId);

        return view('teacher/my_classes', [
            'courses' => $courses
        ]);
    }
}
