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
            <button type="button" class="btn btn-primary" title="Tambah" data-bs-toggle="modal" data-bs-target="#divisiModal">
                Tambah Data
            </button>
            <br><br>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Divisi
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Divisi</th>
                                <th>Deskripsi</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($divisi as $key => $row): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $row['nama_divisi'] ?></td>
                                    <td><?= $row['deskripsi'] ?></td>
                                    <td><?= $row['foto'] ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm edit-btn" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $row['id_divisi'] ?>" data-nama="<?= $row['nama_divisi'] ?>" data-deskripsi="<?= $row['deskripsi'] ?>" data-foto="<?= $row['foto'] ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form action="/divisi/delete/<?= $row['id_divisi'] ?>" method="post" class="d-inline">
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
<div class="modal fade" id="divisiModal" tabindex="-1" aria-labelledby="divisiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="divisiModalLabel">Tambah Data Divisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/divisi/create" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="divisiId" name="id_divisi">
                    <div class="mb-3">
                        <label for="namaDivisi" class="form-label">Nama Divisi</label>
                        <input type="text" class="form-control" id="namaDivisi" name="nama_divisi" required placeholder="Masukkan Nama Divisi">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" required placeholder="Masukkan Deskripsi">
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" required>
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
                <h5 class="modal-title" id="editModalLabel">Edit Data Divisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('divisi/ubah') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id_divisi" id="edit_id_divisi">
                    <div class="mb-3">
                        <label for="edit_nama_divisi" class="form-label">Nama Divisi</label>
                        <input type="text" class="form-control" id="edit_nama_divisi" name="nama_divisi" placeholder="Masukkan Nama Divisi" required>
                    </div>
                     <div class="mb-3">
                        <label for="edit_deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="edit_deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi" required>
                    </div>
                     <div class="mb-3">
                        <label for="edit_foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="edit_foto" name="foto">
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

<script src="<?= base_url('assets/js/scripts.js') ?>"></script>
<?= $this->endSection() ?>
