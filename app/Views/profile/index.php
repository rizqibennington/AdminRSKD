<?= $this->extend('layouts/admin') ?>
<?php $this->section('styles') ?>
<!-- Custom styles for this page -->
<!-- <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?> " rel="stylesheet"> -->
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Profile Principal</h1>
    <?php
    if (session()->getFlashData('success')) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashData('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
    }
    ?>
    <div class="col-6">
        <form method="post" action="<?= base_url('profile/edit') ?>">

            <div class="form-group">
                <label for="name">Nama PIC</label>
                <input type="text" value="<?php echo user()->name ?>" name="principal_name" class="form-control" id="principal_name" placeholder="Nama Principal" required>
            </div>
            <div class="form-group">
                <label for="name">Email</label>
                <input type="email" value="<?php echo user()->email ?>" name="principal_email" class="form-control" id="principal_email" placeholder="Email Principal" required>
            </div>
            <div class="form-group">
                <label for="name">Nama Perusahaan</label>
                <input type="text" value="<?php echo user()->company_name ?>" name="principal_company" class="form-control" id="principal_company" placeholder="Nama Perusahaan" required>
            </div>
            <div class="form-group">
                <label for="name">Nomor WhatsApp</label>
                <input type="number" value="<?php echo user()->phone ?>" name="phone" class="form-control" id="phone" placeholder="nomor hp" required>
            </div>
            <!-- Button for updating profile -->
            <button class="btn btn-primary" id="updateProfileBtn">Update Profile</button>
        </form>

    </div>
</div>
<?= $this->endSection() ?>
<?php $this->section('scripts') ?>
<!-- Page level plugins -->
<!-- <script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script> -->
<!-- Page level custom scripts -->
<script>
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
<?php $this->endSection() ?>