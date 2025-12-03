<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>

  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">

  <link rel="stylesheet" href="styles.css">
</head>

<body class="bg-dark">

<div class="container d-flex justify-content-center align-items-center min-vh-100">

  <div class="rounded-4 bg-dark" style="max-width: 420px; width: 100%;">

    <h1 class="text-center mb-4 text-white">Reset Password</h1>

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


    <!-- Reset Password Form -->
    <form action="<?= site_url('password/update') ?>" method="post">
      <?= csrf_field() ?>

      <div class="mb-3">
        <label for="newPassword" class="form-label text-white">New Password</label>
        <input 
          type="password" 
          id="newPassword" 
          name="password" 
          class="form-control bg-dark text-white" 
          placeholder="********"
          required>
      </div>

      <div class="mb-3">
        <label for="confirmPassword" class="form-label text-white">Confirm Password</label>
        <input 
          type="password" 
          id="confirmPassword" 
          name="confirm_password" 
          class="form-control bg-dark text-white" 
          placeholder="********"
          required>
      </div>

      <button type="submit" class="btn btn-success w-100 mb-3">
        Update Password
      </button>

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
