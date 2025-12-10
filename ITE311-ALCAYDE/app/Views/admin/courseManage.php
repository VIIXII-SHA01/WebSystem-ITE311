<?= $this->include('templates/header') ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Course Management - LMS Admin</title>
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

  #liveNotify .alert {
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    animation: slideInRight 0.5s ease;
  }

  @keyframes slideInRight {
    from {
      opacity: 0;
      transform: translateX(100px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  .alert-success {
    background: rgba(25, 135, 84, 0.3) !important;
    color: #51cf66 !important;
    border-left: 4px solid #198754 !important;
  }

  .alert-danger {
    background: rgba(220, 53, 69, 0.3) !important;
    color: #ff6b6b !important;
    border-left: 4px solid #dc3545 !important;
  }

  .btn-success {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    padding: 12px 24px;
    font-weight: 600;
    letter-spacing: 0.3px;
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

  .btn-outline-light,
  .btn-outline-danger,
  .btn-outline-warning {
    transition: all 0.3s ease;
  }

  .btn-outline-light:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2);
  }

  .btn-outline-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
  }

  .btn-outline-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
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

  .form-control,
  .form-select {
    background: rgba(33, 37, 41, 0.6) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    color: white !important;
    transition: all 0.3s ease;
    border-radius: 0.5rem;
  }

  .form-control:focus,
  .form-select:focus {
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
    
    .table-responsive {
      padding: 1rem;
    }

    #liveNotify {
      width: 90% !important;
      right: 5% !important;
    }
  }
</style>
</head>

<!-- FLOATING LIVE NOTIFICATIONS -->
<div id="liveNotify" 
     style="position: fixed; 
            top: 20px; 
            right: 20px; 
            z-index: 9999; 
            width: 300px;">
</div>

<body class="bg-dark">

<!-- Flash Messages -->


<!-- MAIN PAGE -->
<main class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success">Course Management</h2>

        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCourseModal">
            <i class="bi bi-bookmark-plus"></i> Add New Course
        </button>
    </div>


    <!-- COURSES TABLE -->
  <div class="table-responsive">
    <table class="table table-dark table-striped align-middle text-center">
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Instructor</th>
                <th>Course Code</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php if (!empty($courses)): ?>
            <?php foreach ($courses as $course): ?>
            <tr>
                <td><?= esc($course['course_name']) ?></td>
                <td><?= esc($course['course_instructor'] ?? 'No Instructor') ?></td>
                <td><?= esc($course['course_code']) ?></td>
                <td>
                    <!-- Edit -->
                    <button class="btn btn-sm btn-outline-light"
                            data-bs-toggle="modal"
                            data-bs-target="#editCourseModal<?= $course['id'] ?>">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <!-- Delete -->
                    <a href="<?= base_url('courses/delete/' . $course['id']) ?>"
                       class="btn btn-sm btn-outline-danger"
                       onclick="return confirm('Are you sure you want to delete this course?')">
                        <i class="bi bi-trash"></i>
                    </a>

                    <!-- Assign/Remove Instructor -->
                    <button class="btn btn-sm btn-outline-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#assignInstructorModal<?= $course['id'] ?>">
                        <i class="bi bi-people"></i>
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4" class="text-muted">No courses found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</main>



<!-- ADD COURSE MODAL -->
<div class="modal fade" id="addCourseModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header border-0">
        <h5 class="modal-title text-success">Add New Course</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <form id="addCourseForm">

            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Course Name</label>
                <input type="text" name="course_name" class="form-control bg-dark text-white" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Course Code</label>
                <input type="text" name="course_code" class="form-control bg-dark text-white">
            </div>

            <div class="mb-3">
                <label class="form-label">Course Instructor (Optional)</label>
                <select name="course_instructor" class="form-select bg-dark text-white">
                    <option value="">None</option>
                    <?php foreach ($teachers as $t): ?>
                        <option value="<?= $t['name'] ?>"><?= esc($t['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success w-100">Save</button>
        </form>

      </div>

    </div>
  </div>
</div>

</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    function showFloating(type, message) {
        let alert = $(`
            <div class="alert alert-${type} shadow-lg" style="display:none; border-radius: 8px;">
                ${message}
            </div>
        `);

        $("#liveNotify").append(alert);
        alert.fadeIn(400);

        setTimeout(() => {
            alert.fadeOut(400, function () {
                $(this).remove();
            });
        }, 3000);
    }

    // PREVENT PAGE RELOAD — AJAX SUBMISSION
    $("#addCourseForm").on("submit", function(e) {
        e.preventDefault(); // stop page reload

        $.ajax({
            url: "<?= base_url('course/add') ?>",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                showFloating("success", "Course added successfully!");
                $("#addCourseModal").modal("hide");
                $("#addCourseForm")[0].reset();
                // OPTIONAL: reload the table without full page reload
                location.reload(); // remove this if you're using AJAX to refresh the table
            },
            error: function() {
                showFloating("danger", "Error adding course.");
            }
        });
    });

});
</script>