<?= $this->include('templates/header') ?>

<?php $session = session(); ?>
<?php $teacherId = $session->get('user_name'); ?>
<?php 
// Fetch courses for this teacher (do this in the controller ideally and pass $courses)
$coursesModel = new \App\Models\courseModel();
$courses = $coursesModel->where('course_instructor', $teacherId)->findAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Classes | Teacher Dashboard</title>
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

    .filter-section {
      background: rgba(33, 37, 41, 0.8);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 1rem;
      padding: 1.5rem;
      margin-bottom: 2rem;
    }

    .filter-section .form-control,
    .filter-section .form-select {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      color: white;
      border-radius: 0.5rem;
      padding: 0.75rem 1rem;
    }

    .filter-section .form-control:focus,
    .filter-section .form-select:focus {
      background: rgba(255, 255, 255, 0.08);
      border-color: #667eea;
      color: white;
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .filter-section .form-select option {
      background: #1a1a2e;
      color: white;
    }

    .course-card {
      background: rgba(33, 37, 41, 0.8);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 1rem;
      overflow: hidden;
      transition: all 0.3s ease;
      height: 100%;
      position: relative;
    }

    .course-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 5px;
      background: linear-gradient(90deg, #667eea, #764ba2);
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.3s ease;
    }

    .course-card:hover::before {
      transform: scaleX(1);
    }

    .course-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
      border-color: rgba(102, 126, 234, 0.5);
    }

    .course-header {
      padding: 1.5rem;
      background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .course-code {
      display: inline-block;
      background: rgba(102, 126, 234, 0.2);
      color: #667eea;
      padding: 0.25rem 0.75rem;
      border-radius: 0.5rem;
      font-size: 0.85rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .course-title {
      color: white;
      font-weight: 700;
      font-size: 1.25rem;
      margin: 0.5rem 0;
    }

    .course-description {
      color: rgba(255, 255, 255, 0.7);
      font-size: 0.9rem;
      margin: 0;
    }

    .course-body {
      padding: 1.5rem;
    }

    .course-stats {
      display: flex;
      gap: 1.5rem;
      margin-bottom: 1.5rem;
      flex-wrap: wrap;
    }

    .stat-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .stat-item i {
      font-size: 1.2rem;
      color: #667eea;
    }

    .stat-item .stat-value {
      color: white;
      font-weight: 600;
      font-size: 1.1rem;
    }

    .stat-item .stat-label {
      color: rgba(255, 255, 255, 0.6);
      font-size: 0.85rem;
    }

    .course-actions {
      display: flex;
      gap: 0.75rem;
      flex-wrap: wrap;
    }

    .btn-action {
      flex: 1;
      min-width: 120px;
      padding: 0.75rem 1rem;
      border-radius: 0.5rem;
      font-weight: 600;
      font-size: 0.9rem;
      transition: all 0.3s ease;
      border: none;
      position: relative;
      overflow: hidden;
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

    .btn-outline {
      background: transparent;
      border: 1px solid rgba(102, 126, 234, 0.5);
      color: #667eea;
    }

    .btn-outline:hover {
      background: rgba(102, 126, 234, 0.1);
      border-color: #667eea;
      transform: translateY(-2px);
    }

    .badge-status {
      display: inline-block;
      padding: 0.35rem 0.75rem;
      border-radius: 0.5rem;
      font-size: 0.8rem;
      font-weight: 600;
      margin-left: auto;
    }

    .badge-active {
      background: rgba(25, 135, 84, 0.2);
      color: #51cf66;
    }

    .badge-upcoming {
      background: rgba(255, 193, 7, 0.2);
      color: #ffd43b;
    }

    .badge-completed {
      background: rgba(108, 117, 125, 0.2);
      color: #adb5bd;
    }

    .empty-state {
      background: rgba(33, 37, 41, 0.8);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 1rem;
      padding: 4rem 2rem;
      text-align: center;
    }

    .empty-state i {
      font-size: 4rem;
      color: rgba(102, 126, 234, 0.3);
      margin-bottom: 1rem;
    }

    .empty-state h3 {
      color: rgba(255, 255, 255, 0.7);
      margin-bottom: 0.5rem;
    }

    .empty-state p {
      color: rgba(255, 255, 255, 0.5);
    }

    @media (max-width: 768px) {
      .content {
        padding: 1rem;
      }

      .page-header {
        padding: 1.5rem;
      }

      .course-stats {
        gap: 1rem;
      }

      .course-actions {
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
          <h1 class="mb-2"><i class="bi bi-journal-text"></i> My Classes</h1>
          <p>Manage and view all the courses you're teaching this semester</p>
        </div>
        <div>
          <a href="<?= base_url('courses/add') ?>" class="btn btn-action btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Course
          </a>
        </div>
      </div>
    </div>

    <!-- Filter Section remains unchanged -->
    
    <!-- Courses Grid -->
    <div class="row g-4" id="coursesGrid">
      <?php if(!empty($courses)): ?>
        <?php foreach($courses as $course): ?>
        <div class="col-md-6 col-lg-4">
          <div class="course-card">
            <div class="course-header">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <span class="course-code"><?= esc($course['course_code']) ?></span>
                </div>
              </div>
              <h3 class="course-title"><?= esc($course['course_name']) ?></h3>
              <p class="course-description"><?= esc($course['course_description']) ?></p>
            </div>
            <div class="course-body">
              <div class="course-stats">
              </div>
              <div class="course-actions">
                <a href="<?= base_url('courses/view/' . $course['id']) ?>" class="btn-action btn-primary">
                  <i class="bi bi-box-arrow-in-right"></i> Enter Class
                </a>
                <a href="<?= base_url('courses/manage/' . $course['id']) ?>" class="btn-action btn-outline">
                  <i class="bi bi-gear"></i> Manage
                </a>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <div class="empty-state">
            <i class="bi bi-journal-x"></i>
            <h3>No Classes Found</h3>
            <p>You don't have any classes assigned yet. Try adding a new course.</p>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <!-- Empty State (hidden by default, show when no courses) -->
    <!-- <div class="empty-state" style="display: none;">
      <i class="bi bi-journal-x"></i>
      <h3>No Classes Found</h3>
      <p>You don't have any classes matching your filters. Try adjusting your search criteria.</p>
    </div> -->
  </main>

  <script>
    // Basic filter functionality
    document.getElementById('searchInput').addEventListener('input', function(e) {
      const searchTerm = e.target.value.toLowerCase();
      const cards = document.querySelectorAll('.course-card');
      
      cards.forEach(card => {
        const title = card.querySelector('.course-title').textContent.toLowerCase();
        const code = card.querySelector('.course-code').textContent.toLowerCase();
        const description = card.querySelector('.course-description').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || code.includes(searchTerm) || description.includes(searchTerm)) {
          card.closest('.col-md-6').style.display = 'block';
        } else {
          card.closest('.col-md-6').style.display = 'none';
        }
      });
    });
  </script>
</body>
</html>