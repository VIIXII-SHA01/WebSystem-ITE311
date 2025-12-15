<?php

namespace App\Controllers;

use App\Models\EnrollmentModel;

class adminenroll extends BaseController
{
    protected $enrollmentModel;

    public function __construct()
    {
        $this->enrollmentModel = new EnrollmentModel();
    }

    // Approve enrollment
    public function approve($id)
    {
        $this->enrollmentModel->update($id, ['enrollment_status' => 'approved']);
        return redirect()->back()->with('success', 'Enrollment approved.');
    }

    // Reject enrollment
    public function reject($id)
    {
        $this->enrollmentModel->update($id, ['enrollment_status' => 'rejected']);
        return redirect()->back()->with('success', 'Enrollment rejected.');
    }

    // Unenroll student
    public function unenroll($id)
    {
        $this->enrollmentModel->delete($id);
        return redirect()->back()->with('success', 'Student unenrolled.');
    }
}
