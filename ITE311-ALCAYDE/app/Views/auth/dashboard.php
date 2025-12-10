<?= $this->include('templates/header') ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc(session()->get('user_role')) ?> | Dashboard</title>
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

    h2 {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      font-weight: 700;
      text-shadow: none;
    }

    .stats-card {
      background: rgba(33, 37, 41, 0.8) !important;
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 1rem;
      transition: all 0.3s ease;
      color: white;
    }

    .stats-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
      border-color: rgba(102, 126, 234, 0.5);
    }

    .stats-card h3 {
      font-weight: 700;
      margin: 0.5rem 0;
      font-size: 2rem;
    }

    .stats-card p {
      margin: 0;
      opacity: 0.8;
      font-weight: 500;
    }

    .card {
      background: rgba(33, 37, 41, 0.8) !important;
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 1rem;
      transition: all 0.3s ease;
      overflow: hidden;
      position: relative;
    }

    .card::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
      transition: left 0.5s ease;
    }

    .card:hover::before {
      left: 100%;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
      border-color: rgba(102, 126, 234, 0.5);
    }

    .card-body {
      position: relative;
      z-index: 1;
    }

    .card-title {
      color: #667eea;
      font-weight: 600;
      margin-bottom: 0.75rem;
    }

    .card-text {
      color: rgba(255, 255, 255, 0.8);
      font-size: 0.95rem;
    }

    .btn-success {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      padding: 12px;
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

    .alert {
      border: none;
      border-radius: 12px;
      backdrop-filter: blur(10px);
      animation: slideIn 0.5s ease;
      margin-bottom: 1.5rem;
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

    .alert-warning {
      background: rgba(255, 193, 7, 0.2);
      color: #ffd43b;
      border-left: 4px solid #ffc107;
    }

    .alert li {
      list-style-position: inside;
    }

    @media (max-width: 768px) {
      .content {
        padding: 1rem;
      }
      
      body::before, body::after {
        width: 400px;
        height: 400px;
      }
    }
  </style>
</head>
<body>
   <?php if (session()->getFlashdata('success_change')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success_change') ?></div>
  <?php elseif (session()->getFlashdata('error_change')): ?>
    <div class="alert alert-danger">
      <?php
        $error = session()->getFlashdata('error_change');
        if (is_array($error)) {
            foreach ($error as $msg) echo "<li>".esc($msg)."</li>";
        } else {
            echo esc($error);
        }
      ?>
    </div>
  <?php endif; ?>

   <?php if(session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>

    <?php if(isset($validation)): ?>
      <div class="alert alert-warning"><?= $validation->listErrors() ?></div>
    <?php endif; ?>
    
  <?php if (session()->get('user_role') === 'admin'): ?>
     <!-- Main Content -->
  <main id="min" class="content container">
     <h2 class="mb-4 text-success fw-bold">Welcome, <?= session()->get('user_name') ?? 'Admin' ?></h2>
    <!-- Quick Stats Section -->
    <div class="row g-4 mb-5">
      <div class="col-md-3 col-sm-6">
        <div class="card stats-card p-3 shadow-sm">
          <i class="bi bi-people fs-1 text-success"></i>
          <h3>245</h3>
          <p>Total Users</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="card stats-card p-3 shadow-sm">
          <i class="bi bi-book fs-1 text-info"></i>
          <h3>38</h3>
          <p>Courses</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="card stats-card p-3 shadow-sm">
          <i class="bi bi-megaphone fs-1 text-warning"></i>
          <h3>12</h3>
          <p>Announcements</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="card stats-card p-3 shadow-sm">
          <i class="bi bi-graph-up-arrow fs-1 text-danger"></i>
          <h3>98%</h3>
          <p>Activity Rate</p>
        </div>
      </div>
    </div>

    <!-- Management Sections -->
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-person-gear"></i> User Management</h5>
            <p class="card-text">View, add, and manage teachers, students, and admins.</p>
            <a href="#" class="btn btn-success w-100">Go to Users</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-book-half"></i> Course Management</h5>
            <p class="card-text">Create and assign courses, update details, and monitor progress.</p>
            <a href="#" class="btn btn-success w-100">Go to Courses</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-megaphone"></i> Announcements</h5>
            <p class="card-text">Post new announcements for students and faculty.</p>
            <a href="#" class="btn btn-success w-100">Manage Announcements</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-bar-chart"></i> Reports & Analytics</h5>
            <p class="card-text">Track course performance, student progress, and system usage.</p>
            <a href="#" class="btn btn-success w-100">View Reports</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-chat-dots"></i> Feedback & Support</h5>
            <p class="card-text">View feedback submitted by users and respond accordingly.</p>
            <a href="#" class="btn btn-success w-100">View Feedback</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-shield-lock"></i> System Settings</h5>
            <p class="card-text">Manage LMS configurations, user roles, and permissions.</p>
            <a href="#" class="btn btn-success w-100">Open Settings</a>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php endif; ?>

  <?php if (session()->get('user_role') === 'student'): ?>
    <!-- Main Content -->
  <main class="content container">
    <h2 class="mb-4 text-success fw-bold">Welcome, <?= session()->get('user_name') ?? 'Student' ?></h2>

    <!-- Quick Stats -->
    <div class="row g-4 mb-5">
      <div class="col-md-3 col-sm-6">
        <div class="card stats-card p-3 shadow-sm">
          <i class="bi bi-book fs-1 text-success"></i>
          <h3>5</h3>
          <p>Enrolled Courses</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="card stats-card p-3 shadow-sm">
          <i class="bi bi-award fs-1 text-info"></i>
          <h3>3.8</h3>
          <p>GPA</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="card stats-card p-3 shadow-sm">
          <i class="bi bi-check2-circle fs-1 text-warning"></i>
          <h3>12</h3>
          <p>Completed Modules</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="card stats-card p-3 shadow-sm">
          <i class="bi bi-megaphone fs-1 text-danger"></i>
          <h3>4</h3>
          <p>New Announcements</p>
        </div>
      </div>
    </div>

    <!-- Student Panels -->
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-book-half"></i> My Courses</h5>
            <p class="card-text">View all your enrolled subjects and access course materials.</p>
            <a href="#" class="btn btn-success w-100">View Courses</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-bar-chart-line"></i> My Grades</h5>
            <p class="card-text">Check your grades, GPA, and performance analytics.</p>
            <a href="#" class="btn btn-success w-100">View Grades</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-megaphone"></i> Announcements</h5>
            <p class="card-text">Read updates and announcements from your instructors.</p>
            <a href="#" class="btn btn-success w-100">Read Announcements</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-calendar-event"></i> Class Schedule</h5>
            <p class="card-text">View your upcoming classes and important events.</p>
            <a href="#" class="btn btn-success w-100">View Schedule</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-chat-dots"></i> Messages</h5>
            <p class="card-text">Communicate with your teachers and classmates easily.</p>
            <a href="#" class="btn btn-success w-100">Open Messages</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-person-circle"></i> Settings</h5>
            <p class="card-text">Update your profile information and change your password.</p>
            <a href="#" class="btn btn-success w-100">Go to Settings</a>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php endif; ?>

  <?php if (session()->get('user_role') === 'teacher'): ?>
    <!-- Main Content -->
  <main class="content container">
    <h2 class="mb-4 text-success fw-bold">Welcome, <?= session()->get('user_name') ?? 'Teacher' ?></h2>

    <!-- Quick Stats -->
    <div class="row g-4 mb-5">
      <div class="col-md-3 col-sm-6">
        <div class="card stats-card p-3 shadow-sm">
          <i class="bi bi-journal-text fs-1 text-success"></i>
          <h3>4</h3>
          <p>Courses Taught</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="card stats-card p-3 shadow-sm">
          <i class="bi bi-people fs-1 text-info"></i>
          <h3>120</h3>
          <p>Active Students</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="card stats-card p-3 shadow-sm">
          <i class="bi bi-pencil-square fs-1 text-warning"></i>
          <h3>8</h3>
          <p>Assignments Posted</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="card stats-card p-3 shadow-sm">
          <i class="bi bi-megaphone fs-1 text-danger"></i>
          <h3>3</h3>
          <p>Announcements</p>
        </div>
      </div>
    </div>

    <!-- Teacher Tools -->
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-book"></i> Manage Courses</h5>
            <p class="card-text">Create, update, or delete the courses you handle.</p>
            <a href="#" class="btn btn-success w-100">Manage Courses</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-people"></i> View Class List</h5>
            <p class="card-text">Check your students, attendance, and performance details.</p>
            <a href="#" class="btn btn-success w-100">View Class</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-award"></i> Grade Submissions</h5>
            <p class="card-text">Review and grade assignments submitted by your students.</p>
            <a href="#" class="btn btn-success w-100">Grade Now</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-megaphone"></i> Announcements</h5>
            <p class="card-text">Post and manage course announcements and reminders.</p>
            <a href="#" class="btn btn-success w-100">Post Announcement</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-chat-dots"></i> Messages</h5>
            <p class="card-text">Communicate with your students through the LMS message system.</p>
            <a href="#" class="btn btn-success w-100">Open Messages</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card p-3 shadow">
          <div class="card-body">
            <h5 class="card-title"><i class="bi bi-calendar-event"></i> Schedule</h5>
            <p class="card-text">View your teaching schedule and upcoming sessions.</p>
            <a href="#" class="btn btn-success w-100">View Schedule</a>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php endif; ?>
</body>
</html>