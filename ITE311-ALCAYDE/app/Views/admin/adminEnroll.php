<?= $this->include('templates/header') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Management - Admin</title>
    <link rel="stylesheet" href="<?= base_url('styles.css') ?>">
    <style>
        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(94, 114, 228, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            top: -250px;
            right: -250px;
            animation: pulse 10s ease-in-out infinite;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -200px;
            left: -200px;
            animation: pulse 8s ease-in-out infinite;
            animation-delay: 2s;
            pointer-events: none;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.15); opacity: 0.3; }
        }

        .container-fluid {
            position: relative;
            z-index: 1;
        }

        h2 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }

        .alert {
            border: none;
            border-radius: 12px;
            backdrop-filter: blur(10px);
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.2);
            color: #ff6b6b;
            border-left: 4px solid #dc3545;
        }

        .alert-success {
            background: rgba(25, 135, 84, 0.2);
            color: #51cf66;
            border-left: 4px solid #198754;
        }

        .nav-tabs {
            border-bottom: 2px solid rgba(102, 126, 234, 0.3);
        }

        .nav-tabs .nav-link {
            color: rgba(255, 255, 255, 0.7);
            border: none;
            padding: 1rem 1.5rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-tabs .nav-link:hover {
            color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .nav-tabs .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .btn-success {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-success::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-success:hover::before {
            left: 100%;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .table-responsive {
            background: rgba(33, 37, 41, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .table-dark {
            background: transparent !important;
        }

        .table-dark thead th {
            background: rgba(102, 126, 234, 0.2);
            color: #667eea;
            font-weight: 600;
            border: none;
            padding: 1rem;
        }

        .table-dark tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .table-dark tbody tr:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: scale(1.01);
        }

        .table-dark td {
            border: none;
            padding: 1rem;
            vertical-align: middle;
        }

        .badge {
            padding: 0.5rem 1rem;
            font-weight: 500;
            border-radius: 0.5rem;
        }

        .badge.bg-warning {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%) !important;
            color: #000;
        }

        .badge.bg-success {
            background: linear-gradient(135deg, #198754 0%, #146c43 100%) !important;
        }

        .btn-sm {
            transition: all 0.3s ease;
        }

        .btn-sm:hover {
            transform: translateY(-2px);
        }

        .btn-outline-success:hover {
            box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3);
        }

        .btn-outline-danger:hover {
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        .btn-outline-primary:hover {
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }

        .modal-content {
            background: rgba(33, 37, 41, 0.95) !important;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.7);
        }

        .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .modal-title {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 600;
        }

        .btn-close {
            filter: invert(1);
        }

        .form-label {
            color: white;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            background: rgba(33, 37, 41, 0.6) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            transition: all 0.3s ease;
            border-radius: 0.5rem;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(33, 37, 41, 0.8) !important;
            border-color: #667eea !important;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
            transform: translateY(-2px);
        }

        .form-select option {
            background: #212529;
        }

        .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
        }

        @media (max-width: 768px) {
            body::before, body::after {
                width: 400px;
                height: 400px;
            }
        }
    </style>
</head>
<body class="bg-dark">

<main class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success">
            <i class="bi bi-clipboard-check"></i> Enrollment Management
        </h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#enrollStudentModal">
            <i class="bi bi-person-plus-fill"></i> Enroll Student
        </button>
    </div>

    <!-- Flash Messages -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mb-4" id="enrollmentTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button">
                <i class="bi bi-hourglass-split"></i> Pending Requests
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved" type="button">
                <i class="bi bi-check-circle"></i> Approved Enrollments
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button">
                <i class="bi bi-list-ul"></i> All Enrollments
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="enrollmentTabContent">
        
        <!-- Pending Requests Tab -->
        <div class="tab-pane fade show active" id="pending" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-dark table-striped align-middle text-center">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Enrolled Date</th>
                            <th>Academic Year</th>
                            <th>Control Number</th>
                            <th>Semester</th>
                            <th>Year Level</th>
                            <th>Term</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample Pending Data -->
                      <tbody>
                        <?php if (!empty($pending)): ?>
                            <?php foreach ($pending as $row): ?>
                                <tr>
                             <td><?= esc($row['name']) ?></td>
                            <td><?= esc($row['email']) ?></td>
                            <td><?= esc($row['enrolled_date']) ?></td>
                            <td><?= esc($row['academic_year']) ?></td>
                            <td><?= esc($row['Control_Number']) ?></td>
                            <td><?= esc($row['Semester']) ?></td>
                            <td><?= esc($row['Year_Level']) ?></td>
                            <td><?= esc($row['term']) ?></td>
                                    <td>
                                        <span class="badge bg-warning">
                                            <i class="bi bi-clock"></i> Pending
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('enrollment/admin/approve/' . $row->id) ?>" 
                                        class="btn btn-sm btn-outline-success"
                                        onclick="return confirm('Approve this enrollment?')">
                                        <i class="bi bi-check-lg"></i> Approve
                                        </a>

                                        <a href="<?= base_url('enrollment/admin/reject/' . $row->id) ?>" 
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Reject this enrollment?')">
                                        <i class="bi bi-x-lg"></i> Reject
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="10" class="text-muted">No pending enrollments.</td></tr>
                        <?php endif; ?>
                    </tbody>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Approved Enrollments Tab -->
        <div class="tab-pane fade" id="approved" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-dark table-striped align-middle text-center">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Enrolled Date</th>
                            <th>Academic Year</th>
                            <th>Control Number</th>
                            <th>Semester</th>
                            <th>Year Level</th>
                            <th>Term</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample Approved Data -->
                      <tbody>
                        <?php if (!empty($approved)): ?>
                            <?php foreach ($approved as $row): ?>
                                <tr>
                                   <td><?= esc($row['name']) ?></td>
                                    <td><?= esc($row['email']) ?></td>
                                    <td><?= esc($row['enrolled_date']) ?></td>
                                    <td><?= esc($row['academic_year']) ?></td>
                                    <td><?= esc($row['Control_Number']) ?></td>
                                    <td><?= esc($row['Semester']) ?></td>
                                    <td><?= esc($row['Year_Level']) ?></td>
                                    <td><?= esc($row['term']) ?></td>
                                    <td>
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle"></i> Approved
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('enrollment/admin/unenroll/' . $row['id']) ?>" 
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Unenroll this student?')">
                                                <i class="bi bi-person-dash"></i> Unenroll
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="10" class="text-muted">No approved enrollments.</td></tr>
                        <?php endif; ?>
                    </tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- All Enrollments Tab -->
        <div class="tab-pane fade" id="all" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-dark table-striped align-middle text-center">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Enrolled Date</th>
                            <th>Academic Year</th>
                            <th>Control Number</th>
                            <th>Semester</th>
                            <th>Year Level</th>
                            <th>Term</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Combined Data -->
                   <tbody>
                    <?php if (!empty($all)): ?>
                        <?php foreach ($all as $row): ?>
                            <tr>
                                <td><?= esc($row['name']) ?></td>
                                <td><?= esc($row['email']) ?></td>
                                <td><?= esc($row['enrolled_date']) ?></td>
                                <td><?= esc($row['academic_year']) ?></td>
                                <td><?= esc($row['Control_Number']) ?></td>
                                <td><?= esc($row['Semester']) ?></td>
                                <td><?= esc($row['Year_Level']) ?></td>
                                <td><?= esc($row['term']) ?></td>
                                <td>
                                    <?php if ($row['enrollment_status'] == 'approved'): ?>
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle"></i> Approved
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning">
                                            <i class="bi bi-clock"></i> Pending
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                  <?php if ($row['enrollment_status'] === 'pending'): ?>
                                    <!-- APPROVE -->
                                    <a href="<?= base_url('enrollment/admin/approve/' . $row['id']) ?>" 
                                    class="btn btn-sm btn-outline-success"
                                    onclick="return confirm('Approve this enrollment?')">
                                        <i class="bi bi-check-lg"></i> Approve
                                    </a>

                                    <!-- REJECT -->
                                    <a href="<?= base_url('enrollment/admin/reject/' . $row['id']) ?>" 
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Reject this enrollment?')">
                                        <i class="bi bi-x-lg"></i> Reject
                                    </a>

                                <?php else: ?>

                                    <!-- UNENROLL -->
                                    <a href="<?= base_url('enrollment/admin/unenroll/' . $row['id']) ?>" 
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Unenroll this student?')">
                                        <i class="bi bi-person-dash"></i> Unenroll
                                    </a>
                                <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="10" class="text-muted">No enrollment records found.</td></tr>
                    <?php endif; ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Enroll Student Modal -->
<div class="modal fade" id="enrollStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-person-plus-fill"></i> Enroll Student in Course
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
               <form method="post" action="<?= base_url('admin/enroll-student') ?>">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label">Select Student</label>
                     <select name="student_id" class="form-select" required>
                        <option value="">Choose a student...</option>
                        <?php foreach ($students as $stu): ?>
                            <option value="<?= $stu['id'] ?>">
                                <?= esc($stu['name']) ?> (<?= esc($stu['email']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Select Course</label>
                      <select name="course_id" class="form-select" required>
                        <option value="">Choose a course...</option>
                        <?php foreach ($courses as $course): ?>
                            <option value="<?= $course['id'] ?>">
                                <?= esc($course['course_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    </div>

                    <div class="mb-3">
                        <label class="form-label">Year Level</label>
                        <select name="year_level" class="form-select" required>
                            <option value="1st Year">First Year</option>
                            <option value="2nd Year">Second Year</option>
                            <option value="3rd Year">Third Year</option>
                            <option value="4th Year">Fourth Year</option>
                        </select>
                    </div>

                      <div class="mb-3">
                        <label class="form-label">Academic Year</label>
                        <select name="academic_year" class="form-select" required>
                            <option value="2024-2025">2024-2025</option>
                            <option value="2025-2026">2025-2026</option>
                            <option value="2027-2028">2027-2028</option>
                            <option value="2028-2029">2028-2029</option>
                        </select>
                    </div>

                    
                    <div class="mb-3">
                        <label class="form-label">Control Number</label>
                       <input type="number" class="form-control" name="control_number" placeholder="Enter Control Number" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Term</label>
                        <select name="term" class="form-select" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="approved">Approve Immediately</option>
                            <option value="pending">Mark As Pending</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Enroll Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>