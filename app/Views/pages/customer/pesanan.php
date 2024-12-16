<?= $this->extend('layouts/admin-panel-customer')?>

<?= $this->section('content')?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pesan Barang</h1>
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
                        <h4>Barang Pesanan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Pesanan</th>
                                        <th>Nama Produk</th>
                                        <th>Nama Pembeli</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Tambahan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php $no = 1?>
                                <?php foreach ($pesanan as $pesan): ?>
                                <?php 
                            if ($pesan['status'] == 'Menunggu Konfirmasi') {
                                $badge = "badge-info";
                                $isHide = '';
                            } else if ($pesan['status'] == 'Belum Dibayar') {
                                $badge = 'badge-danger';
                                $isHide = 'disabled';
                            }else if ($pesan['status'] == 'Sudah Dibayar') {
                                $badge = 'badge-success';
                                $isHide = 'disabled';
                            }else if ($pesan['status'] == 'Dikirim') {
                                $badge = 'badge-primary';
                                $isHide = 'disabled';
                            }else if ($pesan['status'] == 'Diterima') {
                                $badge = 'badge-success';
                                $isHide = 'disabled';
                            }
                            ?>
                                <tbody>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?=$pesan['id_pesanan']?></td>
                                        <td><?= $pesan['nama_produk']?> </td>
                                        <td><?=$pesan['nama_pembeli']?></td>
                                        <td><?= $pesan['jumlah']?></td>
                                        <td><?= $pesan['total']?></td>
                                        <td><?= $pesan['tanggal']?></td>
                                        <td>
                                            <div class="badge <?=$badge?>"><?= $pesan['status']?></div>
                                        </td>
                                        <td><input type="text" name="ongkos_kirim" class="form-control">
                                        <td>

                                            <button <?= $isHide?>
                                                data-target="#kirimModal<?=$pesan['id_barang_pesanan']?>"
                                                data-toggle="modal" class="btn btn-success <?= $isHide?>">Kirim
                                                Barang</button>
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
<?php foreach ($pesanan as $pesan) :?>
<div class="modal fade" id="kirimModal<?=$pesan['id_barang_pesanan']?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('customer/kirim/').$pesan['id_barang_pesanan']?>" method="GET">
                <?= csrf_field()?>
                <div class="modal-body">
                    Apakah anda yakin ingin mengirimkan pesanan <?=$pesan['nama_barang']?> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Kirimkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach?>
<?= $this->endSection()?>