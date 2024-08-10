<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="<?= base_url('sb-admin/vendor/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('css/root.css') ?>">
</head>

<body>
  <div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="p-3">
      <div>
        <h1 class="fw-bold">Register</h1>
        <p>Silahkan daftar terlebih dahulu</p>
      </div>
      <form method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" aria-describedby="username-help">
          <div id="username-help" class="form-text"><?= $errors['username'] ?? null ?></div>
        </div>
        <div class="mb-3">
          <label for="nama-pelanggan" class="form-label">Nama</label>
          <input type="text" class="form-control" id="nama-pelanggan" name="nama-pelanggan" aria-describedby="nama-pelanggan-help">
          <div id="nama-pelanggan-help" class="form-text"><?= $errors['nama_pelanggan'] ?? null ?></div>
        </div>
        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat</label>
          <input type="text" class="form-control" id="alamat" name="alamat" aria-describedby="alamat-help">
          <div id="alamat-help" class="form-text"><?= $errors['alamat'] ?? null ?></div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
          <div id="password-help" class="form-text"><?= $errors['password'] ?? null ?></div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
      </form>
    </div>
  </div>

  <script src="<?= base_url('js/root.js') ?>"></script>
</body>

</html>