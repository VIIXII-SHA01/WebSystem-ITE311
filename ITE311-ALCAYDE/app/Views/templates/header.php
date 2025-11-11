<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }
    nav{
      background-color:rgba(61, 197, 34, 0.9) !important;
    }
    .nav-item{
       color: white;
    }
    .nav-item{
      list-style: none;
    }
    #navMain{
      border-bottom: 0.8px solid white;
    }
  </style>
</head>
<body>

  <!-- Responsive Navbar -->
  <nav id="navMain" class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold text-white" href="<?= base_url('/dashboard') ?>">Dashboard</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- Admin Links -->
          <?php if (session()->get('user_role') === 'admin'): ?>
            <li class="nav-item"><a class="navbar-brand fw-bold text-white" href="<?= base_url('users') ?>">User Management</a></li>
            <li class="nav-item"><a class="navbar-brand fw-bold text-white" href="#">Manage Courses</a></li>
            <li class="nav-item"><a class="navbar-brand fw-bold text-white" href="#">Enrollments</a></li>
          <?php endif; ?>

          <!-- Teacher Links -->
          <?php if (session()->get('user_role') === 'teacher'): ?>
            <li class="nav-item"><a class="navbar-brand fw-bold text-white" href="#">My Classes</a></li>
            <li class="nav-item"><a class="navbar-brand fw-bold text-white" href="#">Create Course</a></li>
          <?php endif; ?>

          <!-- Student Links -->
          <?php if (session()->get('user_role') === 'student'): ?>
            <li class="nav-item"><a class="navbar-brand fw-bold text-white" href="<?= base_url('/course/enroll')?>">My Courses</a></li>
            <li class="nav-item"><a class="navbar-brand fw-bold text-white" href="#">My Grades</a></li>
          <?php endif; ?>
        </ul>
            <li class="nav-item">
              <a class="navbar-brand fw-bold text-danger" href="<?= base_url('/logout') ?>">Logout</a>
            </li>
      </div>
    </div>
  </nav>

  <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
