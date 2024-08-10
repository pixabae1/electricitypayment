<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="<?= base_url('sb-admin/vendor/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('css/root.css') ?>">
</head>

<body>
  <div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="p-3">
      <div>
        <h1 class="fw-bold">Login</h1>
        <p>Silahkan masuk terlebih dahulu</p>
      </div>
      <form method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" aria-describedby="username-help">
          <div id="username-help" class="form-text"><?= $errors['username'] ?? null ?></div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
          <div id="password-help" class="form-text"><?= $errors['password'] ?? null ?></div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
      </form>
    </div>
  </div>

  <script src="<?= base_url('js/root.js') ?>"></script>
</body>

</html>