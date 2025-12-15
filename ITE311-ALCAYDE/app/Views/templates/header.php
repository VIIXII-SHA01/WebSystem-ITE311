<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="styles.css">
   <link 
    rel="stylesheet" 
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    #navMain {
      background: rgba(33, 37, 41, 0.95) !important;
      backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(102, 126, 234, 0.3);
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
      position: relative;
      z-index: 1000;
    }

    .navbar-brand {
      transition: all 0.3s ease;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .navbar-brand:hover {
      background: rgba(102, 126, 234, 0.2);
      transform: translateY(-2px);
    }

    .navbar-brand i {
      font-size: 1.1rem;
    }

    .navbar-brand.text-danger:hover {
      background: rgba(220, 53, 69, 0.2);
    }

    .dropdown-menu {
      background: rgba(33, 37, 41, 0.95) !important;
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
      margin-top: 0.5rem;
      z-index: 1050;
    }

    .dropdown-item {
      color: white;
      transition: all 0.3s ease;
      padding: 0.75rem 1.25rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .dropdown-item i {
      font-size: 1rem;
      width: 20px;
    }

    .dropdown-item:hover {
      background: rgba(102, 126, 234, 0.3);
      color: white;
      transform: translateX(5px);
    }

    .dropdown-divider {
      border-color: rgba(255, 255, 255, 0.1);
    }

    .navbar-toggler {
      border: 1px solid rgba(102, 126, 234, 0.5);
    }

    .navbar-toggler:focus {
      box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
    }

    .modal-content {
      background: rgba(33, 37, 41, 0.95) !important;
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      color: white;
      z-index: 1060;
    }

    .modal-header {
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .modal-footer {
      border-top: 1px solid rgba(255, 255, 255, 0.1);
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

    .form-control {
      background: rgba(33, 37, 41, 0.6) !important;
      border: 1px solid rgba(255, 255, 255, 0.1);
      color: white;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      background: rgba(33, 37, 41, 0.8) !important;
      border-color: #667eea;
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
      color: white;
    }

    .form-floating > label {
      color: rgba(255, 255, 255, 0.7);
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
      color: #667eea;
    }

    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      transition: all 0.3s ease;
      font-weight: 600;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
      background: rgba(108, 117, 125, 0.8);
      border: none;
      transition: all 0.3s ease;
    }

    .btn-secondary:hover {
      background: rgba(108, 117, 125, 1);
      transform: translateY(-2px);
    }

    @media (max-width: 991px) {
      .navbar-brand {
        margin: 0.25rem 0;
      }
    }
  </style>
</head>
<body>
  <!-- Responsive Navbar -->
  <nav id="navMain" class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold text-white" href="<?= base_url('/dashboard') ?>">
        <i class="bi bi-speedometer2"></i>
        Dashboard
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- Admin Links -->
          <?php if (session()->get('user_role') === 'admin'): ?>
            <li class="nav-item">
              <a class="navbar-brand fw-bold text-white" href="<?= base_url('users') ?>">
                <i class="bi bi-people"></i>
                User Management
              </a>
            </li>
            <li class="nav-item">
              <a class="navbar-brand fw-bold text-white" href="<?= base_url('course/admin') ?>">
                <i class="bi bi-book"></i>
                Manage Courses
              </a>
            </li>
             <li class="nav-item">
            <a class="navbar-brand fw-bold text-white" href="<?= base_url('/admin/upload') ?>">
              <i class="bi bi-cloud-upload"></i>
              Upload Materials
            </a>
          </li>
            <li class="nav-item">
              <a class="navbar-brand fw-bold text-white" href="<?= base_url('admin/enrollments') ?>">
                <i class="bi bi-clipboard-check"></i>
                Enrollments
              </a>
            </li>
          <?php endif; ?>

          <!-- Teacher Links -->
          <?php if (session()->get('user_role') === 'teacher'): ?>
          <li class="nav-item">
            <a class="navbar-brand fw-bold text-white" href="<?= base_url('/teacher/classes') ?>">
              <i class="bi bi-journal-text"></i>
              My Classes
            </a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand fw-bold text-white" href="<?= base_url('/teacher/addCourse') ?>">
              <i class="bi bi-plus-circle"></i>
              Create Course
            </a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand fw-bold text-white" href="<?= base_url('/teacher/course') ?>">
              <i class="bi bi-cloud-upload"></i>
              Upload Materials
            </a>
          </li>
        <?php endif; ?>
                  <!-- Student Links -->
          <?php if (session()->get('user_role') === 'student'): ?>
            <li class="nav-item">
              <a class="navbar-brand fw-bold text-white" href="<?= base_url('/course/enroll') ?>">
                <i class="bi bi-book-half"></i>
                My Courses
              </a>
            </li>
            <li class="nav-item">
              <a class="navbar-brand fw-bold text-white" href="<?= base_url('#') ?>">
                <i class="bi bi-bar-chart-line"></i>
                My Grades
              </a>
            </li>
          <?php endif; ?>

          <li class="nav-item dropdown">
            <a class="navbar-brand dropdown-toggle fw-bold text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-gear"></i>
              Settings
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" role="button" href="#" data-bs-toggle="modal" data-bs-target="#change_password_modal">
                  <i class="bi bi-key"></i>
                  Change Password
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="#">
                  <i class="bi bi-file-earmark-text"></i>
                  Report
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item" href="#">
                  <i class="bi bi-info-circle"></i>
                  About Us
                </a>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="navbar-brand fw-bold text-danger" href="<?= base_url('/logout') ?>">
              <i class="bi bi-box-arrow-right"></i>
              Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Modal - Moved outside navbar to fix z-index issues -->
  <div class="modal fade" id="change_password_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">
            <i class="bi bi-key"></i> Change Password
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('users/changePassword') ?>" method="post">
            <?=  csrf_field() ?>
            <div class="form-floating mb-3">
              <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
              <label for="floatingPassword">Enter New Password</label>
            </div>
            <div class="form-floating">
              <input type="password" name="confirm_password" class="form-control" id="floatingConfirmPassword" placeholder="Password">
              <label for="floatingConfirmPassword">Confirm Password</label>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Close
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle"></i> Update Password
          </button>
        </div>
          </form>
      </div>
    </div>
  </div>
  <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>