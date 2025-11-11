<?= $this->include('templates/header') ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management - LMS Admin</title>

  <!-- ✅ Correct Bootstrap CSS -->
  <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <style>
    body {
      background-color: #181B1F;
      color: #fff;
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .navbar {
      background-color: #000 !important;
    }

    .navbar-brand, .nav-link {
      color: #fff !important;
    }

    .nav-link:hover {
      color: #4CAF50 !important;
    }

    .content {
      flex: 1;
      padding: 2rem;
    }

    .table-dark th {
      background-color: #212529 !important;
    }

    .btn-success {
      background-color: #4CAF50;
      border: none;
    }

    .btn-success:hover {
      background-color: #43a047;
    }

    .modal-content {
      background-color: #1f2428;
      color: #fff;
      border: none;
      border-radius: 10px;
    }

    footer {
      background-color: #111;
      color: #bbb;
      text-align: center;
      padding: 1rem 0;
      font-size: 0.9rem;
    }

    .status-badge {
      font-size: 0.85rem;
      padding: 5px 10px;
      border-radius: 10px;
    }

    .status-granted {
      background-color: #198754;
    }

    .status-restricted {
      background-color: #dc3545;
    }
  </style>
</head>
<body>

  <!-- ✅ Flash Messages -->
  <div class="container mt-3">
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php elseif($errors = session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('errors') ?></div>
    </div>
    <?php endif; ?>
  </div>

  <!-- ✅ Main Content -->
  <main class="content container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold text-success">User Management</h2>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="bi bi-person-plus"></i> Add New User
      </button>
    </div>

    <!-- ✅ Users Table -->
    <div class="table-responsive">
      <table class="table table-dark table-striped align-middle text-center">
        <thead>
          <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created</th>
            <th>Actions</th>
          </tr>
        </thead>
      <tbody>
  <?php if (!empty($users)): ?>
    <?php foreach ($users as $user): ?>
      <tr>
        <td><?= esc($user['id'] ?? '') ?></td>
        <td><?= esc($user['name'] ?? '') ?></td>
        <td><?= esc($user['email'] ?? '') ?></td>
        <td><span class="badge bg-primary"><?= ucfirst(esc($user['role'])) ?></span></td>
        <td>
          <span class="status-badge <?= $user['status'] === 'granted' ? 'status-granted' : 'status-restricted' ?>">
            <?= ucfirst($user['status']) ?>
          </span>
        </td>
        <td><?= date('Y-m-d', strtotime($user['created_at'])) ?></td>
        <td>
          <?php if ($user['id'] == session()->get('user_id')): ?>
            <span class="text-white fst-bold">You</span>
          <?php else: ?>
            <!-- Edit -->
            <button class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#editUserModal<?= $user['id'] ?>">
              <i class="bi bi-pencil-square"></i>
            </button>

            <!-- Restrict/Unrestrict -->
            <a href="<?= base_url('users/toggle/' . $user['id']) ?>"
               class="btn btn-sm <?= $user['status'] === 'granted' ? 'btn-outline-danger' : 'btn-outline-success' ?>"
               onclick="return confirm('Are you sure you want to change restriction for this user?')">
              <?php if ($user['status'] === 'granted'): ?>
                <i class="bi bi-person-x"></i>
              <?php else: ?>
                <i class="bi bi-person-check"></i>
              <?php endif; ?>
            </a>
          <?php endif; ?>
        </td>
      </tr>

      <?php if ($user['id'] != session()->get('id')): ?>
        <!-- ✅ Edit User Modal -->
        <div class="modal fade" id="editUserModal<?= $user['id'] ?>" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header border-0">
                <h5 class="modal-title text-success">Edit User Information</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <form method="post" action="<?= base_url('users/update/' . $user['id']) ?>">
                  <?= csrf_field() ?>
                  <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control bg-dark text-white border-0" value="<?= esc($user['name']) ?>" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select bg-dark text-white border-0" required>
                      <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                      <option value="teacher" <?= $user['role'] === 'teacher' ? 'selected' : '' ?>>Teacher</option>
                      <option value="student" <?= $user['role'] === 'student' ? 'selected' : '' ?>>Student</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select bg-dark text-white border-0">
                      <option value="granted" <?= $user['status'] === 'granted' ? 'selected' : '' ?>>Granted</option>
                      <option value="restricted" <?= $user['status'] === 'restricted' ? 'selected' : '' ?>>Restricted</option>
                    </select>
                  </div>
                  <small class="text-muted d-block mb-3">* Password will reset to "password123" when updated.</small>
                  <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php else: ?>
    <tr><td colspan="7" class="text-muted">No users found.</td></tr>
  <?php endif; ?>
</tbody>

      </table>
    </div>
  </main>

  <!-- ✅ Add User Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title text-success">Add New User</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?= base_url('users/add') ?>">
            <?= csrf_field() ?>
            <div class="mb-3">
              <label class="form-label">Full Name</label>
              <input type="text" name="name" class="form-control bg-dark text-white border-0" placeholder="Enter full name" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control bg-dark text-white border-0" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Role</label>
              <select name="role" class="form-select bg-dark text-white border-0" required>
                <option value="">Select Role</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="admin">Admin</option>
              </select>
            </div>
            <small class="text-muted d-block mb-3">Default password: <strong>password123</strong></small>
            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-success">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- ✅ Footer -->
  <footer>
    &copy; <?= date('Y') ?> Learning Management System — Admin Panel
  </footer>

  <!-- ✅ Bootstrap JS Bundle (includes Popper.js) -->
  <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
