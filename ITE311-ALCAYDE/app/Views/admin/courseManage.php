<?= $this->include('templates/header') ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Course Management - LMS Admin</title>
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
    z-index: 0;
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
    z-index: 0;
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
    position: relative;
    z-index: 1071;
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

  .modal-backdrop {
    z-index: 9998 !important;
  }

  .modal-dialog {
    z-index: 10000 !important;
    position: relative;
  }

  .modal-content {
    background: rgba(33, 37, 41, 0.98) !important;
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 1rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.7);
    position: relative;
    z-index: 10001 !important;
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

  /* Student enrollment styles */
  .student-search-box {
    position: relative;
    margin-bottom: 1rem;
  }

  .student-search-box input {
    padding-right: 3rem;
  }

  .student-search-box i {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(255, 255, 255, 0.4);
    pointer-events: none;
  }

  .students-list {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0.75rem;
    padding: 1rem;
    max-height: 400px;
    overflow-y: auto;
  }

  .students-list::-webkit-scrollbar {
    width: 8px;
  }

  .students-list::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 4px;
  }

  .students-list::-webkit-scrollbar-thumb {
    background: rgba(102, 126, 234, 0.5);
    border-radius: 4px;
  }

  .student-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.75rem;
    margin-bottom: 0.5rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0.5rem;
    transition: all 0.3s ease;
  }

  .student-item:hover {
    background: rgba(102, 126, 234, 0.1);
    border-color: rgba(102, 126, 234, 0.3);
  }

  .student-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .student-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 1rem;
  }

  .student-details h6 {
    color: white;
    margin: 0;
    font-weight: 600;
    font-size: 0.95rem;
  }

  .student-details p {
    color: rgba(255, 255, 255, 0.6);
    margin: 0;
    font-size: 0.85rem;
  }

  .student-checkbox {
    width: 20px;
    height: 20px;
    cursor: pointer;
    accent-color: #667eea;
  }

  .enrolled-count {
    display: inline-block;
    background: rgba(102, 126, 234, 0.2);
    color: #667eea;
    padding: 0.35rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.9rem;
    font-weight: 600;
    margin-left: 0.5rem;
  }

  .select-all-section {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem;
    background: rgba(102, 126, 234, 0.1);
    border-radius: 0.5rem;
    margin-bottom: 1rem;
  }

  .select-all-section label {
    color: white;
    margin: 0;
    cursor: pointer;
    font-weight: 500;
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
            z-index: 1070; 
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
                <th>Course Description</th>
                <th>Credits</th>
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
                <td><?= esc($course['course_description']) ?></td>
                <td><?= esc($course['credits']) ?></td>
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
                  
                </td>
            </tr>

            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6" class="text-muted">No courses found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</main>

     <?php if (!empty($courses)): ?>
        <?php foreach ($courses as $course): ?>
  <!-- ENROLL STUDENTS MODAL FOR EACH COURSE -->
  <div class="modal fade" id="assignInstructorModal<?= $course['id'] ?>" tabindex="-1" style="z-index: 9999;">
      <div class="modal-dialog modal-dialog-centered modal-lg" style="z-index: 10000;">
          <div class="modal-content">
              <div class="modal-header border-0">
                  <h5 class="modal-title text-success">
                      Enroll Students - <?= esc($course['course_name']) ?>
                      <span class="enrolled-count" id="enrolledCount<?= $course['id'] ?>">0 selected</span>
                  </h5>
                  <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                  <form class="enrollStudentsForm" data-course-id="<?= $course['id'] ?>">
                      <?= csrf_field() ?>

                      <!-- Student Search -->
                      <div class="student-search-box">
                          <input type="text" 
                                class="form-control studentSearch" 
                                placeholder="Search students by name or ID..."
                                data-course-id="<?= $course['id'] ?>">
                          <i class="bi bi-search"></i>
                      </div>

                      <!-- Select All Option -->
                      <div class="select-all-section">
                          <input type="checkbox" 
                                class="student-checkbox selectAll" 
                                id="selectAll<?= $course['id'] ?>" 
                                data-course-id="<?= $course['id'] ?>">
                          <label for="selectAll<?= $course['id'] ?>">Select All Students</label>
                      </div>

                      <!-- Students List -->
                      <div class="students-list" id="studentsList<?= $course['id'] ?>">
                          <?php foreach($students as $student): ?>
                              <?php 
                                  // Check if student is already enrolled in this course
                                  $isEnrolled = false;
                                  foreach ($enrollments as $enroll) {
                                      if ($enroll['user_id'] == $student['id'] && $enroll['course_id'] == $course['id']) {
                                          $isEnrolled = true;
                                          break;
                                      }
                                  }
                              ?>
                              <div class="student-item" 
                                  data-student-name="<?= strtolower($student['name']) ?>" 
                                  data-student-id="<?= $student['id'] ?>">
                                  <div class="student-info">
                                      <div class="student-avatar">
                                          <?= strtoupper(substr($student['name'],0,1)) 
                                            . (strpos($student['name'], ' ') !== false ? strtoupper(substr(strstr($student['name'], ' '),1,1)) : '') ?>
                                      </div>
                                      <div class="student-details">
                                          <h6><?= esc($student['name']) ?></h6>
                                          <p>ID: <?= esc($student['id']) ?></p>
                                      </div>
                                  </div>
                                  <input type="checkbox" 
                                        class="student-checkbox student-select" 
                                        name="students[]" 
                                        value="<?= $student['id'] ?>" 
                                        data-course-id="<?= $course['id'] ?>"
                                        <?= $isEnrolled ? 'checked' : '' ?>>
                              </div>
                          <?php endforeach; ?>
                      </div>

                      <button type="submit" class="btn btn-success w-100 mt-3">Enroll Selected Students</button>
                  </form>
              </div>
          </div>
      </div>
  </div>

 <!-- EDIT COURSE MODAL FOR EACH COURSE -->
            <div class="modal fade" id="editCourseModal<?= $course['id'] ?>" tabindex="-1" style="z-index: 9999;">
              <div class="modal-dialog modal-dialog-centered" style="z-index: 10000;">
                <div class="modal-content">
                  <div class="modal-header border-0">
                    <h5 class="modal-title text-success">Edit Course</h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <form class="editCourseForm" data-course-id="<?= $course['id'] ?>">
                      <?= csrf_field() ?>
                      
                      <div class="mb-3">
                        <label class="form-label">Course Name</label>
                        <input type="text" name="course_name" class="form-control bg-dark text-white" 
                               value="<?= esc($course['course_name']) ?>" required>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Course Code</label>
                        <input type="text" name="course_code" class="form-control bg-dark text-white"
                               value="<?= esc($course['course_code']) ?>">
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Course Instructor</label>
                        <select name="course_instructor" class="form-select bg-dark text-white" required>
                          <option value="">None</option>
                          <?php foreach ($teachers as $t): ?>
                            <option value="<?= $t['name'] ?>" 
                                    <?= ($course['course_instructor'] == $t['name']) ? 'selected' : '' ?>>
                              <?= esc($t['name']) ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Course Description</label>
                        <input type="text" name="course_description" class="form-control bg-dark text-white" 
                               value="<?= esc($course['course_description']) ?>" required>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Credits</label>
                        <input type="text" name="credits" class="form-control bg-dark text-white" 
                               value="<?= esc($course['credits']) ?>" pattern="[A-Za-z0-9 ]+" required>
                      </div>

                      <button type="submit" class="btn btn-success w-100">Update Course</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>



<!-- ADD COURSE MODAL -->
<div class="modal fade" id="addCourseModal" tabindex="-1" style="z-index: 9999;">
  <div class="modal-dialog modal-dialog-centered" style="z-index: 10000;">
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
                <label class="form-label">Course Instructor</label>
                <select name="course_instructor" class="form-select bg-dark text-white" required>
                    <option value="">None</option>
                    <?php foreach ($teachers as $t): ?>
                        <option value="<?= $t['name'] ?>"><?= esc($t['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

             <div class="mb-3">
                <label class="form-label">Course Description</label>
                <input type="text" name="course_description" class="form-control bg-dark text-white" required>
            </div>

             <div class="mb-3">
                <label class="form-label">Credits</label>
                <input type="text" name="credits" class="form-control bg-dark text-white" 
                pattern="[A-Za-z0-9 ]+" required>

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

    // Fix Bootstrap modal z-index issue
    $(document).on('show.bs.modal', '.modal', function () {
        const zIndex = 9999 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });

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

    // PREVENT PAGE RELOAD — AJAX SUBMISSION FOR ADD COURSE
    $("#addCourseForm").on("submit", function(e) {
        e.preventDefault();

        $.ajax({
            url: "<?= base_url('course/add') ?>",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                showFloating("success", "Course added successfully!");
                $("#addCourseModal").modal("hide");
                $("#addCourseForm")[0].reset();
                location.reload();
            },
            error: function() {
                showFloating("danger", "Error adding course.");
            }
        });
    });

    // EDIT COURSE FORM SUBMISSION
    document.querySelectorAll('.editCourseForm').forEach(form => {
      form.addEventListener('submit', function(e) {
          e.preventDefault();

          let courseId = this.getAttribute('data-course-id');
          let formData = new FormData(this);

          fetch("<?= base_url('courses/update/') ?>" + courseId, {
              method: 'POST',
              body: formData
          })
          .then(res => res.json())
          .then(data => {

              if (data.status === 'success') {
                  alert(data.message);
                  location.reload();
              } else {
                  alert("Error: " + JSON.stringify(data.errors));
              }

          })
          .catch(err => console.error(err));
      });
  });

    // ENROLL STUDENTS FORM SUBMISSION
 $(".enrollStudentsForm").on("submit", function(e) {
      e.preventDefault();
      let courseId = $(this).data('course-id');
      let formData = $(this).serialize(); // includes csrf token if present

      $.ajax({
          url: "<?= base_url('course/enroll/') ?>" + courseId,
          method: "POST",
          data: formData,
          success: function(response) {
              showFloating("success", "Students enrolled successfully!");
              $("#assignInstructorModal" + courseId).modal("hide");
              $("#studentsList" + courseId + " .student-select").prop('checked', false);
              $("#selectAll" + courseId).prop('checked', false);
              updateEnrolledCount(courseId);
          },
          error: function(xhr) {
              console.log(xhr.responseText); // debug
              showFloating("danger", "Error enrolling students.");
          }
      });
  });


    // STUDENT SEARCH FUNCTIONALITY
    $(".studentSearch").on("input", function() {
        let searchTerm = $(this).val().toLowerCase();
        let courseId = $(this).data('course-id');
        
        $("#studentsList" + courseId + " .student-item").each(function() {
            let name = $(this).data('student-name');
            let id = $(this).data('student-id').toString();
            
            if (name.includes(searchTerm) || id.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // SELECT ALL FUNCTIONALITY
    $(".selectAll").on("change", function() {
        let courseId = $(this).data('course-id');
        let isChecked = $(this).prop('checked');
        
        $("#studentsList" + courseId + " .student-item:visible .student-select").prop('checked', isChecked);
        updateEnrolledCount(courseId);
    });

    // UPDATE ENROLLED COUNT
  function updateEnrolledCount(courseId) {
        let count = $("#studentsList" + courseId + " .student-select:checked").length;
        $("#enrolledCount" + courseId).text(count + " selected");
    }
                          
    // Initialize count for all courses
    $(".enrollStudentsForm").each(function() {
        let courseId = $(this).data('course-id');
        updateEnrolledCount(courseId);
    });

    // Initialize counts for all courses
    $(".enrollStudentsForm").each(function() {
        let courseId = $(this).data('course-id');
        updateEnrolledCount(courseId);
    });

});
</script>