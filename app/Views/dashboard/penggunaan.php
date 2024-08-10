<?= $this->extend('templates/dashboard') ?>

<?= $this->section('page_title') ?>
Penggunaan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= var_dump($errors) ?>
<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Penggunaan</h1>
  <?php if ($user['role'] === 'admin') : ?>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModal">
      <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
    </button>
  <?php endif; ?>
</div>

<?php if ($user['role'] === 'admin') : ?>
  <!-- Form Modal -->
  <div class="modal fade" id="formModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formModalLabel">Tambah Data Penggunaan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="<?= base_url('dashboard/penggunaan/create') ?>">
            <input type="hidden" name="id-penggunaan" id="id-penggunaan">
            <div class="form-group">
              <label for="nama-pelanggan">Pelanggan</label>
              <select class="custom-select" name="id-pelanggan">
                <option selected disabled>---</option>
                <?php foreach ($pelanggan as $row) : ?>
                  <option value="<?= $row['id_pelanggan'] ?>"><?= $row['nama_pelanggan'] ?></option>
                <?php endforeach; ?>
              </select>
              <small id="nama-pelangganHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label for="bulan">Bulan</label>
              <input type="month" class="form-control" id="bulan" name="bulan" aria-describedby="bulanHelp">
              <small id="bulanHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label for="meter-awal">Meter Awal</label>
              <input type="number" class="form-control" id="meter-awal" name="meter-awal" aria-describedby="meter-awalHelp">
              <small id="meter-awalHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label for="meter-akhir">Meter Akhir</label>
              <input type="number" class="form-control" id="meter-akhir" name="meter-akhir" aria-describedby="meter-akhirHelp">
              <small id="meter-akhirHelp" class="form-text text-muted"></small>
            </div>
            <button type="submit" class="btn btn-primary w-100">Tambahkan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<!-- Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Penggunaan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah kamu akan menghapus data penggunaan pelanggan dengan nama <span id="delete-name"></span> pada bulan <span id="delete-bulan"></span> dan tahun <span id="delete-tahun"></span>?
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">
          Batal
        </button>
        <form id="delete-form" action="<?= base_url('dashboard/penggunaan/delete/') ?>" method="post">
          <button class="btn btn-primary">Hapus</button>
        </form>
      </div>
    </div>
  </div>
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
            <th>Meter Awal</th>
            <th>Meter Akhir</th>
            <?php if ($user['role'] === 'admin') : ?>
              <th>Aksi</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Nama Pelanggan</th>
            <th>Nomor KWH</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Meter Awal</th>
            <th>Meter Akhir</th>
            <?php if ($user['role'] === 'admin') : ?>
              <th>Aksi</th>
            <?php endif; ?>
          </tr>
        </tfoot>
        <tbody>
          <?php foreach ($penggunaan as $row) : ?>
            <tr>
              <td><?= $row['nama_pelanggan'] ?></td>
              <td><?= $row['nomor_kwh'] ?></td>
              <td><?= $row['bulan'] ?></td>
              <td><?= $row['tahun'] ?></td>
              <td><?= $row['meter_awal'] ?></td>
              <td><?= $row['meter_akhir'] ?></td>
              <?php if ($user['role'] === 'admin') : ?>
                <td>
                  <button type="button" id="edit-btn" class="btn btn-info" data-toggle="modal" data-target="#formModal" data-id-penggunaan="<?= $row['id_penggunaan'] ?>" data-id-pelanggan="<?= $row['id_pelanggan'] ?>" data-bulan="<?= $row['tahun'] . '-' . $row['bulan'] ?>" data-meter-awal="<?= $row['meter_awal'] ?>" data-meter-akhir="<?= $row['meter_akhir'] ?>">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                  </button>
                  <button type="button" id="delete-btn" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id-penggunaan="<?= $row['id_penggunaan'] ?>" data-nama-pelanggan="<?= $row['nama_pelanggan'] ?>" data-bulan="<?= $row['bulan'] ?>" data-tahun="<?= $row['tahun'] ?>">
                    <i class="fas fa-trash fa-sm text-white-50"></i>
                  </button>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  const editBtns = document.querySelectorAll('#edit-btn');
  const deleteBtns = document.querySelectorAll('#delete-btn');

  editBtns.forEach(editBtn => {
    editBtn.addEventListener('click', () => {
      const idPenggunaan = editBtn.getAttribute('data-id-penggunaan');
      const idPelanggan = editBtn.getAttribute('data-id-pelanggan');
      const bulan = editBtn.getAttribute('data-bulan');
      const meterAwal = editBtn.getAttribute('data-meter-awal');
      const meterAkhir = editBtn.getAttribute('data-meter-akhir');

      document.querySelector('#formModal form').setAttribute('action', '<?= base_url('dashboard/penggunaan/update') ?>/' + idPenggunaan);
      document.querySelector('#formModal input[name="id-penggunaan"]').value = idPenggunaan;
      document.querySelector('#formModal select[name="id-pelanggan"]').value = idPelanggan;
      document.querySelector('#formModal input[name="bulan"]').value = bulan;
      document.querySelector('#formModal input[name="meter-awal"]').value = meterAwal;
      document.querySelector('#formModal input[name="meter-akhir"]').value = meterAkhir;

      document.getElementById('formModalLabel').textContent = 'Edit Data Penggunaan';
    });
  })

  deleteBtns.forEach(deleteBtn => {
    deleteBtn.addEventListener('click', function(e) {
      const idPenggunaan = deleteBtn.getAttribute('data-id-penggunaan');
      const namaPelanggan = deleteBtn.getAttribute('data-nama-pelanggan');
      const bulan = deleteBtn.getAttribute('data-bulan');
      const tahun = deleteBtn.getAttribute('data-tahun');

      const deleteForm = document.getElementById('delete-form')
      const deleteFormAction = deleteForm.getAttribute('action');
      deleteForm.setAttribute('action', deleteFormAction + idPenggunaan);

      document.getElementById('delete-name').textContent = namaPelanggan;
      document.getElementById('delete-bulan').textContent = bulan;
      document.getElementById('delete-tahun').textContent = tahun;
    });
  })
</script>
<?= $this->endSection() ?>