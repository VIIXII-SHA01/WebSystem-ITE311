<?= $this->include('templates/header') ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Course | Teacher Dashboard</title>
  <link rel="stylesheet" href="styles.css">
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

    .content {
      position: relative;
      z-index: 1;
      padding: 2rem;
    }

    .page-header {
      background: rgba(33, 37, 41, 0.8);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 1rem;
      padding: 2rem;
      margin-bottom: 2rem;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .page-header h1 {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .page-header p {
      color: rgba(255, 255, 255, 0.7);
      margin: 0;
    }

    .form-container {
      background: rgba(33, 37, 41, 0.8);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .section-title {
      color: #667eea;
      font-weight: 600;
      font-size: 1.25rem;
      margin-bottom: 1.5rem;
      padding-bottom: 0.75rem;
      border-bottom: 2px solid rgba(102, 126, 234, 0.3);
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .section-title i {
      font-size: 1.5rem;
    }

    .form-label {
      color: rgba(255, 255, 255, 0.9);
      font-weight: 500;
      margin-bottom: 0.5rem;
    }

    .form-label .required {
      color: #ff6b6b;
      margin-left: 0.25rem;
    }

    .form-control,
    .form-select,
    textarea {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      color: white;
      border-radius: 0.5rem;
      padding: 0.75rem 1rem;
      transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus,
    textarea:focus {
      background: rgba(255, 255, 255, 0.08);
      border-color: #667eea;
      color: white;
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
      outline: none;
    }

    .form-control::placeholder,
    textarea::placeholder {
      color: rgba(255, 255, 255, 0.4);
    }

    .form-select option {
      background: #1a1a2e;
      color: white;
    }

    textarea {
      resize: vertical;
      min-height: 120px;
    }

    .student-enrollment-section {
      margin-top: 2rem;
      padding-top: 2rem;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .student-search-box {
      position: relative;
      margin-bottom: 1.5rem;
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

    .students-list::-webkit-scrollbar-thumb:hover {
      background: rgba(102, 126, 234, 0.7);
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
      flex: 1;
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

    .btn-action {
      padding: 0.75rem 2rem;
      border-radius: 0.5rem;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
      border: none;
      position: relative;
      overflow: hidden;
      cursor: pointer;
    }

    .btn-action::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s ease;
    }

    .btn-action:hover::before {
      left: 100%;
    }

    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
      background: rgba(255, 255, 255, 0.1);
      color: rgba(255, 255, 255, 0.8);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-secondary:hover {
      background: rgba(255, 255, 255, 0.15);
      transform: translateY(-2px);
    }

    .form-actions {
      display: flex;
      gap: 1rem;
      margin-top: 2rem;
      padding-top: 2rem;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
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

    .info-box {
      background: rgba(102, 126, 234, 0.1);
      border-left: 4px solid #667eea;
      padding: 1rem;
      border-radius: 0.5rem;
      margin-bottom: 1.5rem;
    }

    .info-box p {
      color: rgba(255, 255, 255, 0.8);
      margin: 0;
      font-size: 0.9rem;
    }

    .empty-state {
      text-align: center;
      padding: 3rem 1rem;
      color: rgba(255, 255, 255, 0.5);
    }

    .empty-state i {
      font-size: 3rem;
      margin-bottom: 1rem;
      opacity: 0.3;
    }

    @media (max-width: 768px) {
      .content {
        padding: 1rem;
      }

      .page-header,
      .form-container {
        padding: 1.5rem;
      }

      .form-actions {
        flex-direction: column;
      }

      .btn-action {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <main class="content container">
    <!-- Page Header -->
    <div class="page-header">
      <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
          <h1 class="mb-2"><i class="bi bi-plus-circle"></i> Create New Course</h1>
          <p>Fill in the course details and enroll students to get started</p>
        </div>
        <div>
          <a href="<?= base_url('/teacher/classes') ?>" class="btn btn-action btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Classes
          </a>
        </div>
      </div>
    </div>

    <!-- Form Container -->
    <div class="form-container">
      <form action="<?= site_url('teacher/course/create') ?>" method="POST" id="createCourseForm">
        <?= csrf_field() ?>
        
        <!-- Course Information Section -->
        <div class="section-title">
          <i class="bi bi-info-circle"></i>
          Course Information
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <label for="courseCode" class="form-label">
              Course Name<span class="required">*</span>
            </label>
            <input 
              type="text" 
              class="form-control" 
              id="courseCode" 
              name="course_name"
              placeholder="e.g., CS101" 
              required
            >
          </div>

       <div class="col-md-6">
          <label class="form-label">Instructor</label>
          <input type="text" class="form-control" value="<?= esc(session()->get('user_name')) ?>" readonly>
      </div>

          <div class="row g-3 mb-4">
          <div class="col-md-6">
            <label for="courseCode" class="form-label">
              Course Code<span class="required">*</span>
            </label>
            <input 
              type="text" 
              class="form-control" 
              id="courseCode" 
              name="course_code"
              placeholder="e.g., CS101" 
              required
            >
          </div>
            <div class="col-md-6">
            <label for="credits" class="form-label">
              Credits<span class="required">*</span>
            </label>
            <input 
              type="number" 
              class="form-control" 
              id="credits" 
              name="credits"
              placeholder="3" 
              required
            >
          </div>
        </div>

          <div class="col-12">
            <label for="courseDescription" class="form-label">
              Course Description<span class="required">*</span>
            </label>
            <textarea 
              class="form-control" 
              id="courseDescription" 
              name="course_description"
              placeholder="Provide a detailed description of the course content and objectives..."
              required
            ></textarea>
          </div>
        </div>
        <!-- Form Actions -->
        <div class="form-actions">
          <button type="submit" class="btn-action btn-primary">
            <i class="bi bi-check-circle"></i> Create Course
          </button>
          <button type="button" class="btn-action btn-secondary" onclick="window.history.back()">
            <i class="bi bi-x-circle"></i> Cancel
          </button>
        </div>
      </form>
    </div>
  </main>

  <script>
    // Student search functionality
    document.getElementById('studentSearch').addEventListener('input', function(e) {
      const searchTerm = e.target.value.toLowerCase();
      const studentItems = document.querySelectorAll('.student-item');
      
      studentItems.forEach(item => {
        const name = item.dataset.studentName;
        const id = item.dataset.studentId;
        
        if (name.includes(searchTerm) || id.includes(searchTerm)) {
          item.style.display = 'flex';
        } else {
          item.style.display = 'none';
        }
      });
    });

    // Select all functionality
    document.getElementById('selectAll').addEventListener('change', function(e) {
      const checkboxes = document.querySelectorAll('.student-select');
      const visibleCheckboxes = Array.from(checkboxes).filter(cb => 
        cb.closest('.student-item').style.display !== 'none'
      );
      
      visibleCheckboxes.forEach(checkbox => {
        checkbox.checked = e.target.checked;
      });
      
      updateEnrolledCount();
    });

    // Update enrolled count
    function updateEnrolledCount() {
      const checkedBoxes = document.querySelectorAll('.student-select:checked');
      const count = checkedBoxes.length;
      document.getElementById('enrolledCount').textContent = `${count} selected`;
    }

    // Add event listeners to all student checkboxes
    document.querySelectorAll('.student-select').forEach(checkbox => {
      checkbox.addEventListener('change', updateEnrolledCount);
    });

    // Form validation
    document.getElementById('createCourseForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Validate time
      const startTime = document.getElementById('startTime').value;
      const endTime = document.getElementById('endTime').value;
      
      if (startTime && endTime && startTime >= endTime) {
        alert('End time must be after start time');
        return;
      }
      
      // You can submit the form here
      // this.submit();
      
      alert('Course created successfully! (This is a demo)');
    });

    // Initialize count
    updateEnrolledCount();
  </script>
</body>
</html>