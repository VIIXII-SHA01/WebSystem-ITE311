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
            <li class="nav-item dropdown">
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
           <a class="navbar-brand dropdown-toggle fw-bold text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Settings
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" role="button" href="#" data-bs-toggle="modal" data-bs-target="#change_password_modal">Change Password</a></li>
              <li><a class="dropdown-item" href="#">Report</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">About Us</a></li>
            </ul>
          </li>
        </ul>
            <li class="nav-item">
              <a class="navbar-brand fw-bold text-danger" href="<?= base_url('/logout') ?>">Logout</a>
            </li>
        <!-- Modal -->
        <div class="modal fade" id="change_password_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="<?= base_url('users/changePassword') ?>" method="post">
                  <?=  csrf_field() ?>
                <div class="form-floating">
                  <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                  <label for="floatingPassword">Enter New Password</label>
                </div>
                 <br>
                <div class="form-floating">
                  <input type="password" name="confirm_password" class="form-control" id="floatingPassword" placeholder="Password">
                  <label for="floatingPassword">Confirm Password</label>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Password</button>
              </div>
             </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
