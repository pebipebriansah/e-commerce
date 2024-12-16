<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kelola Data User</h1>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <?php 
                if (session()->getFlashdata('success')) {
                    echo '<div class="alert alert-success" role="alert">'.session()->getFlashdata('success').'</div>';
                } else if (session()->getFlashdata('error')){
                    echo '<div class="alert alert-danger" role="alert">'.session()->getFlashdata('error').'</div>';
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Data Users</h4>
                        <div class="card-header-action">
                            <a href="<?= base_url('pegawai/users/create')?>" class="btn btn-primary">Tambah User</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php $no = 1?>
                                <?php foreach ($users as $user): ?>
                                <tbody>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?=$user['nama']?></td>
                                        <td><?= $user['email']?> </td>
                                        <td><?= $user['role']?></td>
                                        <td>
                                            <a href="<?= base_url('pegawai/users/edit/').$user['id']?>"
                                                class="btn btn-primary">Edit</a>
                                            <button data-target="#hapusModal<?=$user['id']?>" data-toggle="modal"
                                                class="btn btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php endforeach?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Statistik -->
    </section>
</div>


<!-- Modal -->
<?php foreach ($users as $user) :?>
<div class="modal fade" id="hapusModal<?=htmlspecialchars($user['id'],)?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pegawai/users/delete/').$user['id']?>" method="POST">
                <?= csrf_field()?>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus user <?=$user['nama']?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach?>
<?= $this->endSection()?>