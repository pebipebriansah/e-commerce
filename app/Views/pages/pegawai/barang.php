<?= $this->extend('layouts/admin-panel-pegawai')?>

<?= $this->section('content')?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kelola Barang</h1>
        </div>

        <!-- Statistik -->
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
                        <h4>Data Produk</h4>
                        <div class="card-header-action">
                            <a href="<?= base_url('pegawai/barang/create')?>" class="btn btn-primary">Tambah
                                Produk</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Keterangan</th>
                                        <th>Photo</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php $no = 1?>
                                <?php foreach ($barang as $br) : ?>
                                <tbody>
                                    <tr>
                                        <td><?= $no++?></td>
                                        <td><?= $br['id_produk']?></td>
                                        <td><?= $br['nama_produk']?></td>
                                        <td><?= $br['kategori']?></td>
                                        <td><?= $br['jumlah']?> Pcs</td>
                                        <td><?= $br['harga']?></td>
                                        <td><?= $br['keterangan']?></td>
                                        <td>
                                            <?php if (!empty($br['photo'])): ?>
                                            <img src="<?= base_url('uploads/photos/' . $br['photo']) ?>" alt="Photo"
                                                width="100">
                                            <?php else: ?>
                                            No Photo
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('pegawai/barang/edit/'). $br['id_produk']?>"
                                                class="btn btn-primary">Edit</a>
                                            <button data-target="#hapusModal<?=$br['id_produk']?>" data-toggle="modal"
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
    <?php foreach ($barang as $br) :?>
    <div class="modal fade" id="hapusModal<?=$br['id_produk']?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('pegawai/barang/delete/').$br['id_produk']?>" method="POST">
                    <?= csrf_field()?>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus barang <?=$br['nama_produk']?> ?
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