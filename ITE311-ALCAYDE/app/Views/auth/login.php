<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
  <link 
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
  rel="stylesheet" 
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
  crossorigin="anonymous">
  <link rel="stylesheet" href="<?=  base_url('styles.css') ?>">
  <style>
      body {
          background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
          position: relative;
          overflow-x: hidden;
      }

      body::before {
          content: '';
          position: absolute;
          width: 500px;
          height: 500px;
          background: radial-gradient(circle, rgba(94, 114, 228, 0.15) 0%, transparent 70%);
          border-radius: 50%;
          top: -200px;
          right: -200px;
          animation: pulse 8s ease-in-out infinite;
      }

      body::after {
          content: '';
          position: absolute;
          width: 400px;
          height: 400px;
          background: radial-gradient(circle, rgba(56, 189, 248, 0.1) 0%, transparent 70%);
          border-radius: 50%;
          bottom: -150px;
          left: -150px;
          animation: pulse 6s ease-in-out infinite;
          animation-delay: 2s;
      }

      @keyframes pulse {
          0%, 100% { transform: scale(1); opacity: 0.5; }
          50% { transform: scale(1.1); opacity: 0.3; }
      }

      .container {
          position: relative;
          z-index: 1;
      }

      .login-card {
          background: rgba(33, 37, 41, 0.8) !important;
          backdrop-filter: blur(20px);
          border: 1px solid rgba(255, 255, 255, 0.1);
          box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
          transition: transform 0.3s ease, box-shadow 0.3s ease;
      }

      .login-card:hover {
          transform: translateY(-5px);
          box-shadow: 0 25px 70px rgba(0, 0, 0, 0.6);
      }

      h1 {
          background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
          background-clip: text;
          font-weight: 700;
          letter-spacing: -0.5px;
      }

      .form-control {
          background: rgba(33, 37, 41, 0.6) !important;
          border: 1px solid rgba(255, 255, 255, 0.1);
          transition: all 0.3s ease;
          padding: 12px 16px;
      }

      .form-control:focus {
          background: rgba(33, 37, 41, 0.8) !important;
          border-color: #667eea;
          box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
          transform: translateY(-2px);
      }

      .form-label {
          font-weight: 500;
          font-size: 0.9rem;
          letter-spacing: 0.3px;
          margin-bottom: 8px;
      }

      .btn-success {
          background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
          border: none;
          padding: 14px;
          font-weight: 600;
          letter-spacing: 0.5px;
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
          box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
      }

      .btn-success:active {
          transform: translateY(0);
      }

      a {
          color: #667eea;
          text-decoration: none;
          font-weight: 500;
          transition: all 0.2s ease;
          position: relative;
      }

      a::after {
          content: '';
          position: absolute;
          width: 0;
          height: 2px;
          bottom: -2px;
          left: 0;
          background: #667eea;
          transition: width 0.3s ease;
      }

      a:hover::after {
          width: 100%;
      }

      a:hover {
          color: #764ba2;
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

      .alert-warning {
          background: rgba(255, 193, 7, 0.2);
          color: #ffd43b;
          border-left: 4px solid #ffc107;
      }

      input:-webkit-autofill,
      input:-webkit-autofill:hover,
      input:-webkit-autofill:focus,
      input:-webkit-autofill:active {
          -webkit-box-shadow: 0 0 0 1000px rgba(33, 37, 41, 0.6) inset !important;
          -webkit-text-fill-color: #fff !important;
          background-color: rgba(33, 37, 41, 0.6) !important;
          color: #fff !important;
      }

      @media (max-width: 576px) {
          body::before, body::after {
              width: 300px;
              height: 300px;
          }
      }
  </style>

</head>
<body class="bg-dark">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="rounded-4 bg-dark login-card p-4" style="max-width: 420px; width: 100%;">
    <h1 class="text-center mb-4 text-white">Sign In</h1>

    <!-- Flash & Validation Messages -->
    <?php if(session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>

    <?php if(isset($validation)): ?>
      <div class="alert alert-warning"><?= $validation->listErrors() ?></div>
    <?php endif; ?>

    <!-- Login Form -->
    <form action="<?= site_url('login') ?>" method="post">
      <?= csrf_field() ?>

      <div class="mb-3">
        <label for="emailInput" class="form-label text-white">Email Address</label>
        <input
          type="email" 
          id="emailInput" 
          name="email" 
          class="form-control bg-dark text-white" 
          placeholder="name@example.com" 
          required>
      </div>

      <div class="mb-4">
        <label for="passwordInput" class="form-label text-white">Password</label>
        <input 
          type="password" 
          id="passwordInput" 
          name="password" 
          class="form-control bg-dark text-white" 
          placeholder="********" 
          required>
      </div>

      <div class="mb-4">
        <p class="text-left mb-0 text-white">
         <a href="<?= site_url('forgot') ?>">Forgot Password?</a>
        </p>
      </div>

      <button type="submit" class="btn btn-success w-100 mb-3">Login</button>

      <p class="text-center mb-0 text-white">
        Don't have an account? <a href="<?= site_url('register') ?>">Register here</a>
      </p>
    </form>
  </div>
</div>

<script 
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
  crossorigin="anonymous"></script>
</body>
</html>