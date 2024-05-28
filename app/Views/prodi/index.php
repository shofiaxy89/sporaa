<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4"><?= $title ?></h2>
            <!-- Menampilkan notifikasi flash data -->
            <?php
            $session = session();
            if ($session->getFlashdata('success')) :
            ?>
                <div class="alert alert-success" role="alert">
                    <?= $session->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <?php if ($session->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $session->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            
            <!-- Tombol Tambah Data -->
            <button type="button" class="btn btn-primary" title="Tambah" data-bs-toggle="modal" data-bs-target="#prodiModal">
                Tambah Data
            </button>
            <br><br>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Prodi
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Prodi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($prodi as $key => $row): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $row['nama_prodi'] ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm edit-btn" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $row['id_prodi'] ?>" data-nama="<?= $row['nama_prodi'] ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form action="/prodi/delete/<?= $row['id_prodi'] ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Data -->
        <div class="modal fade" id="prodiModal" tabindex="-1" aria-labelledby="prodiModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="prodiModalLabel">Tambah Data Prodi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/prodi/create" method="post">
                        <div class="modal-body">
                            <input type="hidden" id="prodiId" name="id_prodi">
                            <div class="mb-3">
                                <label for="namaProdi" class="form-label">Nama Prodi</label>
                                <input type="text" class="form-control" id="namaProdi" name="nama_prodi" required placeholder="Masukkan Nama Prodi">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success" id="modalKirimButton">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Data -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Prodi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('prodi/ubah') ?>" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="id_prodi" id="edit_id_prodi">
                            <div class="mb-3">
                                <label for="edit_nama" class="form-label">Nama Prodi</label>
                                <input type="text" class="form-control" id="edit_nama_prodi" name="nama_prodi" placeholder="Masukkan Nama Prodi" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="<?= base_url('assets/js/scripts.js') ?>"></script>
<?= $this->endSection() ?>
