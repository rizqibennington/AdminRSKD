<?= $this->extend('layouts/admin') ?>
<?php $this->section('styles') ?>
<!-- Custom styles for this page -->
<!-- <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?> " rel="stylesheet"> -->
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Obat</h1>
    <?php if (session()->getFlashData('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashData('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashData('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashData('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <?php
        if (user()->role == 1) :
        ?>
            <div class="card-header py-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                    Tambah Obat
                </button>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <div>
                Verifikator : <?= user()->name; ?>
            </div>
            <div>

                SMF : <?= user()->unit; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Obat</th>
                            <th>Dosis</th>
                            <th>Tujuan</th>
                            <th width="25%">Deskripsi</th>
                            <th>Waktu Pengajuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($obat as $key => $obt) : ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $obt['nama_obat'] ?></td>
                                <td><?= $obt['bentuk'] ?></td>
                                <td><?= $obt['tujuan'] ?></td>
                                <td><?= $obt['uraian'] ?></td>
                                <td><?= $obt['waktu'] ?></td>
                                <td><?php
                                    if ($obt['status'] == 1) {
                                        echo 'disetujui';
                                    } else if ($obt['status'] == 2) {
                                        echo "ditolak";
                                    } else {
                                        echo 'menunggu';
                                    }
                                    ?></td>
                                <?php

                                if (user()->role == 1) {

                                ?>
                                    <td>
                                        <a href="#" data-target="#editModal-<?= $obt['id'] ?>" data-toggle="modal" class="btn btn-warning btn-icon">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-info-circle"></i>
                                            </span>
                                            <span class="text">Edit</span>
                                        </a>
                                        <a href="<?= base_url('obat/delete/' . $obt['id']) ?>" class="btn btn-danger btn-icon" onclick="return confirm('Are you sure ?')">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Delete</span>
                                        </a>
                                    </td>
                                    <?php } else {

                                    if ($obt['status'] == 0) {
                                    ?>
                                        <td>
                                            <form action="<?= base_url('obat/verifikasi/' . $obt['id']) ?>" method="post" style="display:inline;">
                                                <button type="submit" class="btn btn-primary btn-icon">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-info-circle"></i>
                                                    </span>
                                                    <span class="text">Verifikasi</span>
                                                </button>
                                            </form>

                                            <form action="<?= base_url('obat/tolak/' . $obt['id']) ?>" method="post" style="display:inline;">
                                                <button type="submit" class="btn btn-warning btn-danger">
                                                    <span class="icon text-white-50">
                                                    </span>
                                                    <span class="text">Tolak</span>
                                                </button>
                                            </form>

                                            <a href="#" data-target="#editModal-<?= $obt['id'] ?>" data-toggle="modal" class="btn btn-warning btn-icon">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-info-circle"></i>
                                                </span>
                                                <span class="text">Detail</span>
                                            </a>

                                        </td>
                                    <?php
                                    } else {
                                    ?>
                                        <td>
                                            <a href="#" data-target="#editModal-<?= $obt['id'] ?>" data-toggle="modal" class="btn btn-warning btn-icon">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-info-circle"></i>
                                                </span>
                                                <span class="text">Detail</span>
                                            </a>

                                        </td>
                                <?php
                                    }
                                } ?>
                            </tr>
                            <div class="modal fade" id="editModal-<?= $obt['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Obat</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="<?= base_url('obat/edit/' . $obt['id']) ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nama_obat">Nama Perusahaan</label>
                                                    <input type="text" name="nama_perusahaan" class="form-control" id="nama_perusahaan" value="<?= $obt['nama_perusahaan'] ?>" placeholder="Nama Obat" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_obat">Nama Obat</label>
                                                    <input type="text" name="nama_obat" class="form-control" id="nama_obat" value="<?= $obt['nama_obat'] ?>" placeholder="Nama Obat" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="bentuk">Bentuk</label>
                                                    <input type="text" name="bentuk" class="form-control" id="bentuk" value="<?= $obt['bentuk'] ?>" placeholder="Bentuk Obat" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tujuan">Tujuan</label>
                                                    <select name="tujuan" class="form-control" id="tujuan" required>
                                                        <option value="">Pilih Tujuan</option>
                                                        <option value="anak" <?= $obt['tujuan'] == 'anak' ? 'selected' : '' ?>>Anak</option>
                                                        <option value="jantung" <?= $obt['tujuan'] == 'jantung' ? 'selected' : '' ?>>Jantung</option>
                                                        <option value="tht" <?= $obt['tujuan'] == 'tht' ? 'selected' : '' ?>>THT</option>
                                                        <option value="bedah" <?= $obt['tujuan'] == 'bedah' ? 'selected' : '' ?>>Bedah</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="uraian">Uraian</label>
                                                    <input type="text" name="uraian" class="form-control" id="uraian" value="<?= $obt['uraian'] ?>" placeholder="Uraian" required>
                                                </div>

                                                <?php if ($obt['filepath']) : ?>
                                                    <a class="btn btn-primary" href="<?php echo 'obat/download_file/' . $obt['filepath'] ?>">lihat file</a>


                                                <?php endif; ?>
                                                <div class="form-group">
                                                    <label for="upload">Upload File</label>
                                                    <input type="file" name="upload" class="form-control-file" id="upload">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <?php if (user()->role == 1) : ?>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                <?php endif; ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('obat/create') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_obat">Nama Perusahaan</label>
                        <input type="text" readonly value="<?= user()->company_name ?>" name="nama_perusahaan" class="form-control" id="nama_perusahaan" placeholder="Nama Perusahaan" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_obat">Nama Obat</label>
                        <input type="text" name="nama_obat" class="form-control" id="nama_obat" placeholder="Nama Obat" required>
                    </div>
                    <div class="form-group">
                        <label for="bentuk">Bentuk</label>
                        <input type="text" name="bentuk" class="form-control" id="bentuk" placeholder="Bentuk Obat" required>
                    </div>
                    <div class="form-group">
                        <label for="tujuan">Tujuan</label>
                        <select name="tujuan" class="form-control" id="tujuan" required>
                            <option value="">Pilih Tujuan</option>
                            <option value="anak">Anak</option>
                            <option value="jantung">Jantung</option>
                            <option value="tht">THT</option>
                            <option value="bedah">Bedah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="uraian">Uraian</label>
                        <input type="text" name="uraian" class="form-control" id="uraian" placeholder="Uraian" required>
                    </div>
                    <div class="form-group">
                        <label for="upload">Upload File</label>
                        <input type="file" name="upload" class="form-control-file" id="upload">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>