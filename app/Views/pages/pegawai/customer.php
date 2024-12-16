<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kelola Data Customer</h1>
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
                        <h4>Data Customer</h4>
                        <div class="card-header-action">
                            <a href="<?= base_url('pegawai/customer/create')?>" class="btn btn-primary">Tambah
                                Customer</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Customer</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tempat Tinggal</th>
                                        <th>No Hp</th>
                                        <th>Potin</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php $no = 1?>
                                <?php foreach ($customer as $cs): ?>
                                <tbody>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?=$cs['nama_customer']?></td>
                                        <td><?= $cs['jenis_kelamin']?> </td>
                                        <td><?= $cs['tempat_tinggal']?></td>
                                        <td><?= $cs['no_hp']?></td>
                                        <td><?= $cs['point']?> Point </td>
                                        <td>
                                            <a href="<?= base_url('pegawai/customer/edit/').$cs['id_customer']?>"
                                                class="btn btn-primary">Edit</a>
                                            <button data-target="#hapusModal<?=$cs['id_customer']?>" data-toggle="modal"
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
<?php foreach ($customer as $cs) :?>
<div class="modal fade" id="hapusModal<?=htmlspecialchars($cs['id_customer'],)?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pegawai/customer/delete/').$cs['id_customer']?>" method="POST">
                <?= csrf_field()?>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus user <?=$cs['nama_customer']?> ?
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