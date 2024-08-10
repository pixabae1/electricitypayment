<?= $this->extend('templates/dashboard') ?>

<?= $this->section('page_title') ?>
Pembayaran
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pembayaran</h1>
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
            <th>Tanggal</th>
            <th>Bulan</th>
            <th>Biaya Admin</th>
            <th>Total Bayar</th>
            <th>Nama Admin</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Nama Pelanggan</th>
            <th>Nomor KWH</th>
            <th>Tanggal</th>
            <th>Bulan</th>
            <th>Biaya Admin</th>
            <th>Total Bayar</th>
            <th>Nama Admin</th>
          </tr>
        </tfoot>
        <tbody>
          <?php foreach ($pembayaran as $row) : ?>
            <tr>
              <td><?= $row['nama_pelanggan'] ?></td>
              <td><?= $row['nomor_kwh'] ?></td>
              <td><?= $row['tanggal_pembayaran'] ?></td>
              <td><?= $row['bulan_bayar'] ?></td>
              <td><?= $row['biaya_admin'] ?></td>
              <td><?= $row['total_bayar'] ?></td>
              <td><?= $row['nama_admin'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection() ?>