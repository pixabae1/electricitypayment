<?= $this->extend('templates/dashboard') ?>

<?= $this->section('page_title') ?>
Tagihan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= var_dump($errors) ?>
<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Tagihan</h1>
</div>

<!-- Table -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nama Pelanggan</th>
            <th>Nomor KWH</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Jumlah Meter</th>
            <th>Status</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Nama Pelanggan</th>
            <th>Nomor KWH</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Jumlah Meter</th>
            <th>Status</th>
          </tr>
        </tfoot>
        <tbody>
          <?php foreach ($tagihan as $row) : ?>
            <tr>
              <td><?= $row['nama_pelanggan'] ?></td>
              <td><?= $row['nomor_kwh'] ?></td>
              <td><?= $row['bulan'] ?></td>
              <td><?= $row['tahun'] ?></td>
              <td><?= $row['jumlah_meter'] ?></td>
              <?php if ($user['role'] === 'admin') : ?>
                <td>
                  <form action="<?= base_url('dashboard/tagihan/update/' . $row['id_tagihan']) ?>" method="post" class="d-flex align-items-center" style="gap: 0.5rem;">
                    <input type="hidden" name="id-tagihan" value="<?= $row['id_tagihan'] ?>">
                    <input type="hidden" name="id-penggunaan" value="<?= $row['id_penggunaan'] ?>">
                    <input type="hidden" name="id-pelanggan" value="<?= $row['id_pelanggan'] ?>">
                    <input type="hidden" name="jumlah-meter" value="<?= $row['jumlah_meter'] ?>">
                    <select class="custom-select" name="status">
                      <option value="Lunas" <?= $row['status'] == 'Lunas' ? 'selected' : '' ?>>Lunas</option>
                      <option value="Belum Lunas" <?= $row['status'] == 'Belum Lunas' ? 'selected' : '' ?>>Belum Lunas</option>
                    </select>
                    <button type="submit" class="btn btn-primary">
                      <i class="fas fa-save fa-sm text-white-50"></i>
                    </button>
                  </form>
                </td>
              <?php else : ?>
                <td><?= $row['status'] ?></td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>

</script>
<?= $this->endSection() ?>