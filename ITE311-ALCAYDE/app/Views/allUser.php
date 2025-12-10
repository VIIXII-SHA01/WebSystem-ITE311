<?= $this->include('templates/header') ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management - LMS Admin</title>
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

    .container, .container-fluid {
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

    .alert {
      border: none;
      border-radius: 12px;
      backdrop-filter: blur(10px);
      animation: slideIn 0.5s ease;
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

    .alert li {
      list-style-position: inside;
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

    .badge {
      padding: 0.5rem 1rem;
      font-weight: 500;
      border-radius: 0.5rem;
    }

    .status-badge {
      padding: 0.4rem 1rem;
      border-radius: 0.5rem;
      font-weight: 500;
      font-size: 0.875rem;
    }

    .status-granted {
      background: rgba(25, 135, 84, 0.2);
      color: #51cf66;
      border: 1px solid rgba(25, 135, 84, 0.5);
    }

    .status-restricted {
      background: rgba(220, 53, 69, 0.2);
      color: #ff6b6b;
      border: 1px solid rgba(220, 53, 69, 0.5);
    }

    .btn-outline-light,
    .btn-outline-danger,
    .btn-outline-success {
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

    .btn-outline-success:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3);
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
    }
  </style>
</head>
<body class="bg-dark">

  <!-- ✅ Flash Messages -->
  <div class="container mt-3">

  <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>

  <?php elseif (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>

  <?php elseif (session()->getFlashdata('validation')): ?>
    <div class="alert alert-danger">
      <ul>
        <?php foreach (session()->getFlashdata('validation') as $error): ?>
          <li><?= esc($error) ?></li>
        <?php endforeach; ?>
      </ul>
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
</body>
</html>