<?= $this->include('templates/header') ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc(session()->get('user_role')) ?> | Dashboard</title>

  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: hsl(219, 12%, 23%, 1.00);
      }
      #min{
        margin-top: 20px;
      }
  </style>
</head>
<body>
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
  </main
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
