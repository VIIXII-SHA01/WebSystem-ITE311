<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restricted Access</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .restricted-card {
      max-width: 600px;
      width: 100%;
      border-radius: 1rem;
      box-shadow: 0 0.25rem 1rem rgba(0,0,0,0.1);
      background-color: #fff;
      padding: 2rem;
    }
    .restricted-icon {
      font-size: 3rem;
      background: #f8d7da;
      color: #842029;
      border-radius: 0.75rem;
      width: 70px;
      height: 70px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>
<body>
  <div class="restricted-card text-center">
    <div class="d-flex justify-content-center mb-3">
      <div class="restricted-icon">🚫</div>
    </div>
    <h2 class="mb-2">Restricted Access</h2>
    <p class="text-muted">You do not have the required permissions to access this page. Please contact an administrator or request access below.</p>

    <div class="card mt-4 p-3">
      <h6 class="text-start mb-2">Signed in as</h6>
      <p class="mb-0"><strong>Restricted User</strong> • user@example.com</p>
    </div>

    <div class="mt-4 d-flex flex-column gap-2">
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestModal">✉️ Request Access</button>
      <a href="mailto:admin@example.com" class="btn btn-outline-secondary">📧 Contact Admin</a>
      <a href="/logout" class="btn btn-outline-dark">↩️ Sign Out</a>
    </div>

    <div class="mt-4">
      <small class="text-muted">Need help? <a href="/help/access-policies">Learn about access policies</a></small>
    </div>
  </div>

  <!-- Request Access Modal -->
  <div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="requestModalLabel">Request Access</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="requestAccessForm">
            <div class="mb-3">
              <label class="form-label">Your Email</label>
              <input type="email" class="form-control" value="user@example.com" readonly>
            </div>
            <div class="mb-3">
              <label class="form-label">Reason / Message (optional)</label>
              <textarea class="form-control" rows="4" placeholder="Explain why you need access or reference a ticket number."></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" form="requestAccessForm" class="btn btn-primary">Send Request</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
