<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
     <style>
      input:-webkit-autofill,
      input:-webkit-autofill:hover,
      input:-webkit-autofill:focus,
      input:-webkit-autofill:active {
          -webkit-box-shadow: 0 0 0 1000px #212529 inset !important; /* bg-dark color */
          -webkit-text-fill-color: #fff !important; /* text-white */
          background-color: #212529 !important;
          color: #fff !important;
      }
  </style>
</head>

<body class="bg-dark">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="rounded-4 bg-dark" style="max-width: 420px; width: 100%;">

    <h1 class="text-center mb-4 text-white">Forgot Password</h1>

    <!-- Flash Messages -->
    <?php if(session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>

    <?php if(isset($validation)): ?>
      <div class="alert alert-warning"><?= $validation->listErrors() ?></div>
    <?php endif; ?>

    <!-- Forgot Password Form -->
    <form action="<?= site_url('get/email') ?>" method="post">
      <?= csrf_field() ?>
<div class="mb-3">
    <label for="emailInput" class="form-label text-white">Enter Your Email</label>

    <div class="row g-2">
        <div class="col-8">
         <input type="text"
          id="emailInput"
          name="email"
          class="form-control bg-dark text-white"
          placeholder="name@example.com"
          pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$"
          title="Enter a valid email address."
          required>

            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-success w-100">
                    Send Code
                </button>
            </div>
        </div>
    </div>
    </form>

     <form action="<?= site_url('get/code') ?>" method="post">
      <?= csrf_field() ?>

      <div class="mb-3">
        <label for="emailInput" class="form-label text-white">Enter Code</label>
        <input 
          type="number" 
          id="emailInput" 
          name="code" 
          class="form-control bg-dark text-white" 
          placeholder="e.g 564312">
      </div>

      <button type="submit" class="btn btn-success w-100 mb-3">Verify</button>
    </form>

      <p class="text-center mb-0 text-white">
        <a href="<?= site_url('login') ?>">Back to Login</a>
      </p>
    </form>

  </div>
</div>

<script 
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
  crossorigin="anonymous">
</script>
</body>
</html>
